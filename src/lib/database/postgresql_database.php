<?php
    class PostgresDatabaseConnection {
        private static $instance = null;
        private $conn = null;

        public static function getInstance() {
            if (self::$instance == null) {
                self::$instance = new PostgresDatabaseConnection();
            }
            return self::$instance;
        }

        public function connect($server, $port, $user, $pass, $db) {
            $actualPort = $port ?? 5432;
    
            try {
                $this->conn =
                    pg_connect("host=$server port=$actualPort dbname=$db user=$user password=$pass");
            } catch (Exception $e) {
                return;
            }
            
            pg_prepare($this->conn, "getCategory", "SELECT * FROM category WHERE slug = $1;");
            pg_prepare($this->conn, "getCategories", "SELECT * FROM category;");
            pg_prepare($this->conn, "getProduct", "SELECT * FROM product WHERE id = $1;");
            pg_prepare($this->conn, "getUser", "SELECT * FROM users WHERE email = $1;");
        
            pg_prepare(
                $this->conn,
                "createUser",
                "INSERT INTO Users(username, password, email, address, city, postalCode)
                VALUES ($1, $2, $3, $4, $5, $6) RETURNING ID;"
            );

            pg_prepare($this->conn, "getProducts", "SELECT * FROM product;");
            pg_prepare($this->conn, "getProductsByCategory", "SELECT * FROM product WHERE category = $1;");
            
            pg_prepare($this->conn, "searchProducts", "SELECT * FROM product WHERE name ILIKE $1 OR description ILIKE $1;");

            pg_prepare(
                $this->conn,
                "updateUser",
                "UPDATE users
                SET username = $1,
                password = $2,
                email = $3,
                address = $4,
                city = $5,
                postalCode = $6
                WHERE id = $7;"
            );
            
            pg_prepare(
                $this->conn,
                "createOrder",
                "INSERT INTO Orders(user_id, date, price_paid, canceled)
                VALUES ($1, $2, $3, $4) RETURNING ID;"
            );

            pg_prepare(
                $this->conn,
                "addProductToOrder",
                "INSERT INTO OrderItems(order_id, product_id, quantity)
                VALUES ($1, $2, $3) ON CONFLICT(order_id, product_id) DO UPDATE SET quantity = $3;"
            );

            pg_prepare(
                $this->conn,
                "removeProductFromOrder",
                "DELETE FROM OrderItems WHERE order_id = $1 AND product_id = $2;"
            );

            pg_prepare(
                $this->conn,
                "getOrdersByUser",
                "SELECT * FROM Orders WHERE user_id = $1;"
            );

            pg_prepare(
                $this->conn,
                "getOrder",
                "SELECT * FROM Orders WHERE id = $1;"
            );

            pg_prepare(
                $this->conn,
                "getOrderProducts",
                "SELECT * FROM OrderItems WHERE order_id = $1;"
            );
        }

        public function getCategories(): array {
            $queryResult = pg_execute($this->conn, "getCategories", []);
            return pg_fetch_all($queryResult);
        }

        public function getProducts($category): array {
            if ($category == null) {
                $queryResult = pg_execute($this->conn, "getProducts", []);
            } else {
                $queryResult = pg_execute($this->conn, "getProductsByCategory", [$category]);
            }
            return pg_fetch_all($queryResult);
        }

        public function searchProducts($search): array {
            $queryResult = pg_execute($this->conn, "searchProducts", ["%$search%"]);
            return pg_fetch_all($queryResult);
        }

        public function getProduct($id): array {
            $queryResult = pg_execute($this->conn, "getProduct", [$id]);
            $result = pg_fetch_all($queryResult)[0];
            $result["price"] = $result["price"] / 100;
            return $result;
        }

        public function getCategory($slug) {
            $queryResult = pg_execute($this->conn, "getCategory", [$slug]);
            if (pg_num_rows($queryResult) == 0) {
                return null;
            }
            return pg_fetch_all($queryResult)[0];
        }

        public function createUser(
            $name,
            $pass,
            $email,
            $address,
            $city,
            $postalCode
        ){
            $queryResult = pg_execute(
                $this->conn,
                "createUser",
                [$name, password_hash($pass, PASSWORD_DEFAULT), $email, $address, $city, $postalCode]
            );
            if ($queryResult == false) {
                return null;
            }
            return pg_fetch_all($queryResult)[0];
        }

        public function getUser($mail) {
            $queryResult = pg_execute($this->conn, "getUser", [$mail]);
            $result = pg_fetch_all($queryResult);
            return $result[0];
        }

        public function getUserSafe($mail) {
            $queryResult = pg_execute($this->conn, "getUser", [$mail]);
            $result = pg_fetch_all($queryResult);
            unset($result["password"]);
            return $result;
        }

        public function editUser($name, $password, $email, $adress, $city, $postalCode) {
            $queryResult = pg_execute(
                $this->conn,
                "updateUser",
                [$name, password_hash($password, PASSWORD_DEFAULT), $email, $adress, $city, $postalCode]
            );
            return pg_fetch_all($queryResult);
        }

        /**
         * @param int $elements An array of arrays, `[id = int, quantity = int]`
         */
        public function createOrder(
            $userId,
            $pricePaid,
            $elements,
            $date
        ){
            $queryResult = pg_execute(
                $this->conn,
                "createOrder",
                [$userId, $date->format('Y-m-d H:i:s'), $pricePaid, "false"]
            );
            $id = pg_fetch_all($queryResult)[0];
            if ($id == null) {
                return null;
            }
            try {
                foreach ($elements as $element) {
                    pg_execute(
                        $this->conn,
                        "addProductToOrder",
                        [$id["id"], $element["id"], $element["quantity"]]
                    );
                }
            } catch (Exception $e) {
                pg_execute($this->conn, "deleteOrder", [$id]);
                return [];
            }
            return $id;
        }

        public function getOrder($orderId){
            $queryResult = pg_execute($this->conn, "getOrder", [$orderId]);
            $order = pg_fetch_all($queryResult);
            $order["products"] = pg_execute($this->conn, "getOrderProducts", [$orderId]);
            $order["products"] = pg_fetch_all($order["products"]);
            $order["products"] = array_map([$this, "decorateProductFromOrder"], $order["products"]);
            return $order;
        }

        public function getOrdersByUser($userId) {
            $queryResult = pg_execute($this->conn, "getOrdersByUser", [$userId]);
            $orders = pg_fetch_all($queryResult);
            return array_map(function($order) {
                $order["products"] = pg_execute($this->conn, "getOrderProducts", [$order["id"]]);
                $order["products"] = pg_fetch_all($order["products"]);
                $order["products"] = array_map([$this, "decorateProductFromOrder"], $order["products"]);
                return $order;
            }, $orders);
        }

        private function decorateProductFromOrder($product) {
            $product["product"] = $this->getProduct($product["product_id"]);
            unset($product["product_id"]);
            return $product;
        }

}


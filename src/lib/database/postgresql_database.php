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

        public function connect(string $server, int|null $port, string $user, string $pass, string $db) {
            $actualPort = $port ?? 5432;
    
            try {
                $this->conn =
                    pg_connect("host=$server port=$actualPort dbname=$db user=$user password=$pass");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            
            pg_prepare($this->conn, "getCategory", "SELECT * FROM category WHERE slug = $1;");
            pg_prepare($this->conn, "getProduct", "SELECT * FROM product WHERE id = $1;");
            pg_prepare($this->conn, "getUser", "SELECT * FROM users WHERE id = $1;");
            pg_prepare($this->conn, "getCategorySimple", "SELECT slug, name FROM category WHERE slug = $1;");
        }

        public function getCategories(string|null $category): array {
            if ($category == null) {
                pg_prepare($this->conn, "getCategories", "SELECT * FROM category;");
                $queryResult = pg_execute($this->conn, "getCategories", []);
            } else {
                pg_prepare($this->conn, "getCategories", "SELECT * FROM category WHERE parent = $1;");
                $queryResult = pg_execute($this->conn, "getCategories", [$category]);
            }
            return pg_fetch_all($queryResult);
        }

        public function getProducts(string|null $category): array {
            if ($category == null) {
                pg_prepare($this->conn, "getProducts", "SELECT * FROM product;");
                $queryResult = pg_execute($this->conn, "getProducts", []);
            } else {
                pg_prepare($this->conn, "getProducts", "SELECT * FROM product WHERE category = $1;");
                $queryResult = pg_execute($this->conn, "getProducts", [$category]);
            }
            return pg_fetch_all($queryResult);
        }

        public function getProduct(int $id): array {
            $queryResult = pg_execute($this->conn, "getProduct", [$id]);
            $result = pg_fetch_all($queryResult)[0];
            $result["parents"] = $this->getAllParentsOfProduct($result["id"]);
            $result["parents"] = array_map([$this, 'fetchSimpleCategory'], $result["parents"]);
            $result["price"] = $result["price"] / 100;
            return $result;
        }

        private function fetchSimpleCategory(string $slug) {
            $queryResult = pg_execute($this->conn, "getCategorySimple", [$slug]);
            return pg_fetch_all($queryResult)[0];
        }

        public function getCategory(string $slug) {
            $queryResult = pg_execute($this->conn, "getCategory", [$slug]);
            $result = pg_fetch_all($queryResult)[0];
            if ($result == null) {
                return null;
            }
            $result["parents"] = $this->getAllParentsOfCategory($result["slug"]);
            $result["parents"] = array_map([$this, 'fetchSimpleCategory'], $result["parents"]);
            return $result;
        }

        private function getAllParentsOfCategory(string $category) {
            if ($category == null) {
                return [];
            }
            $queryResult = pg_execute($this->conn, "getCategory", [$category]);
            $parents = [];
            $currParent = pg_fetch_result($queryResult, 0, "parent");
            while ($currParent != null) {
                array_push($parents, $currParent);
                $queryResult = pg_execute($this->conn, "getCategory", [$currParent]);
                $currParent = pg_fetch_result($queryResult, 0, "parent");
            }
            return $parents;
        }

        private function getAllParentsOfProduct(int $id) {
            if ($id == null) {
                return [];
            }
            $queryResult = pg_execute($this->conn, "getProduct", [$id]);
            $parents = [];
            $currParent = pg_fetch_result($queryResult, 0, "category");
            while ($currParent != null) {
                array_push($parents, $currParent);
                $queryResult = pg_execute($this->conn, "getCategory", [$currParent]);
                $currParent = pg_fetch_result($queryResult, 0, "parent");
            }
            return $parents;
        }
    

    public function createUser(
        string $name,
        string $pass,
        string $email,
        string $address,
        string $city,
        string $postalCode
    ){
        $sql = "INSERT INTO Usuari(name, password, email, address, city, postalCode)
        VALUES ($1, $2, $3, $4, $5, $6) RETURNING ID;";
        pg_prepare($this->conn, "createUser", $sql);
        $queryResult = pg_execute(
            $this->conn,
            "createUser",
            [$name, password_hash($pass, PASSWORD_DEFAULT), $email, $address, $city, $postalCode]
        );
        return pg_fetch_all($queryResult);
    }

    public function getUser(int $id) {
        $queryResult = pg_execute($this->conn, "getUser", [$id]);
        $result = pg_fetch_all($queryResult);
        return $result[0];
    }

    public function getUserSafe(int $id) {
        $queryResult = pg_execute($this->conn, "getUser", [$id]);
        $result = pg_fetch_all($queryResult);
        unset($result["password"]);
        return $result;
    }

    public function createNewUser($name, $password, $email, $adress, $city, $postalCode) {
        $sql = "INSERT INTO Usuari SET name=?, password=?, email=?, address=?, city=?, postalCode=?";
        pg_prepare($this->conn, "createNewUser", $sql);
        $queryResult = pg_execute(
            $this->conn,
            "createNewUser",
            [$name, password_hash($password, PASSWORD_DEFAULT), $email, $adress, $city, $postalCode]
        );
        return pg_fetch_all($queryResult);
    }

    public function editUser($name, $password, $email, $adress, $city, $postalCode) {
        $sql = "INSERT INTO Usuari SET name=?, password=?, email=?, address=?, city=?, postalCode=?";
        pg_prepare($this->conn, "editUser", $sql);
        $queryResult = pg_execute(
            $this->conn,
            "editUser",
            [$name, password_hash($password, PASSWORD_DEFAULT), $email, $adress, $city, $postalCode]
        );
        return pg_fetch_all($queryResult);
    }

    public function createComanda(
        string $comanda_id,
        string $user_id,
        string $total_cost,
        string $date,
        string $n_elements
    ){
        $sql = "INSERT INTO Comanda(comanda_id, user_id, total_cost, date, n_elements)
        VALUES ($1, $2, $3, $4, $5, $6) RETURNING ID;";
        pg_prepare($this->conn, "createComanda", $sql);
        $queryResult = pg_execute(
            $this->conn,
            "CreateComanda",
            [$comanda_id, $user_id, $total_cost, $date, $n_elements]
        );
        return pg_fetch_all($queryResult);
    }

    public function getComanda($user_id, $date){
        $queryResult = pg_execute($this->conn, "getComanda", [$user_id, $date]);
        $result = pg_fetch_all($queryResult);
        return $result;
    }

    public function getComandes($user_id): array{
        if ($user_id  == null){
            pg_prepare($this->conn, "getComandes", "SELECT * FROM Comanda;");
            $queryResult = pg_execute($this->conn, "getComandes", []);
        }else{
            pg_prepare($this->conn, "getComandes", "SELECT * FROM Comanda WHERE user_id = '$user_id';");
            $queryResult = pg_execute($this->conn, "getComandes", [$user_id]);
        }
        return pg_fetch_all($queryResult);
    }

    public function getProductsComanda($comanda_id): array{
        if ($comanda_id  == null){
            pg_prepare($this->conn, "getProductsComanda", "SELECT * FROM Comanda;");
            $queryResult = pg_execute($this->conn, "getProductsComanda", []);
        }else{
            pg_prepare($this->conn, "getProductsComanda", "SELECT * FROM Comanda WHERE comanda_id = '$comanda_id';");
            $queryResult = pg_execute($this->conn, "getProductsComanda", [$comanda_id]);
        }
        return pg_fetch_all($queryResult);
    }
}


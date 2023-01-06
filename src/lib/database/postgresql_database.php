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
            $result = pg_fetch_all($queryResult);
            $result["parents"] = $this->getAllParentsOfProduct($result["id"]);
            return $result;
        }

        public function getCategory(string $slug): array {
            $queryResult = pg_execute($this->conn, "getCategory", [$slug]);
            $result = pg_fetch_all($queryResult)[0];
            $result["parents"] = $this->getAllParentsOfCategory($result["slug"]);
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
    }

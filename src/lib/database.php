<?php
    class DatabaseConnection {
        private static $instance = null;
        private $conn = null;

        private $dataset = [
            "categories" => [
                "corda",
                "vent",
                "percussió",
                "teclat"
            ],
            "products" => [
                [
                    "id" => 1,
                    "name" => "Violí",
                    "category" => "corda",
                    "description" => "Un violí",
                    "price" => 1000
                ],
                [
                    "id" => 2,
                    "name" => "Trompeta",
                    "category" => "vent",
                    "description" => "Una trompeta",
                    "price" => 2000
                ],
                [
                    "id" => 3,
                    "name" => "Tambor",
                    "category" => "percussió",
                    "description" => "Un tambor",
                    "price" => 3000
                ],
                [
                    "id" => 4,
                    "name" => "Piano",
                    "category" => "teclat",
                    "description" => "Un piano",
                    "price" => 4000
                ]
            ]
        ];
        
        public static function getInstance() {
            if (self::$instance == null) {
                self::$instance = new databaseConnection();
            }
            return self::$instance;
        }

        public function connect(string $server, int $port, string $user, string $pass, string $db) {
            $connection = null;
            $actualPort = $port ?? 5432;
    
            try {
                $this->conn = new PDO(
                    "pgsql:host=$server;port=$actualPort;dbname=$db;charset=UTF8",
                    $user,
                    $pass
                );
                
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            $this->conn = $connection;
        }

        // Stub for now
        public function getCategories() {
            return $this->dataset["categories"];
        }

        public function getProducts($category) {
            return array_filter(
                $this->dataset["products"],
                function($product) use ($category) {
                    return $product["category"] == $category;
                }
            );
        }
    }


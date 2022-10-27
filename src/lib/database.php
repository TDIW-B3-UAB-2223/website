<?php
    class DatabaseConnection {
        private static $instance = null;
        private $conn = null;
        
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
                $conn = new PDO(
                    "pgsql:host=$server;port=$actualPort;dbname=$db;charset=UTF8",
                    $user,
                    $pass
                );
                
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            $conn = $connection;
        }

        public function getConection() {
            return $this->conn;
        }
    }


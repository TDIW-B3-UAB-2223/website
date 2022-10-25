<?php
    class databaseConnection {
        private static $instance = null;
        private $conn = null;
        
        public static function get_instance() {
            if (self::$instance == null) {
                self::$instance = new databaseConnection();
            }
            return self::$instance;
        }

        public function connect(string $server, int $port, string $user, string $pass, string $db) {
            $connection = null;
            $actual_port = $port ?? 5432;
    
            try{
                $conn = new PDO("pgsql:host=$server;port=$actual_port;dbname=$db;charset=UTF8",$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            $conn = $connection;
        }
    }
?>
<?php
    
    class Route {
        private $path;
        private $uses_db;

        public function __construct(string $path, bool $uses_db = false) {
            $this->path = $path;
            $this->uses_db = $uses_db;
        }

        function get_uses_db() {
            return $this->uses_db;
        }

        function get_path() {
            return $this->path;
        }
    }

    function get_router() {
        return [
            "llistar-categories" => new Route("categories.php", true),
            "portada" => new Route("index.php", true),
            "404" => new Route("404.php")
        ];
    }

?>
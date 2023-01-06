<?php
    
    class Route {
        private $path;
        private $usesDB;

        public function __construct(string $path, bool $usesDB = false) {
            $this->path = $path;
            $this->usesDB = $usesDB;
        }

        public function getUsesDB() {
            return $this->usesDB;
        }

        public function getPath() {
            return $this->path;
        }
    }

    function getRouter() {
        return [
            "llistar-categories" => new Route("categories.php", true),
            "mostrar-categoria" => new Route("categoria.php", true),
            "portada" => new Route("index.php", true),
            "404" => new Route("404.php")
        ];
    }


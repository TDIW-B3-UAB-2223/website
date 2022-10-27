<?php
use PHPUnit\Framework\TestCase;

include_once(
    __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" .
    DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "router.php"
);

final class RouterTest extends TestCase {
    public function testPortadaRouteIsindexphp() {

        $router = getRouter();

        $this->assertEquals('index.php', $router['portada']->getPath());
    }
}


<?php 
class productes{
	
	public function getProductes($id): array{

        $conn =\DatabaseConnection::connect();

		$sql= "SELECT id_producte, nom, preu 
           FROM Producte 
           WHERE categoria_id='$id' 
           ORDER BY 1";
		$stmt= $conn->query($sql, \PDO::FETCH_ASSOC);
		$stmt->execute();
		$productos=$stmt->fetchAll(PDO::FETCH_ASSOC);

		return $productos;
	}
	public function getInfoProducto($id) {

        $conn =\DatabaseConnection::connect();

        $sql = "SELECT *
            FROM Producte
            WHERE id_producte='$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $producto = $stmt->fetch();

        return $producto;
    }
}
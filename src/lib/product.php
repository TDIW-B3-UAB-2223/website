
<?php 
class productes{
	
	public function getProductes($id): array{

        $conn =\DatabaseConnection::connect();

		$sql= 'SELECT id_producte, nom, preu 
           FROM Producte 
           WHERE categoria_id=$1
           ORDER BY 1';
		$stmt = pg_query_params($conn, $sql, $id);
		$productes =pg_fetch_all($stmt);

		return $productos;
	}
	public function getInfoProducto($id) {

        $conn =\DatabaseConnection::connect();

        $sql = 'SELECT *
            FROM Producte
            WHERE id_producte=$1';
        $stmt = pg_query_params($conn, $sql, $id);
        $producte = pg_fetch_row($stmt);

        return $producte;
    }
}
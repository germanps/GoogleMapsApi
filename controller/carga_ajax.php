<?php 
	
	require "conexion.php";
	$cat = $_POST['categoria'];
	$con = conexion();

	//hacemos consulta para saber el id según el string categoria que viene del front
	$cat_query = "select id_categoria from categoria where nombre='$cat'";
	$cat_resul = mysqli_query($con, $cat_query);
	while ($fila = mysqli_fetch_array($cat_resul)) {
		extract($fila);
		$id_cat = $id_categoria;
	}

	//seleccionamos las filas de la categoría indicada
	$query = "select * from marcador where categoria=$id_cat";
	$marcadores = $con->query($query);
	$array_marcadores = [];
	while ($marcador = mysqli_fetch_array($marcadores, MYSQLI_ASSOC)) {
		$array_marcadores[] = $marcador;
	}
	echo json_encode($array_marcadores);


 ?>
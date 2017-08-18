<?php 
	require "conexion.php";
	$nombre = $_POST['titulo_mark'];
	$desc = $_POST['desc_mark'];
	$categoria = $_POST['cat_mark'];
	$co_x = $_POST['coox'];
	$co_y = $_POST['cooy'];
	//echo "$nombre, $desc, $categoria, $co_x, $co_y";


	$con = conexion(); //llamamos a la función donde conectaremos a la bd
	//comprobamos el id categoria por su nombre
	$cat_query = "select id_categoria from categoria where nombre='$categoria'";
	$cat_resul = $con->query($cat_query);
	while ($fila = $cat_resul->fetch_array()) {
		extract($fila);
		$id_cat = $id_categoria;
	}
	//hacemos el insert

	/*
	*NOTA: A la que quito el id_marcador y el value de null peta (así funciona bien y *autoincrementa el id_marcador sin problemas
	*/
	
	$insert_mark_query = "insert into marcador(id_marcador, nombre, descripcion, coox, cooy, categoria) values('null','$nombre', '$desc', $co_x, $co_y, $id_cat)";
	$insert_mark_result = $con->query($insert_mark_query);
	$con->close();
	header("Location: ../index.php");

 ?>
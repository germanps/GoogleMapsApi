<?php 
	require "conexion.php";
	$nombre = $_POST['nombre_cat'];

	$con = conexion();
	//cambiar el null!!!!
	$insert_cat_query = "insert into categoria(nombre) values('$nombre')";
	$insert_cat_result = $con->query($insert_cat_query);
	$con->close();
	header("Location: ../index.php");

 ?>
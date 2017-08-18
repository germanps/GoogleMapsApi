<?php 

	function conexion(){
		$con = new mysqli("localhost","root","", "googleapi") or die("Error en la conexión con la base de datos");
		return $con;
	}

 ?>
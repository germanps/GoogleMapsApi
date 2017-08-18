<?php 
	require "controller/conexion.php";
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=divice-width, initial-scale=1.0">
	<title>Api google Maps</title>
	<link rel="stylesheet" href="src/css/bootstrap.min.css">
	<link rel="stylesheet" href="src/css/main.css">
</head>
<body>
	<header>
		<div class="logo">
			<img src="src/img/gmapsapi.png" alt="Logo google maps">
		</div>
	</header>
	<section class="container">
		<div class="row">
			<div class="info col-md-6">
				<div class="form-type">
					<form id="formMark" class="form-horizontal" action="controller/new_mark.php" method="post">
					    <fieldset>
						    <legend class="sq-collapse">Agregar marcador <span class="small text-info">Pincha en el mapa!</span></legend>
						    <div class="sq-content">
							    <div class="form-group has-success">
							        <label for="titulo" class="col-lg-3 control-label">Título : </label>
							      	<div class="col-lg-9 sq-relative">
							            <input type="text" name="titulo_mark" class="form-control" id="titulo" placeholder="Título">
							            <span class="sq-aviso">Acaba de completar el formulario!</span>
							        </div>
							    </div>
							    <div class="form-group has-success">
							        <label for="textArea" class="col-lg-3 control-label">Descripción</label>
							        <div class="col-lg-9">
							            <textarea class="form-control" name="desc_mark" rows="3" id="textArea"></textarea>
							        </div>
							    </div>
							    <div class="form-group has-success">
							        <label for="categoria" class="col-lg-3 control-label">Categoría</label>
							        <div class="col-lg-9">
							            <select class="form-control" id="categoria" name="cat_mark">
							            	<option selected>Categorias</option>
								            <?php 
								            	$con = conexion();
								            	$cat_query = "select nombre from categoria";
								            	$cat_result = $con->query($cat_query);
								            	$cat_rows = $cat_result->num_rows;
								            	if ($cat_rows == 0) {
								            		echo "No se encuentran categorias";
								            	}else{
								            		while ($fila_cat = $cat_result->fetch_array()) {
								            			extract($fila_cat);
								            			echo "<option value='$nombre'>$nombre</option>";
								            		}
								            	}
								            	$con->close();
								            ?>
							            </select>
							        </div>
							    </div>
							    <div class="form-group has-success">
							        <label for="cooX" class="col-lg-3 control-label">Coordenada X : </label>
							      	<div class="col-lg-9">
							            <input type="text" name="coox" readonly="true" class="form-control" id="cooX" placeholder="Coordenada X">
							        </div>
							    </div>
							    <div class="form-group has-success">
							        <label for="cooY" class="col-lg-3 control-label">Coordenada Y : </label>
							      	<div class="col-lg-9">
							            <input type="text" name="cooy" readonly="true" class="form-control" id="cooY" placeholder="Coordenada Y">
							        </div>
							    </div>							
							    <div class="form-group">
							        <div class="col-lg-9 col-lg-offset-3">
								        <button type="submit" class="btn btn-primary">Agregar Marcador</button>
							        </div>
							    </div>
						    </div>
					    </fieldset>
					</form>
				</div>	
			</div>
			<div class="info col-md-6">
				<div class="form-type col-md-12 margin-bottom">
					<form id="formCat" class="form-horizontal" action="controller/new_cat.php" method="post">
					    <fieldset>
						    <legend class="sq-collapse">Agregar Categoría</legend>
						    <div class="sq-content">
							    <div class="form-group has-success">
							        <label for="nombreCat" class="col-lg-3 control-label">Nombre : </label>
							      	<div class="col-lg-9">
							            <input type="text" name="nombre_cat" class="form-control" id="nombreCat" placeholder="Nombre">
							        </div>
							    </div>						
							    <div class="form-group">
							        <div class="col-lg-9 col-lg-offset-3">
								        <button type="submit" class="btn btn-primary">Agregar Categoría</button>
							        </div>
							    </div>
						    </div>
					    </fieldset>
					</form>
				</div>
				<div class="form-type col-md-12 margin-top">
					<form id="formCat" class="form-horizontal">
					<!-- action="controller/show_mark.php" method="post" -->
					    <fieldset>
						    <legend class="sq-collapse">Mostrar marcadores <span class="small text-info">Por categoría</span></legend>
						    <div class="sq-content">
							    <div class="form-group has-success">
							        <label for="categoria" class="col-lg-3 control-label">Categoría</label>
							        <div class="col-lg-9">
							            <select class="form-control" id="catSelect" name="cat_mark">
							            	<option selected>Categorias</option>
								            <?php 
								            	$con = conexion();
								            	$cat_query = "select nombre from categoria";
								            	$cat_result = $con->query($cat_query);
								            	$cat_rows = $cat_result->num_rows;
								            	if ($cat_rows == 0) {
								            		echo "No se encuentran categorias";
								            	}else{
								            		while ($fila_cat = $cat_result->fetch_array()) {
								            			extract($fila_cat);
								            			echo "<option value='$nombre'>$nombre</option>";
								            		}
								            	}
								            	$con->close();
								            ?>
							            </select>
							        </div>
							    </div>					
							    <div class="form-group">
							        <div class="col-lg-9 col-lg-offset-3">
								        <input id="ajax" type="button" class="btn btn-primary" value="Mostrar marcadores">
							        </div>
							    </div>
						    </div>
					    </fieldset>
					</form>
				</div>
				<h3 id="sqResul" class="text-warning sq-resul">Hemos encontrado <span id="resultado"></span> coincidencias</h3>
			</div>
		</div>
	</section>
	<section class="container-fluid">
		<div class="row">
			<div class="mapa col-md-12">
				<div id="map"></div>
			</div>
		</div>
	</section>
	<section id="sqInfo" class="container-fluid">
		<div class="row sq-info-wrapper">
			<i id="closeModal" class="glyphicon glyphicon-remove sq-close"></i>
			<div class="sq-ifo">
				<h3 class="text-warning inline-block"></h3>
				<h4 class="text-info">Descripción</h4>
				<p></p>
				<h5 class="text-info">Coordenadas:</h5>
				<span class="sq-coo"></span>
			</div>
		</div>
	</section>
	
	
      <script src="src/js/vendor/jquery-3.1.1.js"></script>
      <script src="src/js/vendor/bootstrap.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_C9RkpnCJdykKCgNif-jxnPtWCq65ecU&callback=initMap"async defer></script>
      <script src="src/js/main.js"></script>
</body>
</html>
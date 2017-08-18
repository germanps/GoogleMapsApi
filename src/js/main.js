/*GOOGLE MAPS API*/
//Array con los marcadores
var marcadores = [];
//Marcadores que vienen de la BD
var marcadoresBd = [];
//nuestro mapa
var map = null;
//marcadores
var mark = "";
//posiciones
var pos = "";

//quitar marcadores
function dropMarks(lista){
	//recorremos el array de marcadores
	for (i in lista) {
		//se quita el marcador del mapa
		lista[i].setMap(null);
	}
}


function initMap() {

	var formulario = $('#formMark');

	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 41.3850639, lng: 2.1734034999999494},
		scrollwheel: false,
		zoom: 14,
		mapTypeId: google.maps.MapTypeId.TERRAIN
	});
	//obtener coordenadas
	google.maps.event.addListener(map, "click", function(e){
	//Coordenadas
		var coordenadas = e.latLng.toString();

		//quitar parentesis
		coordenadas = coordenadas.replace("(","");
		coordenadas = coordenadas.replace(")","");

		//por separado, devuelve un array
		var lista = coordenadas.split(",")
		console.log("Las coordenadas X son: "+lista[0]);
		console.log("Las coordenadas Y son: "+lista[1]);

		//variable para dirección, punto o coordenada
		var direccion = new google.maps.LatLng(lista[0],lista[1]);

		//variable para marcador
		var marcador = new google.maps.Marker({
			position:direccion,//nuevo marcador
			map: map, //en que mapa se ubicará el marcador(objeto map)
			animation: google.maps.Animation.DROP,//como aparecerá el marcador
			draggble: false //no se podrá arrastrar el marcador
		});

		//pasamos las coordenadas al formulario
		formulario.find('#cooX').val(lista[0]);
		formulario.find('#cooY').val(lista[1]);
		formulario.find('#titulo').focus();
		formulario.find('.sq-aviso').show();

		//agregamos el marcador a nuestro array de marcadores
		//"Dejamos únicamente un marcador en el mapa"
		marcadores.push(marcador);

		//agregamos un evento click al marcador
		google.maps.event.addListener(marcador, "click", function(){

		});

		//llamada a la función de borrar marcadores del mapa
		dropMarks(marcadores);

		//dejamos el último marcador en el mapa
		marcador.setMap(map);

	});
}

jQuery(document).ready(function($) {
	//Alerta para acabar de rellenar el formulario
	$('button[type="submit"]').click(function(e) {
		$('.sq-aviso').hide();
	});
	//Cerrar ventana modal info
	$('#closeModal').click(function(e) {
		var modal = $('#sqInfo')
		modal.css('display', 'none');
	});

	//LLAMADA AJAX (recupera puntos de bd)
	$('#ajax').click(function(e) {
		var cate = $('#catSelect').val();
		var args = {
			"categoria" : cate
		}
		var contador = 0;
		$.ajax({
			url: 'controller/carga_ajax.php',
			data: args, //pasamos la categoria al servidor
			dataType: 'JSON',
			type:"POST",
			success: function(rows){
				//borramos los marcadores del mapa (si los hay)
				deleteMarkers();
				for(var i in rows){
					console.log(rows[i]);
					console.log(rows[i].nombre);
					
					//coordenadas
					pos = new google.maps.LatLng(rows[i].coox, rows[i].cooy);

					//propiedades del marcador
					mark = new google.maps.Marker({
						idMark:rows[i].id_marcador,
						position:pos,
						titulo: rows[i].nombre,
						descripcion: rows[i].descripcion
					});

					//agregamos el item al array de marcadores
					marcadoresBd.push(mark);

					//imprimimos los marcadores en el mapa
					marcadoresBd[i].setMap(map);

					//asignamos el evento click (con this accedemos al elemento en sí)
					google.maps.event.addListener(marcadoresBd[i], 'click', function(){
						var modal = $('#sqInfo');
						modal.css('display','flex');
						modal.find('h3').text(this.titulo);
						modal.find('p').text(this.descripcion);
						modal.find('span').text(this.position);
					});
					console.log(marcadoresBd[i]);
					contador++;
				}
				$('#sqResul').css('display', 'inline-block');;
				$('#resultado').html(contador);
				console.log(contador);
			// Inserta en  el mapa todos los marcadores de la matriz
			function setMapOnAll(map) {
			    for (var i = 0; i < marcadoresBd.length; i++) {
			      marcadoresBd[i].setMap(map);
			    }
			}

			 // Elimina los marcadores del mapa, pero los mantiene en el array.
			 function clearMarkers() {
			    setMapOnAll(null);
			 }

			// Muestra los marcadores actualmente del array.
			function showMarkers() {
			    setMapOnAll(map);
			}

			// Eliminamos todos los marcadores del array eliminando referencias a ellos.
			function deleteMarkers() {
			    clearMarkers();
			    marcadoresBd = [];
			  }
			}
		});
		

	});
	
})


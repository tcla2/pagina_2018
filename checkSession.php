<?php
  session_start();
  require('library.php');

  if (isset($_SESSION['username'])) {
    $response['nombre'] = getInfo($_SESSION['username'], 'nombre');
	$response['apellido'] = getInfo($_SESSION['username'], 'apellido');
	$response['tipo_id'] = getInfo($_SESSION['username'], 'tipo_id');
	$response['id'] = getInfo($_SESSION['username'], 'id');
	$response['fecha_nacimiento'] = getInfo($_SESSION['username'], 'fecha_nacimiento');
	$response['estado_civil'] = getInfo($_SESSION['username'], 'estado_civil');
	$response['genero'] = getInfo($_SESSION['username'], 'genero');
	$response['tipo_telefono'] = getInfo($_SESSION['username'], 'tipo_telefono');
	$response['telefono'] = getInfo($_SESSION['username'], 'telefono');	
    $response['descripcion'] = getInfo($_SESSION['username'], 'descripcion');
    $response['email'] = getInfo($_SESSION['username'], 'email');
    $response['tiempo_docencia'] = getInfo($_SESSION['username'], 'tiempo_docencia');
	$response['estudios_superiores'] = getInfo($_SESSION['username'], 'estudios_superiores');
	$response['especializacion'] = getInfo($_SESSION['username'], 'especializacion');	
    $response['img'] = getInfo($_SESSION['username'], 'profile_img');
    $response['msj'] = "true";
  }else {
    $response['msj'] = "false";
  }

  echo json_encode($response);



 ?>

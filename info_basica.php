<?php
  session_start();
  require('c_Usuario.php');
  require('library.php');


$respuestas['save']="true";

  $user = new Usuario($_POST['nombre'], $_POST['apellido'], $_POST['tipo_id'], $_POST['identificacion'], $_POST['fecha_nacimiento'], $_POST['genero'], $_POST['estado_civil'], $_POST['tipo_telefono'], $_POST['telefono'], $_POST['email'], $_POST['tiempo_docencia'], $_POST['estudios_superiores'], $_POST['especializacion'], $_POST['descripcion']);
 
   updateData($_SESSION['username'], 'nombre', $user->nombre, 'apellido', $user->apellido, 'tipo_id', $user->tipo_id, 'id', $user->id, 'fecha_nacimiento', $user->fecha_nacimiento, 
  'genero', $user->genero, 'estado_civil', $user->estado_civil, 'tipo_telefono', $user->tipo_telefono,'telefono', $user->telefono,'email', $user->email,'tiempo_docencia', $user->tiempo_docencia,'estudios_superiores', $user->estudios_superiores,'especializacion', $user->especializacion,'descripcion', $user->descripcion); 



  echo json_encode($respuestas);
 ?>

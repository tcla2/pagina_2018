<?php

  session_start();
  require('c_Usuario.php');
  require('library.php');
  

  $data = json_decode($_POST['array']);

 

 $datos = getData();
array_push($datos, $data);

writeDataFile($datos);


$respuestas['save']="true";
$respuestas['pass']="holaa";


echo ($respuestas);
 ?>

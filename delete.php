<?php

  session_start();
  require('c_Usuario.php');
  require('library.php');


 $datos = getData();

removeElementWithValue('username', 'maria@mail.com');

echo json_encode($respuestas);

 ?>

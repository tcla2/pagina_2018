<?php
  
require('library.php');


  $password = $_POST['clave'];
  
  $password = md5($password);

  
  $respuestas=$password;
  
 echo $respuestas;
 ?>

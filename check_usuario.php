<?php
  require('library.php');


  $username = $_POST['username']; 
  
  $data = getData();  
  

    if (check_usuario($username, $data)) {     
      echo "true";	  
    }else {
      echo "false";
    }
 



 ?>

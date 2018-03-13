<?php
 include "conexionvital.php";

  function getData(){
    $data_file = fopen("data/users.json","r");
    $data_readed = fread($data_file, filesize("data/users.json"));
    $data = json_decode($data_readed, true);
    fclose($data_file);
    return $data;
  }

  function getInfo($username, $searched_item){
    foreach (getData() as $key => $value) {
      if ($username==$value['username']) {
        return $value[$searched_item];
      }
    }
  }

 

  function writeDataFile($data_array){
    if (sizeof($data_array)>0) {
      $data_file = fopen("data/users.json","w");
      fwrite($data_file, json_encode($data_array));
      fclose($data_file);
    }

  }

  
 $posts=[];
  
  $sql10 = "SELECT * FROM jos_users WHERE estado = 'administrador' OR estado = 'secretaria' OR estado = 'profesor' AND name!='' ORDER BY id ASC ";
	   $result20 = mysql_query($sql10); 				
		while($registro10=mysql_fetch_array($result20)){
	     $id=$registro10['id'];
		 $name=$registro10['name'];
		 $username=$registro10['username'];
		 $email=$registro10['email'];
		 $password=$registro10['password'];
		 $registerDate=$registro10['registerDate'];	
		 $estado=$registro10['estado'];	 
    
        echo  $posts_temp = array (
        'codigo' => $id, 'name' => $name, 'username' => $username, 'email' => $email, 'password' => $password, 'fecha_registro' => $registerDate, 'tipo_usuario' => $estado, 'nombre' => '', 'apellido' => '', 'genero' => '', 'tipo_id' => '', 'id' => '', 'estado' => '', 'estado_civil' => '', 'fecha_nacimiento' => '', 'tipo_telefono' => '', 'telefono' => '', 'profile_img' => '', 'descripcion' => '', 'tiempo_docencia' => '', 'estudios_superiores' => '', 'especializacion' => '');
  
       array_push($posts, $posts_temp);
    
  		}
				

 $datos = getData();
array_push($datos, $posts);

writeDataFile($datos);



 ?>

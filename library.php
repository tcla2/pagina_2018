<?php

  function checkLogin($user, $pass, $data){
    foreach ($data as $key => $value) {
      if ($user==$value['username']) {
        if($pass==$value['password']){
          return true;
        }
      }
    }
    return false;
  }
  
   function check_usuario($user, $data){
    foreach ($data as $key => $value) {
      if ($user==$value['username']) {       
          return true;       
      }
    }
    return false;
  }
  
  

  function getData(){
    $data_file = fopen("./data/users.json","r");
    $data_readed = fread($data_file, filesize("./data/users.json"));
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

  function updateData($username, $field_name,$field_value, $field_apell,$field_value_apell,$field_tipo_id,$field_value_tipo_id,$field_id,$field_value_id,$field_fecha,$field_value_fecha,$field_genero,$field_value_genero,$field_estado,$field_value_estado,$field_tipo_tel,$field_value_tipo_tel,$field_tel,$field_value_tel,$field_email,$field_value_email,$field_tiempo_doc,$field_value_tiempo_doc,$field_super,$field_value_super,$field_espe,$field_value_espe,$field_des,$field_value_des){
    $data = getData();
    if (isset($data)) {
      foreach ($data as $key => $value) {
        if ($value['username']==$username) {
          $data[$key][$field_name] = $field_value;
		  $data[$key][$field_apell] = $field_value_apell;
		  $data[$key][$field_tipo_id] = $field_value_tipo_id;
		  $data[$key][$field_id] = $field_value_id;
		  $data[$key][$field_fecha] = $field_value_fecha;
		  $data[$key][$field_genero] = $field_value_genero;
		  $data[$key][$field_estado] = $field_value_estado;
		  $data[$key][$field_tipo_tel] = $field_value_tipo_tel;
		  $data[$key][$field_tel] = $field_value_tel;
		  $data[$key][$field_email] = $field_value_email;
		  $data[$key][$field_tiempo_doc] = $field_value_tiempo_doc;
		  $data[$key][$field_super] = $field_value_super;
		  $data[$key][$field_espe] = $field_value_espe;
		  $data[$key][$field_des] = $field_value_des;
        }
      }
      writeDataFile($data);
    }
  }
  
   function updateData_foto($username, $field_name, $field_value){
    $data = getData();
    if (isset($data)) {
      foreach ($data as $key => $value) {
        if ($value['username']==$username) {
          $data[$key][$field_name] = $field_value;
        }
      }
      writeDataFile($data);
    }
  }
  
   function updateData_pass($username, $field_name, $field_value){
    $data = getData();
    if (isset($data)) {
      foreach ($data as $key => $value) {
        if ($value['username']==$username) {
          $data[$key][$field_name] = $field_value;
        }
      }
      writeDataFile($data);
    }
  }
  
  function sortByOrder($a, $b) {
    return $a['codigo'] - $b['codigo'];
}


  
  
  function generar_codigo(){
    $data = getData();
	usort($data, 'sortByOrder');	
    if (isset($data)) {
		$n=62;
		
      foreach ($data as $key => $value) {		  
        if ($value['codigo']==$n) {
           $n++;
        }else{
			return $n;
			}
      }     
    }
  }
  
  
  function encriptar($username, $field_name){
    $data = getData();
    if (isset($data)) {
      foreach ($data as $key => $value) {
        if ($value['username']==$username) {
          $data[$key][$field_name] = $field_value;
        }
      }
      writeDataFile($data);
    }
  }
  
  
  
 function removeElementWithValue($key, $value){
	 $data = getData();
     foreach($data as $subKey => $subArray){
          if($subArray[$key] == $value){
               unset($data[$subKey]);
          }
     }
      writeDataFile($data);
}
 
 
  

  function writeDataFile($data_array){
    if (sizeof($data_array)>0) {
      $data_file = fopen("./data/users.json","w");
      fwrite($data_file, json_encode($data_array));
      fclose($data_file);
    }

  }

  function uploadFile($nombreFile, $folder){
    $directorio = $folder."/";
    $nombreImagen = $_FILES[$nombreFile]["name"];
    $archivo_a_subir = $directorio . basename($nombreImagen);
    $tipoArchivo = pathinfo($archivo_a_subir,PATHINFO_EXTENSION);
    $tamanio_archivo = $_FILES[$nombreFile]["size"];
    $exito = true;
    $res;

    if (file_exists($archivo_a_subir)) {
      $res["mensaje"] =  "El archivo ya existe.";
      $exito = false;
    }

    if ($tamanio_archivo > 10000000) {
      $res["mensaje"] =  "El archivo es demasiado grande.";
      $exito = false;
    }

    if($tipoArchivo != "jpg" && $tipoArchivo != "png" && $tipoArchivo != "jpeg" && $tipoArchivo != "doc" && $tipoArchivo != "txt" && $tipoArchivo != "docx" && $tipoArchivo != "pdf" ) {
      $res["mensaje"] = "Solo se permiten archivos JPG, JPEG, PNG.";
      $exito = false;
    }

    if ($exito == false) {
      $res["final"] = "Lo sentimos, tu archivo no fue añadido.";
    } else {
      if (move_uploaded_file($_FILES[$nombreFile]["tmp_name"], $archivo_a_subir)) {
        $res["final"] = "El archivo ". basename($nombreImagen). " ha sido añadido.";
        $res["mensaje"] = "";
        $res["newSource"] = $archivo_a_subir;
      } else {
        $res["final"] = "Lo sentimos, tu archivo no fue añadido.";
      }
    }

    return $res;

  }







 ?>

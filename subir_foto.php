<?php
  session_start();
  require('c_Usuario_foto.php');
  require('library.php');


$res['save']="true";

 $res = uploadFile('profile_img', 'images/fotos');
 if(isset($res["newSource"])){
    $newImg = $res["newSource"];
  }else {
    $newImg = null;
  }

  $user = new Usuario2($newImg);
if($newImg != null){
  updateData_foto($_SESSION['username'], 'profile_img', $user->profile_img);
}
  echo json_encode($res);
 ?>

<?php 

$RegistrosAMostrar=10;



mysql_connect("localhost","ieisaccj_isaacj","mViu57Qz2412");
mysql_select_db("ieisaccj_demo");

$direccion = 'localhost';
$usuario = 'ieisaccj_isaacj';
$password = 'mViu57Qz2412';
$db=mysql_connect($direccion,$usuario,$password);
@mysql_query('SET COLLATION_CONNECTION=utf8mb4_general_ci');
@mysql_query("SET NAMES 'utf8'");

  $fecha = time (); 
  $m = date(m);
  $m2 = date(m)-1;
  $ma= array(Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre);
  $ml = $ma[$m2];  

  $fecha =  date(d)."/".$m."/".date(Y);
  $year=date(d)."/".$m."/".date(Y);
  $fecha_especial= date(d)." ".$ml." ".date(Y);
  
  $dia=date(d);
  $mes=$ml;
  $anno= date(Y);


 $sql = ("SELECT * FROM plantel") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql );
    $row = mysql_fetch_row($res);
	 $peri = $row[10];
   	$ano = $row[9];
	$semestre=	$row[11];
	$peri_tarde = $row[13];
	$peri_ciclo1 = $row[11];
	$peri_ciclo2 = $row[12];
	


?>
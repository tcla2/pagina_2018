<?php
session_start();
include "conexionvital.php";
 $cod_profe = $_SESSION['session_id_user'];
  
 if($cod_profe=='0'){
	header("Location: inicio_de_seccion.php");
	
} 

$sql = ("SELECT * FROM jos_users WHERE id = '$cod_profe' ") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql);
    $row = mysql_fetch_row($res);
	 $estado = $row[16];
	 
	 if($estado=="administrador"){
	 
    $cod_profe = $row[14];
	$admin=1;
	}
	
	if($estado=="Secretaria"){
	 
    $cod_profe = $row[14];
	$admin=1;
	}
	
    	  
	 
	 if(isset($_GET['profesor4'])) 
     $cod_profe=$_GET['profesor4']; 
	 
	 if(isset($_GET['year'])) 
     $year=$_GET['year']; 
	 
	 
	 
	if(isset($_GET['profesor'])) 
     $cod_profe=$_GET['profesor'];  
  
   $grupo=$_GET['grupo'];  
    
   $materia=$_GET['materia'];
   
   $_SESSION['session_id_materia']=$materia; 
   
       
  if(isset($_GET['concepto'])) 
  $concepto=$_GET['concepto'];  
  
$sql = ("SELECT * FROM agrupados WHERE id = '$grupo' ") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql );
    $row = mysql_fetch_row($res);
	$nomgrupo = $row[1];
	$sede = $row[2];
	$jornada = $row[3];
    $idgrado = $row[4];	
	$salon = $row[6];
	$gradotempo = $row[4];		
	
	
	$sqle = ("SELECT * FROM secciones_profe WHERE cod_profe = '$cod_profe' " ) or die("No se pudo realizar la consulta a la Base de datos");
    $rese = mysql_query ($sqle );
    $row = mysql_fetch_row($rese);
	$id_secc=$row[0];	
	
		
$sql = ("SELECT * FROM grados WHERE id = '$idgrado'  ") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql);
    $row = mysql_fetch_row($res);
    $nomgrado = $row[1];
	$nivel_grado = $row[5];
	$jornada_grado = $row[3];
	
	
	
	 $sql = ("SELECT * FROM plantel") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql );
    $row = mysql_fetch_row($res);
	$peri_ciclo1 = $row[11];
	$peri_ciclo2 = $row[12];
	
	
	
	
	
	if($nivel_grado=='CLII' || $nivel_grado=='CLIII' || $nivel_grado=='CLIV'){
		
		$peri=$peri_ciclo1;
		
		}
		
		if($nivel_grado=='CLV' || $nivel_grado=='CLVI'){
		
		$peri=$peri_ciclo2;
		
		}
	
	 
	
			$num_notas=5;
		
		
// Create connection

		
	

	
			
	 if(isset($_GET['per'])) 
      $peri=$_GET['per']; 
	
	if(isset($_GET['periodo'])){ 
      $peri=$_GET['periodo'];
	  
	}
	
	
	
$sql = ("SELECT * FROM sedes WHERE id = '$sede'") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql );
    $row = mysql_fetch_row($res);
	$nomsede = $row[2];
	
	$sql = ("SELECT * FROM jornadas WHERE id = '$jornada' ") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql );
    $row = mysql_fetch_row($res);
	$nomjornada = $row[1];	


$sql = ("SELECT * FROM materias WHERE id = '$materia' order by nombre asc ") or die("No se pudo realizar la consulta a la Base de datos");
    $res = mysql_query ($sql );
    $row = mysql_fetch_row($res);
    $nommate = $row[1];
	
	if($year!='')
		{
			$ano=$year;
			}
			
			
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/global.css" rel="stylesheet" type="text/css" media="screen" />


<script src="jquery-1.3.2.min.js" type="text/javascript"></script>   
<script>
$(document).ready(function(){
   $("#mayoria_edad").click(function(evento){
      if ($("#mayoria_edad").attr("checked")){
         $("#formulariomayores").css("display", "block");
      }else{
         $("#formulariomayores").css("display", "none");
      }
   });
});
</script>




<script>
function showlayer(layer){
var myLayer = document.getElementById(layer);
if(myLayer.style.display=="none" || myLayer.style.display==""){
myLayer.style.display="block";
} else {
myLayer.style.display="none";
}
}
</script>
<script language="JavaScript"> 
function simple_reloj() {
var ut=new Date();
var h,m,s;
var time=" ";
h=ut.getHours();
m=ut.getMinutes();
s=ut.getSeconds();
if(s<=9) s="0"+s;
if(m<=9) m="0"+m;
if(h<=9) h="0"+h;
time+=h+":"+m+":"+s;
document.getElementById('reloj').innerHTML=time;
tick=setTimeout("simple_reloj()",1000); 
} 
</script> 
<script type="text/javascript">
function cambiar_color_over(celda){
   celda.style.backgroundColor="#66ff33"
}
function cambiar_color_out(celda){
   celda.style.backgroundColor="#dddddd"
} 
function cambia_color(){
   celda = document.getElementById("celda" + document.fcolor.celda.value)
   celda.style.backgroundColor=document.fcolor.micolor.value
} 
  function Solo_Numerico(variable){
        Numer=parseInt(variable);
        if (isNaN(Numer)){
            return "";
        }
        return Numer;
    }
	
	 var nota_todas = [];
	
	 var user_tempo=0;
	 var user_tempo2=0;
	
     function ValNumero(Control,x,y,h,a,b,c){
		  var nota_todas_tempo = [];
		
 	var not1 = document.getElementById(a).value;
 	var not2 = document.getElementById(b).value;
 	var not3 = document.getElementById(c).value;
	

	if(not1!="")
	{	
	nota_todas_tempo[nota_todas_tempo.length] = not1;
	}	
	if(not2!="")
    {
		
	nota_todas_tempo[nota_todas_tempo.length] = not2;	
	}	
	if(not3!="")
	{	
	
	nota_todas_tempo[nota_todas_tempo.length] = not3;	
	}
		

		if(x!=user_tempo){
			user_tempo=x;
			nota_todas = [];
			} 
		
		 var def=0;
		 var total=0;
		
        Control.value=Solo_Numerico(Control.value);
		var estu = x;
		var n = Control.value;
		var cont = (n.length);
		var text2 = y;
		if(n<="50"){
		if(cont=="2"){		
		var v1 = n.charAt(0);
		var v2 = n.charAt(1);
		var valor = v1 + "." + v2;
		
		nota_todas_tempo[nota_todas_tempo.length] = valor;		
		nota_todas[nota_todas.length] = valor;
		
								
		ponPrefijo(valor,estu,y);
		Control.value=valor;
		
		if(nota_todas_tempo.length > 0 && nota_todas_tempo.length <= 4)
		{
		
		for (x=0;x<nota_todas_tempo.length;x++){      
		      def = nota_todas_tempo[x];	
			  def = parseFloat(def);
			 total= total+ def;	
					
          }
		  total=total/nota_todas_tempo.length;
		  
		}else
		{
						
		for (x=0;x<nota_todas.length;x++){      
		      def = nota_todas[x];	
			  def = parseFloat(def);
			 total= total+ def;	
					
          }		
			total=total/nota_todas.length;
			
			}
		  
		 total=  Number(total).toFixed(2); 
			
		  
		  document.getElementById(h).value = total;
		 
         document.all.sound.src = "http://www.ieisaacjpereira.edu.co/Fuzzy.mp3"

		 
		
		}
		}
	
		
    }
	
	 function ponPrefijo(pref,g,y){ 
        var user = g; 
        var nota = pref;
		var num = y;
		var peri = <? echo $peri; ?>;
		var year = <? echo $ano; ?>;
		
		
			
				$.ajax({
					type:'POST',
					url:'process.php',
					data:('nota='+nota+'&user='+user+'&num='+num+'&per='+peri+'&yer='+year),
					success:function(respuesta){
						if (respuesta==1){
							$('#mensaje').html('Tu mensaje se ha enviado correctamente');							
							
							$('#progress').html('');
														
						}
						else{
							
						}
						
					}


				})      	
} 


 function ponPrefijo4(pref,g,y){ 
        var user = g; 
        var nota = pref;	
		var peri = y;
		var year = <? echo $ano; ?>;		
			
				$.ajax({
					type:'POST',
					url:'process2.php',
					data:('nota='+nota+'&user='+user+'&per='+peri+'&yer='+year),
					success:function(respuesta){
						if (respuesta==1){
							$('#mensaje').html('Tu mensaje se ha enviado correctamente');							
							
							$('#progress').html('');
														
						}
						else{
							
						}
						
					}


				})      	
} 




 function reset_nota(pref,a,b,c,d,e){ 
      
			
			
		var peri = <? echo $peri; ?>;
		var year = <? echo $ano; ?>;
			
			
				$.ajax({
					type:'POST',
					url:'process_reset.php',
					data:('user='+pref+'&per='+peri+'&yer='+year),
					success:function(respuesta){
						if (respuesta==1){
							$('#mensaje').html('Tu mensaje se ha enviado correctamente');							
							
							$('#progress').html('');
														
						}
						else{
							
						}
						
					}


				})   
				
				limpiar(a,b,c,d,e);	
				   	
}

	
function limpiar(a,b,c,d,e)
{
	
	
		
  document.getElementById(a).value = "";
  document.getElementById(b).value = "";
  document.getElementById(c).value = "";
  document.getElementById(d).value = "";
  document.getElementById(e).value = "";
 


}
 function ponfallas(pref,g){ 
        var user = g; 
        var fallas = pref;				
		var peri = <? echo $peri; ?>;
		var year = <? echo $ano; ?>;
				
				$.ajax({
					type:'POST',
					url:'process_fallas.php',
					data:('fallas='+fallas+'&user='+user+'&per='+peri+'&yer='+year),
					success:function(respuesta){
						if (respuesta==1){
							$('#mensaje').html('Tu mensaje se ha enviado correctamente');							
							
							$('#progress').html('');
														
						}
						else{
							
						}
						
					}


				})      	
} 	

 function ValNumero2(Control,x){
	 
	var n = Control.value;	
			  
	 ponfallas(n,x);	 
	 Control.value=n;
 }



 function ValNumero3(Control,x,y){
	 
	var n = Control.value;
		var cont = (n.length);
		var text2 = y;
		if(n<="50"){
		if(cont=="2"){		
		var v1 = n.charAt(0);
		var v2 = n.charAt(1);
		var valor = v1 + "." + v2;	
		
	ponPrefijo4(valor,x,y);	
	Control.value=valor;
		}
		}
	
 }


	
	
	
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CALIFICACION RAPIDA</title>
<style type="text/css">
<!--
.Estilo16 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
.Estilo19 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo23 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo24 {font-size: 12px}
.Estilo41 {color: #003300; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo70 {font-size: 12px; color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Estilo72 {font-size: 12px; color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo82 {font-size: 14px}
.Estilo87 {font-size: 10px}
-->
</style>
<style media="print" type="text/css">
#imprimir {
visibility:hidden
}
#button3{
visibility:hidden
}
#button7{
visibility:hidden
}
</style>


</head>

<body>



<ul id="menu">
  <li><a href="">Volver ASIGNATURAS</a></li>
<li>
				<a href="#">Procesos</a>
	<ul>
                        <li><a href="planillas_llena.php?grupo=<? echo $grupo; ?>&id_materia=<? echo $materia; ?>&profe_grupo=<? echo $cod_profe; ?>" target="_blank">Imprimir planilla</a></li>
                   
                   
	</ul>
  </li>

</ul>

<form name="formulario" id="formulario" method="get" action="calificar_grupo.php">
<table width="100%" border="0" align="center">
  <tr>
    <td width="252" height="19" align="left" bgcolor="#336600"><span class="Estilo72">Asignatura</span></td>
    <td width="106" align="center" bgcolor="#336600"><span class="Estilo72">Grado</span></td>
    <td width="38" align="center" bgcolor="#336600"><span class="Estilo72">Grupo</span></td>
    <td width="160" align="center" bgcolor="#336600"><span class="Estilo72">Sede</span></td>
    <td width="100" align="center" bgcolor="#336600"><span class="Estilo72">Jornada</span></td>
    <td align="center" bgcolor="#336600"><span class="Estilo72">Periodo/Semestre</span></td>
    <td width="204" align="center" bgcolor="#336600"><span class="Estilo72">Año</span></td>
  </tr>
  <tr>
     <td align="left"  ><span class="Estilo24 Estilo19"><strong><? echo $nommate;?></strong></span></td>
    <td align="center" ><span class="Estilo24 Estilo19"><strong><? echo $nomgrado; ?></strong></span></td>
    <td align="center"><span class="Estilo24 Estilo19"><strong>
      <?  echo $nomgrupo; ?>
    </strong></span></td>
    <td align="center" ><span class="Estilo24 Estilo19"><strong><? echo $nomsede; ?></strong></span></td>
    <td align="center" ><span class="Estilo24 Estilo19"><strong><? echo $nomjornada; ?></strong></span></td>
    <td align="center" ><? echo $peri; ?></td>
    <td align="center" ><span class="Estilo16"><? echo $ano; ?></span></td>
  </tr>
</table>

<div id="formulariomayores" style="display: none;">
<iframe width="100%" height="230px" src="seleccionar_indicadores.php" name="iframe_a"></iframe>
</div>


<table width="100%" border="0" align="center" cellspacing="1">
    <tr class="Estilo23">
     <td height="30" colspan="10" align="left" bgcolor="#FFCC66" class="Estilo23"><img src="images/docu.png" width="31" height="25" />
       <input type="checkbox" name="mayor_edad" value="1" id="mayoria_edad">
       Ver seleccionar Indicadores</td>
    <td align="center" valign="middle" bgcolor="#FFCC66" class="Estilo23">&nbsp;</td>
    <td colspan="4" align="center" bgcolor="#FFCC66" style="font-weight: bold">Notas por periodos</td>
    <td width="66" align="center" bgcolor="#FFCC66">&nbsp;</td>
    <td width="395" align="center" bgcolor="#FFCC66">&nbsp;</td>
  </tr>
  <tr class="Estilo23">
    <td width="15" height="28" align="center" bgcolor="#FFFFFF" class="Estilo23">Nº</td>
    <td width="16" align="center" bgcolor="#FFFFFF" class="Estilo23"><strong>id</strong></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF" class="Estilo23"><strong>Nombre Completo del Estudiante</strong></td>
    <td width="15" align="center" valign="middle" bgcolor="#FFFFFF" class="Estilo23">N1</td>
   <? if($num_notas>=2){ ?> <td width="15" align="center" valign="middle" bgcolor="#FFFFFF" class="Estilo23">N2</td><? } ?>
   <? if($num_notas>=3){ ?> <td width="15" align="center" valign="middle" bgcolor="#FFFFFF" class="Estilo23">N3</td><? } ?>
   <? if($num_notas>=4){ ?> <td width="15" align="center" valign="middle" bgcolor="#FFFFFF" class="Estilo23">N4</td><? } ?>
   <? if($num_notas>=5){ ?> <td width="38" align="center" valign="middle" bgcolor="#FFFFFF" class="Estilo23">&nbsp;</td>
   <td width="39" align="center" valign="middle" bgcolor="#FFFFFF" class="Estilo23">Definitiva</td>
   <? } ?>
    <td width="37" align="center" valign="middle" bgcolor="#FFFFFF" class="Estilo23"><strong>Nº Fallas</strong></td>
    <td width="31" align="center" bgcolor="#FFFFFF" style="font-weight: bold">1ro</td>
    <td width="29" align="center" bgcolor="#FFFFFF" style="font-weight: bold">2do</td>
    <td width="28" align="center" bgcolor="#FFFFFF" style="font-weight: bold">3ro</td>
    <td width="26" align="center" bgcolor="#FFFFFF" style="font-weight: bold">4to</td>
    <td align="center" bgcolor="#FFFFFF"><p>Acumulado</p>
      <p>Total</p></td>
    <td width="395" align="center" bgcolor="#FFFFFF" style="font-weight: bold">Proxima nota</td>
    </tr>
		<?
				 
		$sql10 = "SELECT id,grupo,estado,name FROM jos_users WHERE grupo = '$grupo' AND estado='matriculado' ORDER BY name ";
	   $result20 = mysql_query($sql10); 
	   $N=0;
		$N1=0;
		$N2=0;
		$N3=0;
		$N4=0;
		$N5=0;
		$cont=0;
		$tab1=1;
		$tab2=2;
		
		
		
		
		while($registro10=mysql_fetch_array($result20)){
	   $estu=$registro10['id'];
	     
	   
	   $notser=0;
	   
	   $N1++;
	   	   
	   if($num_notas>=2)
	   $N2++;
	   
	   if($num_notas>=3)
	   $N3++;
	   
	   if($num_notas>=4)
	   $N4++;
	   
	   if($num_notas>=5)
	   $N5++;
	   
	 	$N++;  
	   
	   
	   $text="nota11"."$N1";
	   $text2="nota22"."$N2";
	   $text3="nota33"."$N3";
	   $text4="nota44"."$N4";
	   $text5="nota55"."$N5";
	   $text6="nota66"."$N6";
	   $text7="nota77"."$N7";	
	   $text8="num"."$N";	
	   $text9="definitiva"."$N";
	   $text10="definitiva1"."$N";
	   $text11="definitiva2"."$N";
	   $text12="definitiva3"."$N";
	   $text13="definitiva4"."$N";
	   

      $sql = ("SELECT * FROM notas_todas WHERE cod_estudiante = '$estu'  AND id_materia='$materia' AND periodo='$peri' AND year='$ano'");
      $res=mysql_query($sql);
      $row = mysql_fetch_row($res);
   
	  
	       $sql1 = ("SELECT * FROM notas_todas WHERE cod_estudiante = '$estu'  AND id_materia='$materia' AND periodo='1' AND year='$ano'");
      $res1=mysql_query($sql1);
      $row1 = mysql_fetch_row($res1);
      $nota_1=$row1[8];
	  
	  
	  
	   $sql2 = ("SELECT * FROM notas_todas WHERE cod_estudiante = '$estu'  AND id_materia='$materia' AND periodo='2' AND year='$ano'");
      $res2=mysql_query($sql2);
      $row2 = mysql_fetch_row($res2);
      $nota_2=$row2[8];	  	
	 
	  
	   $sql3 = ("SELECT * FROM notas_todas WHERE cod_estudiante = '$estu'  AND id_materia='$materia' AND periodo='3' AND year='$ano'");
      $res3=mysql_query($sql3);
      $row3 = mysql_fetch_row($res3);
      $nota_3=$row3[8];	  	
	
	 
	
	   $sql4 = ("SELECT * FROM notas_todas WHERE cod_estudiante = '$estu'  AND id_materia='$materia' AND periodo='4' AND year='$ano'");
      $res4=mysql_query($sql4);
      $row4 = mysql_fetch_row($res4);
      $nota_4=$row4[8];	  	
	 
	
	  
	  
	  
	   $contador=1;	  
	    
 $sql4 = ("SELECT * FROM inasistencias WHERE cod_estu = '$estu'  AND cod_materia='$materia' AND periodo='$peri' AND ano='$ano'");
      $res4=mysql_query($sql4);
      $row4 = mysql_fetch_row($res4);
      $inasisten=$row4[7];

	
		
		   	   
	      ?>
 <tr>
 
    <td height="71" align="center" bordercolor="#FFFFFF" bgcolor="#dddddd" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)"><? echo $N; ?></td>
    <td height="71" align="center" bordercolor="#FFFFFF" bgcolor="#dddddd" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)"><strong><? echo $registro10['id'];?></strong></td>
    <td width="92" height="71" align="center" bordercolor="#FFFFFF" bgcolor="#dddddd" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)"><a href="registro_estudiante_notas.php?codigo=<? echo $registro10['id']; ?>&materia=<? echo $materia; ?>" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=980,lightwindow_height=410"><span class="Estilo26">ver</span></a></td>
    <td width="443" align="left" bordercolor="#FFFFFF" bgcolor="#DDDDDD" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)"><span class="Estilo82 Estilo19 Estilo41"><span class="Estilo82 Estilo19 Estilo24 Estilo24 Estilo24 Estilo24"><strong><? echo  '<a href="observador.php?asignatura='.$materia.'&codigo='.$registro10['id'].'">'.$registro10['name'].'</a>';  ?></strong></span></span></td>
    <td align="center" bordercolor="#FFFFFF" bgcolor="#dddddd" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)"><input name="<? echo $text; ?>" type="text" id="<? echo $text; ?>" onkeyup="ValNumero(this,'<? echo $estu; ?>','1','<? echo $text9; ?>','<? echo $text2; ?>','<? echo $text3; ?>','<? echo $text4; ?>')" size="2" maxlength="2" value="<?  if($notafin!='' && $notafin!=0){
	$cont++;}
	
	
	echo $n1=$row[12];?>" tabindex="<? echo $tab1; ?>"/></td>
 <? if($num_notas>=2){  ?>    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD">
      <input name="<? echo $text2; ?>" type="text" id="<? echo $text2; ?>" onkeyup="ValNumero(this,'<? echo $estu; ?>','2','<? echo $text9; ?>','<? echo $text; ?>','<? echo $text3; ?>','<? echo $text4; ?>')" size="2" maxlength="2" value="<?  if($notafin2!='' && $notafin2!=0){
	$cont++;}
	
	
	echo $n2=$row[13];?>" tabindex="<? echo $tab1; ?>"/></td> <? } ?>
 <? if($num_notas>=3){ ?>   <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input name="<? echo $text3; ?>" type="text" id="<? echo $text3; ?>" onkeyup="ValNumero(this,'<? echo $estu; ?>','3','<? echo $text9; ?>','<? echo $text; ?>','<? echo $text2; ?>','<? echo $text4; ?>')" size="2" maxlength="2" value="<?  if($notafin3!='' && $notafin3!=0){
	$cont++;}
	
	
	echo $n3=$row[14];?>" tabindex="<? echo $tab1; ?>"/></td><? } ?>
 <? if($num_notas>=4){ ?>   <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input name="<? echo $text4; ?>" type="text" id="<? echo $text4; ?>" onkeyup="ValNumero(this,'<? echo $estu; ?>','4','<? echo $text9; ?>','<? echo $text; ?>','<? echo $text2; ?>','<? echo $text3; ?>')" size="2" maxlength="2" value="<?  if($notafin4!='' && $notafin4!=0){
	$cont++;}
	
	
	echo $n4=$row[15];?>" tabindex="<? echo $tab1; ?>"/></td><? } ?>
 <? if($num_notas>=5){ ?>   <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input type="button" name="button" id="button" value="Reset" onclick="reset_nota('<? echo $estu; ?>','<? echo $text; ?>','<? echo $text2; ?>','<? echo $text3; ?>','<? echo $text4; ?>','<? echo $text9; ?>')" /></td>
 <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input name="<? echo $text9; ?>" id="<? echo $text9; ?>" type="text" value="<? echo $notafin=$row[8]; ?>" size="2" maxlength="2" disabled="disabled" /></td>
 <? } ?>
    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD" class="Estilo16"><input name="<? echo $text8; ?>" type="text" id="<? echo $text8; ?>" onkeyup="ValNumero2(this,'<? echo $estu; ?>')" size="2" maxlength="2" value="<? echo $inasisten;?>" tabindex="<? echo $tab2; ?>"/></td>
    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input name="<? echo $text10; ?>" type="text" id="<? echo $text10; ?>" onkeyup="ValNumero3(this,'<? echo $estu; ?>','1')" size="2" maxlength="2" value="<? if($nota_1!=''){ $acumulado_1=$nota_1*0.25;   echo $nota_1; } ?>" tabindex="<? echo $tab1; ?>"/></td>
    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input name="<? echo $text11; ?>" type="text" id="<? echo $text11; ?>" onkeyup="ValNumero3(this,'<? echo $estu; ?>','2')" size="2" maxlength="2" value="<? if($nota_2!=''){ $acumulado_2=$nota_2*0.25;   echo $nota_2; } ?>" tabindex="<? echo $tab1; ?>"/></td>
    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input name="<? echo $text12; ?>" type="text" id="<? echo $text12; ?>" onkeyup="ValNumero3(this,'<? echo $estu; ?>','3')" size="2" maxlength="2" value="<? if($nota_3!=''){ $acumulado_3=$nota_3*0.25;   echo $nota_3; } ?>" tabindex="<? echo $tab1; ?>"/></td>
    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><input name="<? echo $text13; ?>" type="text" id="<? echo $text13; ?>" onkeyup="ValNumero3(this,'<? echo $estu; ?>','4')" size="2" maxlength="2" value="<? if($nota_4!=''){ $acumulado_4=$nota_4*0.25;   echo $nota_4; } ?>" tabindex="<? echo $tab1; ?>"/></td>
    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><?  $acumulado_4=$nota_4*0.25;  $acumulado_4=round($acumulado_4,2); $acumulado_4=$acumulado_1+$acumulado_2+$acumulado_3+$acumulado_4;  echo $acumulado_4;   ?></td>
    <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#DDDDDD"><? if($peri=='3' || $peri=='4'){    $proxima_nota=3-$acumulado_4;
     $proxima_nota=$proxima_nota*100/25;
       
	  $conteo25 = strlen($proxima_nota);
	  $proxima_nota=round($proxima_nota, 1); 
if($conteo25 == '1'){
 $proxima_nota= $proxima_nota."."."0";
}	 	  
	   
	     if($proxima_nota<='0'){
	     	
         $proxima_nota="0.0";

	     }
	      if($proxima_nota=='0'){
	     	
         $proxima_nota="AA";

	     }

           if($proxima_nota>5){
           	
             $proxima_nota="NA";

           }}  echo $proxima_nota;   ?></td>
    </tr>

<tr>

		<? $X='';
	  	$notser=''; 
		$serfin='';  
		$acumulado_1='';
		$acumulado_2='';
		$acumulado_3='';
		$acumulado_4='';
		
		
		$tab1+=2;
		$tab2+=2;
		
	   }
	   
	  $sql = ("SELECT * FROM carga_academica WHERE cod_grupo = '$grupo'  AND id_materia='$materia' ");
      $res=mysql_query($sql);
      $row = mysql_fetch_row($res);
      $cod_carga=$row[0]; 
	   
	$sSQL="Update  carga_academica Set calificados = '$cont' Where id = '$cod_carga' ";
       mysql_query($sSQL); 
	   
	   	   
?>
<td height="20" colspan="12" align="center" bgcolor="#006633"><span class="Estilo23">
  <label></label>
</span>  <label></label><span class="Estilo23">
  <label></label>
  <label>
   <input name="per" type="hidden" value="<?php echo $peri; ?>" />
      <input name="profesor" type="hidden" value="<?php echo $cod_profe; ?>" />
        <input name="grupo" type="hidden" value="<?php echo $grupo; ?>" />
        <input name="materia" type="hidden" value="<?php echo $materia; ?>" />
  </label>
</span></td>
</tr>
</table>
</form>
</body>
</html>
var pass;

$(function(){
  userLogged();
  init_datos();
   
		
  $('.preloader-wrapper').hide()
  $( document ).ajaxStart(function() {
    $( ".preloader-wrapper" ).show();
  });
  $( document ).ajaxStop(function() {
    $( ".preloader-wrapper" ).hide();
  });

 
  

   $('.desc-form').submit(encriptar_clave);

       
})

function iniciar_tabla(){	
 		  $('#dataTables-example').DataTable({	    
             responsive: true,
			"language": {        
			"sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
			"oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
            }
        }
        });
}



 function ver_usuario(control){
	 	var d = control;
	$.ajax({
			url: "../data/users.json",
			success: function(datos){				
			var data_filter = $.grep( datos , function( n, i ) {
  return n.codigo == d});   
			console.log(data_filter)
							
			if(data_filter != null && $.isArray(data_filter)){
            
            $.each(data_filter, function(index, value){
             
            $('#myModal').modal('show'); 
			
            });
			
				
	
        }	
				
				
				
				 
					
			}
		});	
		
		}



 function init_datos(){
	 var v = 'Profesor';
	 	
	$.ajax({
			url: "../data/users.json",
			success: function(datos){				
			/*var data_filter = $.grep( datos , function( n, i ) {
  return n.tipo_usuario=== v;});   */ /* para filtrar*/
				datos.sort(function (a, b) {
    return a.name.localeCompare(b.name);
});
					
			
			if(datos != null && $.isArray(datos)){
            /* Recorremos tu respuesta con each */
			 $("<tbody>").appendTo("#dataTables-example");	
			 
			 var n =1;		
            $.each(datos, function(index, value){
               var newRow =
            "<tr class='even gradeC' onClick='ver_usuario("+value.codigo+")'>"
			+"<td align='center'>"+n+"</td>"
            +"<td>"+value.name+"</td>"
            +"<td align='center'>"+value.tipo_usuario+"</td>"
			+"<td>"+value.email+"</td>"
			+"<td>"+value.username+"</td>"			
            +"</tr>";
            $(newRow).appendTo("#dataTables-example tbody"); /* Vamos agregando a nuestra tabla las filas necesarias */
             n++;
            });
			
			iniciar_tabla();		
	
        }	
				
				
				
				 
					
			}
		});	
		
		}
		
		
		
		
		
function filtro(i,n){
        return n.estado==='Profesor';
    }

function subir(event){	
  event.preventDefault();
   var form_data = getInfoForm_foto();    
    $.ajax({
    url: '../subir_foto.php',
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(data){
		 if (data.mensaje != "") {
        alert(data.mensaje+". "+data.final);
      }else {
       alert("La imagen se guardo correctamente!");
            window.location.href = 'basic_info.html';
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
  })

}
function encriptar_clave(event){	
  event.preventDefault();
	var clave = $("[name='password']").val();
	
	    $.ajax({		type:'POST',
					url:'../encriptar.php',
					data:('clave='+clave),
					success:function(respuesta){
						if (respuesta!=''){
													  
							 generar_clave(respuesta)													
						}						
					}
				})				
}

function generar_clave(pass){	
 
	var clave = '1';
	
	    $.ajax({		type:'POST',
					url:'../generar_clave.php',
					dataType: "text",
					data:('clave='+clave),
					success:function(respuesta){
						if (respuesta!=''){
							 check_usuario(pass, respuesta); 
																					
						}						
					}
				})				
}


function check_usuario(pass,res){
   var d = new Date();
  var username = $("[name='usuario']").val();  
  var form_data = new FormData();
  form_data.append('username', username);  
  $.ajax({
    url: '../check_usuario.php',
    dataType: "text",
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(data){
      if (data=="true") {
		alert("usuario "+ $("[name='usuario']").val() + " ya encuentra registrado en el sistema")
		document.getElementById('usuario').value=""; 	
		document.getElementById('usuario').focus();      
      }else {	
    	 		var nombre = $("[name='nombre']").val()+' '+$("[name='apellido']").val();
				nombre = nombre.toUpperCase();
	  var data = { "codigo":res,"name":nombre,"username":$("[name='usuario']").val(),"email":"","password": pass,"fecha_registro": d,"tipo_usuario": $("[name='tipo_usuario']").val(),"nombre":$("[name='nombre']").val() ,"apellido":$("[name='apellido']").val(),"genero":"","tipo_id":"","id":"","estado":"","estado_civil":"","fecha_nacimiento":"","tipo_telefono":"","telefono":"","profile_img":"","descripcion":"","email":"","tiempo_docencia":"","estudios_superiores":"","especializacion":""}; 	     								
				writeDataFile(data)	
      }
    },
    error: function(){
      alert("error al enviar los datos");
    }
  });
}
 

function writeDataFile(data_final){	

    $.ajax({
          type: "POST",
          url: '../nuevo.php',
          data: {'array':JSON.stringify(data_final),   
          success: function(dato){			    
		 	 alert("usuario "+ $("[name='usuario']").val() + " Se guardo correctamente")
			 window.location.href = 'usuarios.html'; 
        }
		  } });	

}

function eliminar(event){	
  event.preventDefault();
   var data = {"username": "luna"};    
								
				deleteDataFile(data)
	   
}

function deleteDataFile(data_final){	

    $.ajax({
          type: "POST",
          url: '../delete.php',
          data: {'array':JSON.stringify(data_final),   
          success: function(dato){			  
alert("listo") 
        }
		  } });	

}



function getInfoForm_foto(){
	
    var form_data = new FormData();
    form_data.append('profile_img', $("[name='profile_img']").prop('files')[0]);

   return form_data;
}



function userLogged(){
  $.ajax({
    url: "../checkSession.php",
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    type: 'post',
    success: function(response){
      if (response.msj == "true") {
        setTitles(response.nombre);
      }else {
        window.location.href = 'login.html';
      }
    },
    error: function(){
      window.location.href = 'login.html';
    }
  })
}


function setTitles(nombre,apellido,tipo_id,id,fecha_nacimiento,genero,estado,tipo_telefono,telefono,img){		
			
 var icon = $('.dropdown-button i');
  $('.dropdown-button').text(nombre).append(icon);  		
		
  
}

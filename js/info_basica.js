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

  $('.desc-form').submit(submitInfo);
  
   $('#subir_foto').click(subir);
    
   
  
})

function init_datos(){	
	$.ajax({
			url: "../data/users.json",
			success: function(datos){
				ver_todos(datos);			
			}
		});	
		} 
		
		function ver_todos(datos){	
	
	
var my_json = JSON.stringify(datos)
//We can use {'name': 'Lenovo Thinkpad 41A429ff8'} as criteria too
var filtered_json = find_in_object(JSON.parse(my_json), {tipo_usuario: 'Profesor'});
	
	             console.log(filtered_json);
  
	}	
		
function find_in_object(my_object, my_criteria){

  return my_object.filter(function(obj) {
    return Object.keys(my_criteria).every(function(c) {
      return obj[c] == my_criteria[c];
    });
  });

}

function submitInfo(event){	
  event.preventDefault();
  var form_data = getInfoForm();  
  
  $.ajax({
    url: '../info_basica.php',
    dataType: 'json',
    cache: false,
	encoding:"UTF-8",
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(data){
      if (data.mensaje != "" ) {        
		if(data.save == "true"){
			alert("Los datos fueron guardadosa correctamente!");			
			
            window.location.href = 'basic_info.html';			  
			}	
		
      }else {
		alert("Los datos fueron guardadosa correctamente!");
        window.location.href = 'basic_info.html';
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
  })
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



function getInfoForm(){
	
  var form_data = new FormData();
  form_data.append('nombre', $("[name='nombre']").val());
  form_data.append('apellido', $("[name='apellido']").val());
  form_data.append('tipo_id', $("[name='tipo_id']").val());
  form_data.append('identificacion', $("[name='identificacion']").val());
  form_data.append('fecha_nacimiento', $("[name='fecha_nacimiento']").val());
   var porId= document.getElementById("male").checked;   
   if(porId==true){
  form_data.append('genero', $("[id='male']").val());
   }else{
	   form_data.append('genero', $("[id='fale']").val());
	   }  
  form_data.append('estado_civil', $("[name='estado_civil']").val());
  form_data.append('tipo_telefono', $("[name='tipo_telefono']").val());
  form_data.append('telefono', $("[name='telefono']").val());
  form_data.append('email', $("[name='email']").val());
  form_data.append('tiempo_docencia', $("[name='tiempo_docencia']").val());
  form_data.append('estudios_superiores', $("[name='estudios_superiores']").val());
  form_data.append('especializacion', $("[name='especializacion']").val());
  form_data.append('descripcion', $("[name='descripcion']").val()); 
  

   return form_data;
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
        setTitles(response.nombre, response.apellido, response.tipo_id, response.id, response.fecha_nacimiento, response.genero, response.estado_civil, response.tipo_telefono,response.telefono,response.img,response.descripcion,response.email,response.tiempo_docencia,response.estudios_superiores,response.especializacion);
      }else {
        window.location.href = 'login.html';
      }
    },
    error: function(){
      window.location.href = 'login.html';
    }
  })
}

 

function setTitles(nombre,apellido,tipo_id,id,fecha_nacimiento,genero,estado,tipo_telefono,telefono,img,descripcion,email,tiempo_docencia,estudios_superiores,especializacion){			
						
		$("[name='nombre']").val(nombre);
		$("[name='apellido']").val(apellido);
		$('#tipo_id option[value=' + tipo_id + ']').attr('selected', true);
		$("[name='identificacion']").val(id);
		$("[name='fecha_nacimiento']").val(fecha_nacimiento);	
		if(genero=="masculino"){			
		$("[id='male']").prop('checked', true);
		}
		if(genero=="femenino"){					
		$("[id='fale']").prop('checked', true);
		}
		$('#estado_civil option[value=' + estado + ']').attr('selected', true);
		$('#tipo_telefono option[value=' + tipo_telefono + ']').attr('selected', true);		
		$("[name='telefono']").val(telefono);
		$("[name='email']").val(email);
		$('#tiempo_docencia option[value=' + tiempo_docencia + ']').attr('selected', true);
		$("[name='email']").val(email);
		$("[name='estudios_superiores']").val(estudios_superiores);
		$("[name='especializacion']").val(especializacion);
		$("[name='descripcion']").val(descripcion);
			
		
		
			
 var icon = $('.dropdown-button i');
  $('.dropdown-button').text(nombre).append(icon);
  if (img == null || img == "") {	 
    $('.card-image img').attr('src', '../images/avt.PNG');
  }else {
    $('.card-image img').attr('src', '../' + img);
  }
		
		
  
}

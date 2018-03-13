$(document).ready(function() {
  userLogged();
  $('select').material_select();

 });


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
		
        setTitles(response.nombre, response.descripcion, response.img, response.info_basica, response.hoja_vida);
      }else {
        window.location.href = 'login.html';
      }

    },
    error: function(){
      window.location.href = 'login.html';
    }
  })
}


function setTitles(nombre, descripcion, img, info_basica, hoja_vida){
  $('.nombre-user').text(nombre);
  var icon = $('.dropdown-button i');
  $('.dropdown-button').text(nombre).append(icon);
 
  if (img == null || img == "") {
    $('.card-image img').attr('src', 'img/default.png');
  }else {
    $('.card-image img').attr('src', img);
  }
 
}

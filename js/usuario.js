$(document).ready(function() {
    var funcion = '';
  var id_usuario = $("#id_usuario").val();
  
  function buscar_usuario(Datos) {
    funcion = 'buscar_usuario';
    $.post('../controlador/UsuarioController.php', (Datos, funcion), (response) => {


    });
  }


});

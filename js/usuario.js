$(document).ready(function() {
    console.log('JS cargado');
    var funcion = '';
  var id_usuario = $("#id_usuario").val();
  console.log("ID usuario:", id_usuario);
  buscar_usuario(id_usuario);
  function buscar_usuario(Datos) {
    funcion = 'buscar_usuario';
    $.post('../contralador/UsuarioController.php', {datos: Datos, funcion}, (response) => {
      console.log(response);
      if (response && response !== "null") {
        $('#nombre_us').html(response.nombre || '');
        $('#apellidos_us').html(response.apellidos || '');
        $('#dni_us').html(response.dni || '');
        $('#us_tipo').html(response.tipo || '');
        $('#edad').html(response.edad || '');
        $('#residencia_us').html(response.residencia || '');
        $('#sexo_us').html(response.sexo || '');
        $('#correo_us').html(response.correo || '');
        $('#telefono_us').html(response.telefono || '');
        $('#adicional_us').html(response.adicional || '');
      } else {
        $('#nombre_us').html('No encontrado');
        $('#apellidos_us').html('');
        $('#dni_us').html('');
        $('#us_tipo').html('');
        $('#edad').html('');
        $('#residencia_us').html('');
        $('#sexo_us').html('');
        $('#correo_us').html('');
        $('#telefono_us').html('');
        $('#adicional_us').html('');
      }
    });
   
  }


});

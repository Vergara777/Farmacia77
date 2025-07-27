$(document).ready(function() {
    console.log('JS cargado');
    var funcion = '';
    var id_usuario = $("#id_usuario").val();
    var edit = false;
    
    buscar_usuario(id_usuario);
    
    function buscar_usuario(Datos) {
        funcion = 'buscar_usuario';
        $.post('../contralador/UsuarioController.php', {datos: Datos, funcion}, (response) => {
            try {
                const data = typeof response === 'string' ? JSON.parse(response) : response;
                if (data) {
                    $('#nombre_us').html(data.nombre || '');
                    $('#apellidos_us').html(data.apellidos || '');
                    $('#dni_us').html(data.dni || '');
                    $('#us_tipo').html(data.tipo || '');
                    $('#edad').html(data.edad || '');
                    $('#residencia_us').html(data.residencia || '');
                    $('#sexo_us').html(data.sexo || '');
                    $('#correo_us').html(data.correo || '');
                    $('#telefono_us').html(data.telefono || '');
                    $('#adicional_us').html(data.adicional || '');
                }
            } catch (error) {
                console.error('Error al procesar la respuesta:', error);
            }
        });
    }

    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        funcion = 'capturar_datos';
        edit = true;
        
        $.ajax({
            url: '../contralador/UsuarioController.php',
            type: 'POST',
            data: {
                funcion: funcion,
                id_usuario: id_usuario
            },
            dataType: 'json',
            success: function(data) {
                console.log('Respuesta del servidor:', data);
                if (data && typeof data === 'object') {
                    // Solo llenamos los campos específicos que necesitamos
                    $('#telefono').val(data.telefono || '');
                    $('#correo').val(data.correo || '');
                    $('#residencia').val(data.residencia || '');
                    $('#sexo').val(data.sexo || '');
                    $('#adicional').val(data.adicional || '');
                    
                    // Agregamos una confirmación visual
                    console.log('Campos actualizados correctamente');
                } else {
                    console.error('La respuesta no es un objeto JSON válido');
                    alert('Error en el formato de datos recibidos');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.log('Respuesta raw:', xhr.responseText);
                alert('Error al intentar editar. Por favor, inténtelo de nuevo.');
            }
        });
    });
});

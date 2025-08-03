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
    // Manejar el evento de clic en el botón cancelar 
    $(document).on('click', '#cancelar', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro?',
            text: "Los cambios no guardados se perderán",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Cerrar el modal o limpiar el formulario
                $('#modal-editar').modal('hide');
                $('#form-usuario')[0].reset();
            }
        });
    });

    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        funcion = 'capturar_datos';
        edit = true;
        
      /*  $.ajax({
            url: '../contralador/UsuarioController.php',
            type: 'POST',
            data: {
                funcion: funcion,
                id_usuario: id_usuario
            },
            dataType: 'json',
            success: function(data) {
                if (data && typeof data === 'object') {
                    // Mostrar modal o form con los datos
                    $('#modal-editar').modal('show');
                    $('#telefono').val(data.telefono || '');
                    $('#correo').val(data.correo || '');
                    $('#residencia').val(data.residencia || '');
                    $('#sexo').val(data.sexo || '');
                    $('#adicional').val(data.adicional || '');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); 
            }
        });
        */
    });

    // Manejar el submit del formulario
    $(document).on('submit', '#form-usuario', function(e) {
        e.preventDefault();
        
        if(edit) {
            let telefono = $('#telefono').val();
            let residencia = $('#residencia').val();
            let sexo = $('#sexo').val();
            let adicional = $('#adicional').val();
            let correo = $('#correo').val();

            // Mostrar loading
            Swal.fire({
                title: 'Guardando cambios',
                text: 'Por favor espere...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            $.ajax({
                url: '../contralador/UsuarioController.php',
                type: 'POST',
                data: {
                    funcion: 'editar_usuario',
                    id_usuario: id_usuario,
                    telefono: telefono,
                    residencia: residencia,
                    sexo: sexo,
                    adicional: adicional,
                    correo: correo
                },
                success: function(response) {
                    try {
                        const data = typeof response === 'string' ? JSON.parse(response) : response;
                        
                        if(data.status === 'success') {
                            // Actualizar la vista
                            $('#telefono_us').html(telefono);
                            $('#residencia_us').html(residencia);
                            $('#sexo_us').html(sexo);
                            $('#correo_us').html(correo);
                            $('#adicional_us').html(adicional);
                            
                            // Cerrar modal
                            $('#modal-editar').modal('hide');
                            $('#form-usuario').trigger('reset');
                            
                            // Mostrar notificación de éxito
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Los datos se actualizaron correctamente',
                                confirmButtonColor: '#28a745',
                                timer: 5000
                                 
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'No se pudieron actualizar los datos',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    } catch(error) {
                        console.error('Error al procesar respuesta:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la respuesta del servidor',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor',
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        }
    });

    // Agregar confirmación al hacer clic en editar
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Desea editar sus datos?',
            text: "Podrá modificar su información personal",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Tu código existente para cargar el modal
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
                        if (data && typeof data === 'object') {
                            // Mostrar modal o form con los datos
                            $('#modal-editar').modal('show');
                            $('#telefono').val(data.telefono || '');
                            $('#correo').val(data.correo || '');
                            $('#residencia').val(data.residencia || '');
                            $('#sexo').val(data.sexo || '');
                            $('#adicional').val(data.adicional || '');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    });
});

$(document).ready(function() {
    console.log('JS cargado');
    let funcion = '';
    const id_usuario = $("#id_usuario").val();
    let edit = false;

    // Cargar los datos del usuario al inicio
    buscar_usuario(id_usuario);

    // Evento para el botón de cambiar imagen en el perfil
    $(document).on('click', '.cambiar-imagen-btn', function(e) {
        e.preventDefault();
        
        // Primero cargar los datos del usuario y luego abrir el modal
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
                    // Cargar los datos en el formulario
                    $('#telefono').val(data.telefono || '');
                    $('#correo').val(data.correo || '');
                    $('#residencia').val(data.residencia || '');
                    $('#sexo').val(data.sexo || '');
                    $('#adicional').val(data.adicional || '');
                    
                    // Cargar la imagen actual en el preview
                    const imagenActual = data.imagen_perfil || '../img/robert.jpg';
                    $('#preview-imagen').attr('src', imagenActual);
                    
                    // Abrir el modal
                    $('#modal-editar').modal('show');
                    
                    // Después de un momento, activar el selector de archivos
                    setTimeout(() => {
                        $('#imagen').click();
                    }, 500);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de carga',
                    text: 'No se pudo cargar la información del usuario para editar.',
                    confirmButtonColor: '#dc3545'
                });
            }
        });
    });

    // Preview de imagen cuando se selecciona un archivo
    $(document).on('change', '#imagen', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validar tipo de archivo
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no válido',
                    text: 'Solo se permiten archivos JPG, PNG y GIF',
                    confirmButtonColor: '#dc3545'
                });
                this.value = '';
                return;
            }

            // Validar tamaño (2MB máximo)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'El archivo no debe superar los 2MB',
                    confirmButtonColor: '#dc3545'
                });
                this.value = '';
                return;
            }

            // Mostrar preview
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-imagen').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    function buscar_usuario(Datos) {
        funcion = 'buscar_usuario';
        $.post('../contralador/UsuarioController.php', { datos: Datos, funcion }, (response) => {
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
                    
                    // Actualizar también los elementos del panel derecho
                    $('#telefono_display').html(data.telefono || '-');
                    $('#correo_display').html(data.correo || '-');
                    $('#residencia_display').html(data.residencia || '-');
                    $('#sexo_display').html(data.sexo || '-');
                    
                    // Actualizar todas las imágenes con la imagen de perfil
                    const imagenPerfil = data.imagen_perfil || '../img/robert.jpg';
                    $('#imagen-perfil').attr('src', imagenPerfil);
                    $('.user-image').attr('src', imagenPerfil);
                    $('#preview-imagen').attr('src', imagenPerfil);
                }
            } catch (error) {
                console.error('Error al procesar la respuesta:', error);
            }
        });
    }

    // Evento para el botón de cancelar del formulario de edición
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
                $('#modal-editar').modal('hide');
                $('#form-usuario')[0].reset();
            }
        });
    });

    // Evento de clic en el botón de edición (el que carga el modal)
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
                            $('#modal-editar').modal('show');
                            $('#telefono').val(data.telefono || '');
                            $('#correo').val(data.correo || '');
                            $('#residencia').val(data.residencia || '');
                            $('#sexo').val(data.sexo || '');
                            $('#adicional').val(data.adicional || '');
                            
                            // Cargar la imagen actual en el preview
                            const imagenActual = data.imagen_perfil || '../img/robert.jpg';
                            $('#preview-imagen').attr('src', imagenActual);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de carga',
                            text: 'No se pudo cargar la información del usuario para editar.',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            }
        });
    });

    // Manejar el submit del formulario (el botón "Guardar")
    $(document).on('submit', '#form-usuario', function(e) {
        e.preventDefault();

        if (edit) {
            let telefono = $('#telefono').val();
            let residencia = $('#residencia').val();
            let sexo = $('#sexo').val();
            let adicional = $('#adicional').val();
            let correo = $('#correo').val();

            Swal.fire({
                title: 'Guardando cambios',
                text: 'Por favor espere...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Crear FormData para incluir archivos
            const formData = new FormData();
            formData.append('funcion', 'editar_usuario');
            formData.append('id_usuario', id_usuario);
            formData.append('telefono', telefono);
            formData.append('residencia', residencia);
            formData.append('sexo', sexo);
            formData.append('adicional', adicional);
            formData.append('correo', correo);

            // Agregar imagen si se seleccionó una
            const imagenFile = $('#imagen')[0].files[0];
            if (imagenFile) {
                formData.append('imagen', imagenFile);
            }

            $.ajax({
                url: '../contralador/UsuarioController.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        const data = typeof response === 'string' ? JSON.parse(response) : response;

                        if (data.status === 'success') {
                            // Actualizar la vista con los nuevos datos
                            $('#telefono_us').html(telefono);
                            $('#residencia_us').html(residencia);
                            $('#sexo_us').html(sexo);
                            $('#correo_us').html(correo);
                            $('#adicional_us').html(adicional);
                            
                            // Actualizar también los elementos del panel derecho
                            $('#telefono_display').html(telefono);
                            $('#correo_display').html(correo);
                            $('#residencia_display').html(residencia);
                            $('#sexo_display').html(sexo);

                            // Actualizar imagen si se subió una nueva
                            if (data.nueva_imagen) {
                                $('#imagen-perfil').attr('src', data.nueva_imagen + '?t=' + new Date().getTime());
                                $('.user-image').attr('src', data.nueva_imagen + '?t=' + new Date().getTime());
                            }

                            // Cerrar modal
                            $('#modal-editar').modal('hide');
                            $('#form-usuario').trigger('reset');
                            $('#preview-imagen').attr('src', $('#imagen-perfil').attr('src'));

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
                    } catch (error) {
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
});
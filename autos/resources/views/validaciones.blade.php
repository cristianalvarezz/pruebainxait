
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const Toast = Swal.mixin({
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonColor: '#4A5C5D',
        background: '#fff',
        iconColor: '#4A5C5D',
        confirmButtonText: '<span class="btn-cancel-registro">Aceptar</span>',
        allowOutsideClick: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    $('departamento option').remove();
    $("#departamento").append('<option value="100">SELECCIONA UNA OPCIÓN*</option>');
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "{{ route('all_departments') }}"
    }).done(function(data) {
        info_dept = data;
        $.each(data, function(index, value) {
            $("#departamento").append('<option value="' + data[index].id + '">' + data[index]
                .departamento + '</option>');
        });
    }).fail(function(error) {
        console.log(error)
        $("#alert_error_general").modal("show");
    }).always(function() {});


    $('#departamento').on('change', function() {

        var dep = $("#departamento").val();
        if (dep == 100) {
            $('#ciudad option').remove();
            $("#ciudad").append('<option value="100">SELECCIONA UNA OPCIÓN*</option>');
        } else if (dep != 100 && dep < 100) {
            $('#ciudad option').remove();

            var ciudades = info_dept[dep].ciudades;

            $.each(ciudades, function(index, value) {
                $("#ciudad").append('<option value="' + index + '">' + value + '</option>');
            });
        }

    });
    $("#registro_pers").click(function() {

        let tipo_documento = $("#tipo_documento").val();
        let documento = $("#documento").val();
        let nombre = $("#nombres").val().toUpperCase();
        let apellido = $("#apellidos").val().toUpperCase();
        let departamento = $("#departamento").val();
        let ciudad = $("#ciudad").val();
        let email = $("#email").val();
        let telefono = $("#celular").val();

        let terminos = $('#terminos').prop('checked');
        let privacidad = $('#privacidad').prop('checked');

        if (tipo_documento == 0 || tipo_documento > 3 || tipo_documento < 0) {
            console.log("Error")
            $("#alert_error_registro").modal("show");
        } else if (documento.length > 10 || documento.length < 8 || !documento.match(/^[0-9]+$/)) {
            $("#alert_error_registro").modal("show");
        } else if (documento < 100) {
            $("#alert_error_registro").modal("show");
        } else if (!nombre.match(
                /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/
            )) {
            $("#alert_error_registro").modal("show");
        } else if (nombre.length < 3 || nombre.length > 60) {
            $("#alert_error_registro").modal("show");
        } else if (!apellido.match(
                /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/
            )) {
            $("#alert_error_registro").modal("show");
        } else if (apellido.length < 5 || apellido.length > 60) {
            $("#alert_error_registro").modal("show");
        } else if (departamento == 100) {
            $("#alert_error_registro").modal("show");
        } else if (ciudad == 100) {
            $("#alert_error_registro").modal("show");
        } else if (email.length >= 1 && !email.match(
                /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/
            )) {
            $("#alert_error_registro").modal("show");
        } else if (telefono.length > 10 || telefono.length < 10 || !telefono.match(/^[3][0-9]+$/)) {
            $("#alert_error_registro").modal("show");
        } else if (terminos == false) {
            $("#alert_error_registro").modal("show");
        } else if (privacidad == false) {
            $("#alert_error_registro").modal("show");
        } else {
            var tp_nombre = $("#tipo_documento option:selected").text();
            var dp_nombre = $("#departamento option:selected").text();
            var ci_nombre = $("#ciudad option:selected").text();

            $.ajax({
                url: "{{ route('registro_post') }}",
                dataType: "json",
                type: "POST",
                data: {
                    tipo_documento: tipo_documento,
                    documento: documento,
                    nombre: nombre,
                    apellido: apellido,
                    departamento: departamento,
                    ciudad: ciudad,
                    email: email,
                    telefono: telefono,
                    tp_nombre: tp_nombre,
                    dp_nombre: dp_nombre,
                    ci_nombre: ci_nombre,
                },
                success: function(response) {
                    if (response.result == true) {
                        registrar_usuario(response.info);
                    } else {
                        console.log(response)
                        $("#alert_error_general").modal("show");
                    }
                },
                error: function(response) {
                    console.log(response)
                    $("#alert_error_general").modal("show");
                }
            });
        }
    });
    $("#ganador").one('click', function() {
        $.ajax({
            url: "{{ route('generar_ganador') }}",
            dataType: "json",
            type: "POST",
            data: {
                primerGanador: "ganador"
            },
            success: function(response) {
                if (response.result == true) {
                    var $newTitle = $("<h1 style='color: white;'>")

                    $newTitle.html(response.data + "" + response.nombreGanador);
                    $("#title-wrapper").append($newTitle);
                } else {
                    var $newTitle = $("<h1 style='color: white;'>")
                    $newTitle.html(response.data);
                    $("#title-wrapper").append($newTitle);
                }
            },
            error: function(response) {
                console.log(response)
                $("#alert_error_general").modal("show");
            }
        });
    })

    function registrar_usuario(data) {

        if (!data.tel_adic) {
            data.tel_adic = "";
        }
        if (!data.email) {
            data.email = "";
        }
        Swal.fire({
            icon: 'success',
            background: "#fff",
            iconColor: '#1c4d0c',
            html: `<span class='alert-error1'><strong>Verifica tus datos</strong></span><br><br>
        <div style="text-align: left;">
        <span class='alert-error2'>Tipo de documento: <strong>` + data.tipo_documento + `</strong></span><br>
        <span class='alert-error2'>Documento: <strong>` + data.documento + `</strong></span><br>
        <span class='alert-error2'>Nombres: <strong>` + data.nombre + `</strong></span><br>
        <span class='alert-error2'>Apellidos: <strong>` + data.apellido + `</strong></span><br>
        <span class='alert-error2'>Departamento: <strong>` + data.dp_nombre + `</strong></span><br>
        <span class='alert-error2'>Ciudad: <strong>` + data.ci_nombre + `</strong></span><br>
        <span class='alert-error2'>Correo electrónico: <strong>` + data.email + `</strong></span><br>
        <span class='alert-error2'>Celular: <strong>` + data.telefono + `</strong></span><br>

        </div>`,
            showCancelButton: true,
            confirmButtonColor: '#4A5C5D',
            cancelButtonColor: '#fff',
            confirmButtonText: "<span class='btn-cancel-registro'>Registrarme</span>",
            cancelButtonText: "<span class='btn-cancel-registro'>Corregir información</span>",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                var count_cod_user = 0;
                var info_user = null;
                $.ajax({
                    url: "{{ route('registro_newpost') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        data: data,
                    },
                    success: function(response) {
                        if (response.result == true) {
                            info_user = response.data_user;
                            Swal.fire({
                                icon: 'success',
                                background: "#fff",
                                iconColor: '#1c4d0c',
                                showCancelButton: false,
                                html: `<span class='alert-error1'>Registrado correctamente</span>`,
                                confirmButtonColor: '#4A5C5D',
                                cancelButtonColor: '#fff',
                                confirmButtonText: '<span class="btn-cancel-registro">Aceptar</span>',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "{{ route('ganador') }}";
                                }
                            });
                        } else if (response.result == false) {
                            console.log(response);
                            Toast.fire({
                                icon: 'error',
                                title: '<span class="alert-error1">' + response.data +
                                    '</span>',
                            });
                        } else {
                            $("#alert_error_general").modal("show");
                        }
                    },
                    error: function(response) {
                        $("#alert_error_general").modal("show");
                    }
                });
            } else {

            }
        });
    }
</script>

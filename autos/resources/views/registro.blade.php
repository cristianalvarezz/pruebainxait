<br>
@include('header')
<div class="container col-12" style="background-color: #fff;">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-10 col-lg-8">
            <div class="card" style="box-shadow: 0px 0px 5px 1px black;
            border-radius: 2%;
            border-style: solid;
            border-width: 13px;">
                <div class="card-body" style="margin-left: 10%;">
                    <div class="row col-lg-11 col-sm-12 mt-5">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Número de documento *</p>
                            <input id="documento" type="number" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Tipo de documento *</p>
                            <select id="tipo_documento" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                                <option value="0">Seleccione una opción</option>
                                <option value="1">Cédula ciudadanía</option>
                                <option value="2">Cédula venezolana</option>
                                <option value="3">Cédula extranjería</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-lg-11 col-sm-12 mt-4">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Nombres *</p>
                            <input type="text" id="nombres" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Apellidos *</p>
                            <input type="text" id="apellidos" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                        </div>
                    </div>
                    <div class="row col-lg-11 col-sm-12 mt-4">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Departamento *</p>
                            <select id="departamento" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                              
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Ciudad *</p>
                            <select id="ciudad" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                                <option>Seleccione una opción</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-lg-11 col-sm-12 mt-4">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Celular *</p>
                            <input id="celular" type="number" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p class="texto-color">Correo electrónico *</p>
                            <input id="email" type="email" style="margin-top: -10px;"
                                class="form-control col-lg-12 col-md-12 col-sm-12">
                        </div>
                    </div>


                    <center>
                        <div class="row col-lg-6 col-sm-12 mt-5">
                            <div class="col">
                                <label class="texto-color">
                                    <input type="checkbox" id="terminos"> Acepto <a href="{{ asset('politica.pdf') }}"
                                        target="_BLANK" class="texto-color">política de
                                        privacidad de datos</a>
                                </label>
                            </div>
                        </div>
                        <div class="row col-lg-6 col-sm-12">
                            <div class="col">
                                <label class="texto-color">
                                    <input type="checkbox" id="privacidad"> Acepto los <a
                                        href="{{ asset('terminos.pdf') }}" target="_BLANK"
                                        class="texto-color">términos y
                                        condiciones</a>
                                </label>
                            </div>
                        </div>
                        <div class="row col-lg-6 col-sm-12 mt-4">
                            <div class="col">
                                <a class="btn btn-success " href="{{ route('volver') }}">VOLVER</a>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success btn-registro"
                                    id="registro_pers">CONFIRMAR</button>
                            </div>
                        </div>
                    </center>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>
<style>
    .texto-color {
        font-family: "Montserrat", sans-serif;
        font-size: 19px;
        color: #272727;
        text-transform: uppercase;
    }

</style>

<div class="modal fade" id="alert_error_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #4A5C5D; border: 0">
            <div class="modal-header text-center"></div>
            <center>

                <div class="text-center" style="margin-top: 5.5rem;">
                    <h5 class="modal-title" style="font-family: Montserrat, sans-serif !important; font-size:30px">Esta cedula ya ha sido registrada</h5>
                    <br>
                </div>
            </center>
        </div>
    </div>
</div>
<div class="modal fade" id="alert_error_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #4A5C5D; border: 0">
            <div class="modal-header text-center"></div>
            <center>
                <div class="text-center" style="margin-top: 5.5rem;">
                    <h5 class="modal-title" style="font-family: Montserrat, sans-serif !important; font-size:30px">Verifica que los
                        campos estén diligenciados correctamente</h5>
                    <br>
                </div>
            </center>
        </div>
    </div>
</div>
<div class="modal fade" id="alert_error_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #4A5C5D; border: 0">
            <div class="modal-header text-center"></div>
            <center>
                <div class="text-center" style="margin-top: 5.5rem;">
                    <h5 class="modal-title" style="font-family: Montserrat, sans-serif !important; font-size:30px">Ocurrió un error,
                        intenta más tarde</h5>
                    <br>
                </div>
            </center>
        </div>
    </div>
</div>

@include('validaciones')

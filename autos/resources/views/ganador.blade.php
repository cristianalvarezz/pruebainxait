<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<div class="container">
    <div id="title-wrapper">

    </div>
    <a class="button" href="{{ route('excel') }}" role="button">Generar excel con todos los
        usuarios</a>
    </p>
    <p class="lead">
        <button type="button" class="button" id="ganador">Nombre del ganador</button>
    </p>
    <a class="button" href="{{ route('volver') }}">Volver</a>
</div>


@include('validaciones')
<style>
    body {
        background: #272727;
        font-family: "Montserrat", sans-serif;
    }

    .container {
        align-items: center;
        text-align: center;
        background: #272727;
        margin-top: 13%;
    }

    .button {
        display: inline-block;
        padding: 15px 25px;
        font-size: 24px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #4CAF50;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
    }

    .button:hover {
        background-color: #3e8e41
    }

    .button:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
    a{
        text-decoration: none;
    }
</style>

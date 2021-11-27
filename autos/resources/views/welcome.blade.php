<div class="container">
    <ul>
        <li><a href="{{ route('registro') }}">Registro</a></li>
        <li><a href="{{ route('ganador') }}">Ganador</a></li>
    </ul>
</div>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap");
    * {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        background: #272727;
        font-family: "Montserrat", sans-serif;
    }

    .container {
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: #1A1E23;
    }
    li{
        list-style: none;
        padding: 4px 0;
    }
    a{
        text-decoration: none;
       color: white;
       font: 700 3rem Raleway, sans-serif;
       text-transform: uppercase;
     
    }
</style>

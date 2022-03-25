<DOCTYPE html>
 <html lang=”en-US”>
 <head>
 <meta charset=”utf-8">
 </head>
 <body>
    <h1>Restablecer cuenta</h1>
    <p>Fecha: {{date('d/m/y H:i:s')}}</p>
    <p>Hola {{$name}} has solicitado recuperar tu cuenta, usa este codigo para recupearla</p>
    <span>Codigo de recuperacion:</span>
    <h1>{{ $token }}</h1>
    <br/>
    <p>
        <b>Equipo de {{ env('APP_NAME') }}</b>
    </p>
</body>
</html>
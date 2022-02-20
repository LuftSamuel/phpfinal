<html>
    <head>
        <title>{{$titulo}}</title>
        <link href="assets/css/admin_login.css" rel="stylesheet" />
    </head>
    <body>

        <div class="login">
            <h1>Loguearse a {{str_replace("_"," ",config('app.name'))}}</h1>
            <form method="post" action="">
                @csrf
                <p><input type="text" name="email" value="{{ old('email') }}" placeholder="Email"></p>
                <p><input type="password" name="password" value="" placeholder="Contraseña"></p>
                <p class="remember_me">
                    <label>
                        <input type="checkbox" name="recordar" id="remember_me">
                        Mantener sesion iniciada en este equipo
                    </label>
                </p>
                <p class="submit"><input type="submit" name="commit" value="Entrrar"></p>
            </form>
        </div>

        <div class="login-help">
            <p><a href="#">Restablecer contraseña (todavia no hace nada)</a>.</p>
        </div>

    </body>
</html>




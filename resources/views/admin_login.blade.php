<html>
    <head>
        <title>{{$titulo}}</title>
        <link href="assets/css/admin_login.css" rel="stylesheet" />
    </head>
    <body>

        <div class="login">
            <h1>Login to Web App</h1>
            <form method="post" action="">
                @csrf
                <p><input type="text" name="email" value="{{ old('email') }}" placeholder="Username or Email"></p>
                <p><input type="password" name="password" value="" placeholder="Password"></p>
                <p class="remember_me">
                    <label>
                        <input type="checkbox" name="recordar" id="remember_me">
                        Mantener sesion iniciada en este equipo
                    </label>
                </p>
                <p class="submit"><input type="submit" name="commit" value="Login"></p>
            </form>
        </div>

        <div class="login-help">
            <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
        </div>

    </body>
</html>




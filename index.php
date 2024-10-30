<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDEC-Voluntariado</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="container-form">
            <form class="sign-in">
                <h2>Iniciar Sesión</h2>
                <span>Ingrese con su correo y contraseña</span>
                <div class="container-input">
                    <i class='bx bx-envelope'></i>
                    <input type="text" placeholder="ingrese su correo electrónico">
                </div>
                <div class="container-input">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" placeholder="ingrese su contraseña">
                </div>
                <a href="#">Olvidaste tu contraseña?</a>
                <button class="btn">Iniciar Sesión</button>
            </form>
        </div>
        <div class="container-form">
            <form class="sign-up">
                <h2>Registrarse</h2>
                <span>Ingrese la información solicitada</span>
                <div class="container-input">
                    <i class='bx bx-user'></i>
                    <input type="text" placeholder="ingrese sus Nombres">
                </div>
                <div class="container-input">
                    <i class='bx bx-user'></i>
                    <input type="text" placeholder="ingrese sus Apellidos">
                </div>
                <div class="container-input">
                    <i class='bx bx-envelope'></i>
                    <input type="email" placeholder="ingrese su correo electrónico">
                </div>
                <div class="container-input">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" placeholder="ingrese su contraseña">
                </div>
                <button class="btn">Registrarse</button>
            </form>
        </div>
        <div class="container-welcome">
            <div class="welcome-sign-up welcome">
                <h3>Bienvenidos</h3>
                <p>Ingrese sus credenciales para postularse como voluntario</p>
                <button class="btn" id="btn-sign-up">Registrarse</button>
            </div>
            <div class="welcome-sign-in welcome">
                <h3>Hola</h3>
                <p>Ingrese sus datos para postularse como voluntario</p>
                <button class="btn" id="btn-sign-in">Iniciar Sesión</button>
            </div>
        </div>
    </div>
    <script src="public/js/login.js"></script>
</body>
</html>
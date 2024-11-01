<?php
   require_once("config/conexion.php");
   if(isset($_POST["enviar"]) and $_POST["enviar"] == "ok"){
      require_once("models/Usuarios.php");
      $usuario = new Usuario();
      $usuario->login();
      print_r($usuario);
   }
?>
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
            <form class="sign-in" method="POST">
            
                <?php
                if(isset($_GET["m"])){
                    switch($_GET["m"]){
                        case "1":
                            ?>
                            <div class="alert text-danger" role="alert">
                            Los datos ingresados son incorrectos!
                            </div>
                            <?php
                            break;
                        case "2":
                            ?>
                            <div class="alert text-warning" role="alert">
                            El formulario no puede estar vacio!
                            </div>
                            <?php
                            break;
                    }
                }
                ?>
                <h2>Iniciar Sesión</h2>
                <span>Ingrese con su correo y contraseña</span>
                <div class="container-input">
                    <i class='bx bx-envelope'></i>
                    <input type="text" id="usu_correo" name="usu_correo" placeholder="ingrese su correo electrónico">
                </div>
                <div class="container-input">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" id="usu_pass" name="usu_pass" placeholder="ingrese su contraseña">
                </div>
                <div class="container-input">
                    <i class='bx bx-user'></i>
                    <select class="custom-select rounded-0" id="usu_rol" name="usu_rol">
                        <option>Seleccione...</option>
                        <option value="C">Coordinador</option>
                        <option value="ES">Estudiante</option>
                        <option value="GC">Gestor Conocimiento</option>
                        <option value="EX">Sector Externo</option>
                        <option value="AS">Aspirante</option>
                    </select>
                </div>
                <a href="recuperar.php">Olvidaste tu contraseña?</a>
                <input type="hidden" name="enviar" value="ok">
                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>
        </div>
        <div class="container-form">
            <form class="sign-up" id="usuario_form">
                <input type="hidden" id="usu_rol" name="usu_rol" class="form-control" value="AS">
                <h2>Registrarse</h2>
                <span>Ingrese la información solicitada</span>
                <div class="container-input">
                    <i class='bx bx-user'></i>
                    <input type="text" id="usu_nom" name="usu_nom" placeholder="ingrese sus Nombres">
                </div>
                <div class="container-input">
                    <i class='bx bx-user'></i>
                    <input type="text" id="usu_ape" name="usu_ape" placeholder="ingrese sus Apellidos">
                </div>
                <div class="container-input">
                    <i class='bx bx-envelope'></i>
                    <input type="email" id="usu_correo" name="usu_correo" placeholder="ingrese su correo electrónico">
                </div>
                <div class="container-input">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" id="usu_pass" name="usu_pass" placeholder="ingrese su contraseña">
                </div>
                <button type="submit" name="action" id="#" value="add" class="btn">Registrarse</button>
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
    <script type="text/javascript" src="public/js/index.js"></script>
   <!--  <script type="text/javascript" src="views/js/admUsuario.js"></script> -->
</body>
</html>
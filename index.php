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
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" href="/Voluntariado/public/img/favicon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="form-box login">
            <form method="POST">
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
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" id="usu_correo" name="usu_correo" placeholder="ingrese su correo electrónico"></input>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" id="usu_pass" name="usu_pass" placeholder="ingrese su contraseña"></input>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <div class="input-box">
                    <select class="custom-select rounded-0" id="usu_rol" name="usu_rol">
                        <option style="color: #888;font-weight: 300;">Seleccione...</option>
                        <option value="C">Coordinador</option>
                        <option value="ES">Estudiante</option>
                        <option value="GC">Gestor Conocimiento</option>
                        <option value="EX">Sector Externo</option>
                        <option value="AS">Aspirante</option>
                    </select>
                    <i class='bx bx-user'></i>
                </div>
                <div class="forgot-link">
                    <a href="recuperar.php">Olvidaste tu contraseña?</a>
                </div>
                <input type="hidden" name="enviar" value="ok">
                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>
        </div>


        <div class="form-box register">
            <form method="post" id="registro_form">
                <h1>Registrarse</h1>
                <div class="input-box">
                    <input type="text" id="nombres" name="nombres" placeholder="ingrese sus Nombres"></input>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" id="apellidos" name="apellidos" placeholder="ingrese sus Apellidos"></input>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" id="usu_correo" name="usu_correo" placeholder="ingrese su correo electrónico"></input>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" id="usu_pass" name="usu_pass" placeholder="ingrese su contraseña"></input>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <div class="input-box">
                    <select class="custom-select rounded-0" id="usu_rol" name="usu_rol">
                        <option style="color: #888;font-weight: 300;">Seleccione...</option>
                        <option value="C">Coordinador</option>
                        <option value="ES">Estudiante</option>
                        <option value="GC">Gestor Conocimiento</option>
                        <option value="EX">Sector Externo</option>
                        <option value="AS">Aspirante</option>
                    </select>
                    <i class='bx bx-user'></i>
                </div>
                <button type="submit" name="action" id="#" value="add" class="btn">Registrarse</button>
            </form>
        </div>
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h3>Bienvenidos</h3>
                <p>Quieres formar parte del voluntariado, ingrese sus credenciales y postularse como voluntario</p>
                <button class="btn register-btn" id="btn-sign-up">Registrarse</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h3>Hola</h3>
                <p>Ya tienes una cuenta, ingresa con tu credenciales y postulate como voluntario.</p>
                <button class="btn login-btn" id="btn-sign-in">Iniciar Sesión</button>
            </div>
        </div>
    </div>
    <script src="public/js/script.js"></script>
</body>
</html>
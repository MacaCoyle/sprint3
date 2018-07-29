<?php

    include_once("loader.php");
    require_once("classes/Usuario.php");

    $emailDefault = "";

    $errores = [];

    if ($_POST) {
        $errores = $validator->validarInformacion($_POST, $db);


        if (!isset($errores["email"])) {
            $emailDefault = $_POST["email"];
        }

        if (count($errores) == 0) {
            $usuario = new Usuario($_POST["email"], $_POST["password"]);
            $usuario->guardarImagen($usuario->getEmail());
            $usuario = $db->guardarUsuario($usuario);
            $auth->login($_POST["email"]);
            header("Location: perfil.php");
            exit;

        }
    }

    if ($auth->loginControl()) {
        header("Location:perfil.php");
        exit;
    }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Passion+One:400,700,900" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="js/main.js"></script>
<title>After question</title>
</head>
<body>
<div class="container">

<header class="header">
    <div class="header_wrapper">
        <div class="header_logo" >
        <a href="index.php"> <img src="images/logo.png"> </a>
        </div><!-- cierra header_logo -->
        <div class="botonera">
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php#que_es1">¿Qué es?</a></li>
                    <li><a href="index.php#reglas1">Reglas</a></li>
                    <li><a href="index.php#players">Players</a></li>
                    <li><a href="faqs.php">FAQS</a></li>
                    <li><a href="index.php#descargar">Descargalo</a></li>
                    <li><a href="registro.php">Registrate</a></li>
                </ul>
            </nav>
        <button class="button_login"> <a href="login.php">Login</a></button>
        </div><!-- cierra botonera -->
    </div><!-- cierra header_wrapper -->
</header>

<main class="reg_fields">
 <form id="register" action="" method="post">
    <div>       
                <label for="name">E-mail</label>
                <input type="text" name="email" value="<?=$emailDefault?>">
                <label for="">Foto de Perfil</label>
                <input type="file" name="avatar">
                <label for="password">Password</label>
                <input type="password" name="password">
                <label for="password">Confirmar password</label>
                <input type="password" name="cpassword"> 
    </div>
    <a class="boton-link" href="login.php">Si ya tenes cuenta logueate acá</a>

    <div class="boton-link">
        <button class="button_login" type="submit">Enviar</button>
    </div>
    </form>
</main>

<footer>
    <div class="redes">
    <a href="#" class="fa fa-facebook"></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-instagram"></a>
    </div>
    <nav class="footer">
        <ul>
            <li>¿Qué es?</li>
            <li>Reglas</li>
            <li>FAQS</li>
            <li>Copyright  2018. Todos los derechos reservados</li>
        </ul>
    </nav>
</footer>

</div> <!-- cierra container -->

</body>
</html>

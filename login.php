<?php
    include_once("loader.php");
    
    if ($auth->loginControl()) {
        header("Location:perfil.php");
        exit;
    }

    $errores = [];
    if ($_POST) {
        $errores = $validator->validarLogin($_POST, $db);
        if (count($errores) == 0) {
            $email = $_POST["email"];
            $auth->login($email);
            header("Location:perfil.php");
            exit;
        }
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
  
            <form id="register" class="formulario form" action="login.php" method="post">

                <?php if(count($errores) > 0) {?>
            
                    <h4>Nombre de usuario o pass invalidos</h4>
                    <a href="login.php">Volver</a>

                <?php } else {?>
                
                <div>
                    <label for="name">E-mail</label>
                    <input type="text" name="email"> 
                </div>
                <div>    
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>
                <div class="boton-link">
                    <a href="forgot_password.php">¿Olvidaste tu cuenta?</a>
                    <p>Si todavia no tenes cuenta, <a  class="boton-link" href="registro.php">registrate acá!</a></p>
                    <button class="button_login" type="submit">Enviar</button>
                </div>
            </form>
            <?php } ?>

    </main>

    <footer>
    <div class="redes">
    <a href="#" class="fa fa-facebook"></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-instagram"></a>
    </div>
    <nav class="footer">
        <uL>
            <li>¿Qué es?</li>
            <li>Reglas</li>
            <li>FAQS</li>
            <li>Copyright  2018. Todos los derechos reservados</li>
        </uL>
    </nav>
</footer>

</div> <!-- cierra container -->

</body>
</html>

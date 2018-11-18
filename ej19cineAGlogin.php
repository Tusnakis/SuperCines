<!DOCTYPE html>
<html>
    <head>
        <title>Super Cines</title>
        <link rel="stylesheet" href="estiloCines.css">
    </head>
    <body>
        <?php

        session_start();

        if(!empty($_POST['usuario']) && !empty($_POST['contrasena']))
        {
            $usuario = $_POST['usuario'];
            $contrasena = sha1($_POST['contrasena']);
            $conexion = new mysqli('localhost','root','','bdcine');
            $sql = "SELECT * from usuarios WHERE usuario = '" . $usuario . "' AND contrasena = '" . $contrasena . "'";
            $consulta = $conexion->query($sql);
            $resultado = $consulta->fetch_assoc();

            if($resultado != null)
            {
                $_SESSION['usuario'] = $resultado['usuario'];
                $_SESSION['lectura'] = $resultado['lectura'];
                $_SESSION['escritura'] = $resultado['escritura'];
                $_SESSION['administracion'] = $resultado['administracion'];
                header("Location:ej19cineAGpagina.php");
            }
            
        }

        ?>

        <img src="imagenes/logo.png"><br>

        <?php

        if(isset($_SESSION['usuario']))
        {
            header("Location:ej19cineAGpagina.php");
        }
        else
        {
            if(isset($usuario))
            {
                echo "<span style='color:red'>Datos incorrectos. Prueba de nuevo</span><br>";
            }
            else
            {
                echo "<span style='color:blue'>Introduce tus credenciales para entrar</span><br>";
            }
        ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                Usuario:<input type="text" name="usuario" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario']; ?>" />
                <?php if(isset($_POST['entrar']) && empty($_POST['usuario'])) echo "<span style='color:red'><--¡Debe introducir tu nombre de usuario!</span>"; ?><br>
                Contraseña:<input type="password" name="contrasena" value="<?php if(isset($_POST['contrasena'])) echo $_POST['contrasena']; ?>" />
                <?php if(isset($_POST['entrar']) && empty($_POST['contrasena'])) echo "<span style='color:red'><--¡Debes introducir tu password!</span>"; ?><br>
                <input type="submit" value="Entrar" name="entrar"/><br>
            </form>
            <p>¿Aún no te has registrado?<a href="<?php echo "ej19cineAGregistro.php"; ?>">¡Regístrate!</a></p>
        <?php
        }
        ?>

    </body>
</html>
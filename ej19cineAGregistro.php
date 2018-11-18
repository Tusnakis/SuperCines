<!DOCTYPE html>
<html>
    <head>
        <title>Super Cines</title>
        <link rel="stylesheet" href="estiloCines.css">
    </head>
    <body>
        <img src="imagenes/logo.png"><br>
        <?php
        
        if(!empty($_POST['usuario']) && !empty($_POST['contrasena']))
        {
            $conexion = new mysqli('localhost','root','','bdcine');
            $sql = "INSERT INTO usuarios (usuario,contrasena) VALUES ('" . $_POST['usuario'] . "','" . sha1($_POST['contrasena']) . "')";
            $consulta = $conexion->query($sql);
            
            $_POST['usuario'] = "";
            $_POST['contrasena'] = "";
            $_POST['registrar'] = null;
            
            header("Location:ej19cineAGlogin.php");
        }
        
        ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Usuario:<input type="text" name="usuario" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario']; ?>" />
            <?php if(isset($_POST['registrar']) && empty($_POST['usuario'])) echo "<span style='color:red'><--¡Debe introducir un nombre de usuario!</span>"; ?><br>
            Contraseña:<input type="password" name="contrasena" value="<?php if(isset($_POST['contrasena'])) echo $_POST['contrasena']; ?>" />
            <?php if(isset($_POST['registrar']) && empty($_POST['contrasena'])) echo "<span style='color:red'><--¡Debes introducir un password!</span>"; ?><br>
            <input type="submit" value="Registrarme" name="registrar"/>
        </form>
    </body>
</html>
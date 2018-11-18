<!DOCTYPE html>
<html>
    <head>
        <title>Super Cines</title>
        <link rel="stylesheet" href="estiloCines.css">
    </head>
    <body>

        <img src="imagenes/logo.png"><br>

        <?php

        session_start();
        if(!isset($_SESSION['usuario']))
        {
            header("Location:ej19cineAGlogin.php");
        }

        echo "¡Bienvenido, " . $_SESSION['usuario'] . "! (<a href='ej19cineAGlogout.php'>logout</a>)";
        echo "<br><br>";

        ?>

        <h2>Comprar entradas</h2>
        
        <?php
        
        $conexion = new mysqli('localhost','root','','bdcine');
        
        if(isset($_GET['peliActual']))
        {
            $peliActual = $_GET['peliActual'];
            echo "<h3>Película: " . $peliActual . "</h3>";
        }
        else
        {
            $_GET['peliActual'] = null;
            $consulta = $conexion->query('SELECT titulo FROM peliculas');
            $resultado = $consulta->fetch_assoc();
            $peliActual = $resultado['titulo'];
            echo "<h3>Película: " . $peliActual . "</h3>";
        }
        
        ?>
        
        <img src="imagenes/pant.png"><br>
        
        <?php
        
        $conexion = new mysqli('localhost','root','','bdcine');
        $consulta = $conexion->query("SELECT disponibilidadSillas FROM peliculas WHERE titulo = '" . $peliActual . "'");
        $resultado = $consulta->fetch_assoc();
        
        for($fila = 0; $fila < 5; $fila++)
        {
            for($silla = 0; $silla < 10; $silla++)
            {
                $posicionSilla = ($fila * 10) + $silla;
                if($resultado['disponibilidadSillas'][$posicionSilla] == "1")
                {
                    echo "<a href='ej19cineAGcomprada.php?fila=" . $fila . "&silla=" . $silla . "&titulo=" . $peliActual . "'><img src='imagenes/sillaLibre.png'></a>";
                }
                else
                {
                    echo "<img src='imagenes/sillaOcupada.png'>";
                }
            }
            echo "<br>";
        }
        ?>
        
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ; ?>">
        
        <?php
    
        $conexion = new mysqli('localhost','root','','bdcine');
        $consulta = $conexion->query('SELECT titulo FROM peliculas');
        
        echo "<select name='peliActual'>";
        
        while($resultado = $consulta->fetch_assoc())
        {
            if($peliActual == $resultado['titulo'])
            {
                echo "<option value='" . $resultado['titulo'] . "' selected>" . $resultado['titulo'] . "</option>";
            }
            else
            {
                echo "<option value='" . $resultado['titulo'] . "'>" . $resultado['titulo'] . "</option>";
            }
        }
        
        echo "<select>";
        
        ?>
        <input type="submit" value="Seleccionar película">
        </form>

    </body>
</html>
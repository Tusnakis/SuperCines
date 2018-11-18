<!DOCTYPE html>
<html>
    <head>
        <title>Super Cines</title>
        <link rel="stylesheet" href="estiloCines.css">
    </head>
    <body>
        
        <?php
        
        $fila = (int)$_GET['fila'];
        $silla = (int)$_GET['silla'];
        $titulo = $_GET['titulo'];
        $sillaElegida = ($fila * 10) + $silla;
        
        $conexion = new mysqli('localhost','root','','bdcine');
        $consulta = $conexion->query("SELECT disponibilidadSillas FROM peliculas WHERE titulo ='" . $titulo . "'");
        $resultado = $consulta->fetch_assoc();
        $disponibilidadSillas = $resultado['disponibilidadSillas'];
        for($i = 0; $i < strlen($disponibilidadSillas); $i++)
        {
            if($i == $sillaElegida)
            {
                $disponibilidadSillas[$i] = 0;
            }
        }
        
        $conexion = new mysqli('localhost','root','','bdcine');
        $consulta = $conexion->query("UPDATE peliculas SET disponibilidadSillas = '" . $disponibilidadSillas . "' WHERE titulo = '" . $titulo . "'");
        
        
        echo "<img src='imagenes/logo.png'><br>";
        echo "<h2>¡Enhorabuena!</h2><br>";
        
        echo "Has adquirido una entrada. Para descargarla, haz click <a href='ej19cineAGpdfentrada.php?fila=" . ($fila + 1) . "&silla=" . ($silla + 1) . "&titulo=" . $titulo . "'>AQUÍ</a><br><br>";
        echo "<a href='ej19cineAGpagina.php?peliActual=" . $titulo . "'><img src='imagenes/botonSeguir.png'></a>";
        
        ?>

    </body>
</html>
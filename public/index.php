<?php
    require("recursos/inc/funciones.php");

    session_name('loteria');
    session_start();
    $titulo = "Bingo Online";
    $n = 0;

    if (isset($_POST['nuevo'])) {
        session_destroy();
        session_start();
    }
    if (!isset($_SESSION['tombola'])) {
        $_SESSION['tombola'] = array();	                               //Inicializamos variable de sesión tombola
    }                                                                  //rellenando un array de 90 elementos con ceros
    if (isset($_POST['obtener'])) {
        do {
            $n = mt_rand(1, 90);
        } while (in_array($n, $_SESSION['tombola']));                  //Mientras que el número exista en el array repetimos el bucle
        array_push($_SESSION['tombola'], $n);
    }
    if (isset($_POST['comprobar'])) {
        $f1 = array();
        $f2 = array();                                                 //Creamos arrays que contendran los números enviados por fila
        $f3 = array();
        for($i = 1; $i < 28; $i++) {
            if ($_POST["casilla".$i] != "") {
                if (in_array($i, array(1, 4, 7, 10, 13, 16, 19, 22, 25))) {  //Calculamos en que fila insertaremos el número a partir del índice
                    array_push($f1, $_POST["casilla".$i]);                   //Insertamos el número mandado en una fila concreta
                }  else if (in_array($i, array(2, 5, 8, 11, 14, 17, 20, 23, 26))) {
                    array_push($f2, $_POST["casilla".$i]);
                } else {
                    array_push($f3, $_POST["casilla".$i]);
                }
            }
        }
        if(count($f1) + count($f2) + count($f3) != 15) {               //Si la suma de las 3 filas es diferente a 15
            $titulo = "<font color='red'>Cartón mal rellenado</font>"; //mostramos el mensaje de 'error' correspondiente
        } else {                                                       //en caso contrario validamos el cartón
            $titulo = comprobarCarton($f1, $f2, $f3, $_SESSION['tombola']);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="recursos/css/estilos.css"/>
        <link rel="shortcut icon" type="image/png" href="recursos/imagenes/ico.png">
        <title>BinWeb</title>
    </head>
    <body>
        <form action="index.php" method="post">
            <div>
<?php
                $nAux = ($n != 0) ? $n : "";                           //Sólo mostramos el número generado cuando sea diferente de cero
                echo "\t\t\t\t<p><span>".$nAux."</span><span>".$titulo."</span></p>\n";
                echo dibujaTabla($n, $_SESSION['tombola']);
                $activo = (count($_SESSION['tombola']) == 90) ? "disabled" : "";
?>
            <input type="submit" name="obtener" value="Obtener Número" <?= $activo ?>>
            <input type="submit" name="nuevo"   value="Nuevo Juego">
        </div>
        <div>
<?= dibujaCarton(); ?>
            <input type="submit" name="comprobar" value="Comprobar Cartón">
        </div>
    </form>
<?= reproducirAudio($titulo); ?>
    </body>
</html>

<?php                                                                 //Algunas líneas más largas de 80 caracteres no se han reducido
    require("recursos/inc/funciones.php");                            //por temas de identación (vía html), en cualquier caso no se
                                                                      //superan los 120 caracteres máximos recomendados
    session_name('loteria');
    session_start();
    $titulo = "Bingo Online";
    $n = 0;
    
    if (isset($_POST['nuevo'])) {
        session_destroy();
        session_start();
    }
    if (!isset($_SESSION['tombola'])) {
        $_SESSION['tombola'] = array_fill(1, 90, 0);                  //Inicializamos variable de sesión tombola
    }                                                                 //rellenando un array de 90 elementos con ceros
    if (isset($_POST['obtener'])) {
        do {
            $n = mt_rand(1, 90);
            $nAux = strval($n);                                       //Convertimos a cadena el número generado aleatoriamente
            if ($n > 9) {
                $pos = obtenerIndice($nAux[1] + 1, $nAux[0]);
            } else {
                $pos = obtenerIndice($nAux[0], 0);
            }
        } while ($_SESSION['tombola'][$pos] != 0);                    //Mientras que el número exista en el array repetimos el bucle
        $_SESSION['tombola'][$pos] = $n;
    }
    if (isset($_POST['comprobar'])) {
        $f1 = array();
        $f2 = array();                                                //Creamos arrays que contendran los números mandados por fila
        $f3 = array();
        $carton = array();                                            //Por cuestiones de manejabilidad se ha decidido separar las tres
        for($i = 1; $i < 4; $i++) {                                   //filas y el cartón, aunque no es necesario éste último se ha optado
            for($j = 0; $j < 9 ; $j++) {                              //por seguir usándolo para seguir las especificaciones de versiones anteriores
                $pos = ($i + $j * 3);                                 //una alternativa plausible consiste en validar las tres filas en su conjunto
                if ($_POST["casilla".$pos] != "") {
					array_push($carton, $_POST["casilla".$pos]);      //Rellenamos array con todos los datos mandados que no estén vacios
                    if (in_array($pos, array(1, 4, 7, 10, 13, 16, 19, 22, 25))) {
                        array_push($f1, $_POST["casilla".$pos]);      //Insertamos el número mandado en una fila concreta
                    }  else if (in_array($pos, array(2, 5, 8, 11, 14, 17, 20, 23, 26))) {
                        array_push($f2, $_POST["casilla".$pos]);      //comprobando si el índice está contenido entre los de dicha fila
                    } else {
                        array_push($f3, $_POST["casilla".$pos]);
                    }
                }
            }
        }
        if(count($carton) != 15) {                                    //Si el número de elementos del cartón es diferente de 15
            $titulo = "<font color='red'>Cartón no rellenado</font>"; //mostramos el mensaje de 'error' correspondiente
        } else {                                                      //en caso contrario validamos el mismo
            $titulo = comprobarCarton($carton, $f1, $f2, $f3, $_SESSION['tombola']);
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
                $nAux = ($n != 0) ? $n : "";                          //Sólo mostramos el número generado cuando sea diferente de cero
                echo "\t\t\t\t<p><span>".$nAux."</span><span>".$titulo."</span></p>\n";
                echo dibujaTabla($n, $_SESSION['tombola']);
                $activo = (count(array_keys($_SESSION['tombola'], 0)) == 0) ? "disabled" : "";
?>
                <input type="submit" name="obtener" value="Obtener Número" <?= $activo ?>>
                <input type="submit" name="nuevo"    value="Nuevo Juego">
            </div>
            <div>
<?= dibujaCarton(); ?>
                <input type="submit" name="comprobar" value="Comprobar Cartón">
            </div>
        </form>
<?= reproducirAudio($titulo); ?>
    </body>
</html>

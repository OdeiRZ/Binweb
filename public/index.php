<?php
    require("recursos/inc/funciones.php");
    
    $n=0;
    $debug=true;
    $titulo="Bingo Online";
    
    session_name('loteria');
    session_start();
    
    if (isset($_POST['nuevo'])) {
        session_destroy();
        session_start();
    }
    if (!isset($_SESSION['tombola'])) {
        $_SESSION['tombola']=array_fill(1, 90, 0);
	}
    if (isset($_POST['obtener'])) {
        do {
            $n=mt_rand(1, 90);
            $nAux=strval($n);
            if ($n>9) {
                $pos=obtenerIndice($nAux[1]+1, $nAux[0]);
			} else {
                $pos=obtenerIndice($nAux[0], 0);
			}
        } while ($_SESSION['tombola'][$pos]!=0);
        $_SESSION['tombola'][$pos]=$n;
    }
    if (isset($_POST['comprobar'])) {
        $carton=array_fill(1, 27, 0);
        $f1=array();
        $f2=array();
        $f3=array();
        for($i=1;$i<4;$i++) {
            for($j=0;$j<9;$j++) {
                $pos=($i+$j*3);
                if ($_POST["casilla".$pos]!="") {
                    $carton[$pos]=$_POST["casilla".$pos];
                    if (in_array($pos, array(1, 4, 7, 10, 13, 16, 19, 22, 25))) {
                        array_push($f1,$carton[$pos]);
					}  else if (in_array($pos, array(2, 5, 8, 11, 14, 17, 20, 23, 26))) {
                        array_push($f2, $carton[$pos]);
                    } else {
                        array_push($f3, $carton[$pos]);
					}
                }
            }
		}
        if(count(array_keys($carton, 0))!=12) {
            $titulo="<font color='red'>Cartón no rellenado</font>";
        } else {
            $titulo=comprobarCarton($carton, $f1, $f2, $f3, $_SESSION['tombola']);
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
                $nAux=($n!=0) ? $n : "";
                echo "\t\t\t\t<p><span>".$nAux."</span><span>".$titulo."</span></p>\n";
                echo dibujaTabla($n, $_SESSION['tombola']);
                $activo=(count(array_keys($_SESSION['tombola'], 0))==0) ? "disabled" : "";
?>
                <input type="submit" name="obtener" value="Obtener Número" <?= $activo ?>>
                <input type="submit" name="nuevo"    value="Nuevo Juego">
            </div>
            <div>
<?= dibujaBoleto(); ?>
                <input type="submit" name="comprobar" value="Comprobar Cartón">
            </div>
        </form>
<?= isDebug($debug); ?>
<?= reproducirAudio($titulo); ?>
    </body>
</html>

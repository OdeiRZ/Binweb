<?php
/**
 * Método usado para generar el código HTML que dibuja la tabla donde mostramos las tiradas realizadas.
 *
 * @param integer $actual número generado aleatoriamente con la bola sacada al azar
 * @param array $tombola vector con los números sacados con anterioridad
 * @return string
 */
function dibujaTabla($actual, $tombola)
{
    $tabla = "\t\t\t\t<table>\n";
    for ($i = 1; $i < 12; $i++) {
        $tabla.= "\t\t\t\t\t<tr>\n";
        for ($j = 0; $j < 9; $j++) {
            if ($j > 0) {
                $iAux = $i-1;
                $jAux = $j;
                if ($j == 8 && $i == 11) {
                    $iAux = 0;
                    $jAux = $j+1;
                }
            } else {
                $iAux = $i;
                $jAux = "";
            }
            $pos = ($jAux).($iAux);
            $estilo = "";
            if (($i == 10 && $j == 0) || ($i == 11 && $j != 8)) {
                $estilo = "oculto";
            } else if ($pos != $actual && in_array($pos, $tombola)) {
                $estilo = "boleto";
            } else if ($pos == $actual) {
                $estilo = "actual";
            }
            $tabla.= "\t\t\t\t\t\t<td class='".$estilo."'>".$pos."</td>\n";
        }
        $tabla.= "\t\t\t\t\t</tr>\n";
    }
    return $tabla."\t\t\t\t</table>\n";
}

/**
 * Método usado para generar el código HTML que dibuja el cartón donde seleccionaremos los números elegidos.
 *
 * @return string
 */
function dibujaCarton()
{
    $boleto = "\t\t\t\t<table>\n";
    for ($i = 1; $i < 4; $i++) {
        $boleto.= "\t\t\t\t\t<tr>\n";
        for ($j = 0; $j < 9; $j++) {
            $minAux = ($j == 0) ? 1 : $j*10;
            $min="min='".$minAux."'";
            $maxAux = ($j == 0) ? 9 : $minAux+9;
            $max = "max='".(($j == 8) ? 90 : $maxAux)."'";
            $name = "name='casilla".($i+$j*3)."'";
            $boleto.= "\t\t\t\t\t\t<td><input type='number' ".$name." ".$min." ".$max."></td>\n";
        }
        $boleto.= "\t\t\t\t\t</tr>\n";
    }
    return $boleto."\t\t\t\t</table>\n";
}

/**
 * Método usado para comprobar si un cartón tiene premio devolviendo una cadena que insertaremos en la página HTML.
 *
 * @param array $f1 vector con los números seleccionados en la fila 1
 * @param array $f2 vector con los números seleccionados en la fila 2
 * @param array $f3 vector con los números seleccionados en la fila 3
 * @param array $tombola vector con las números sacados de manera aleatoria
 * @return string
 */
function comprobarCarton($f1, $f2, $f3, $tombola)
{
    if ((count(array_diff($f1, $tombola)) === 0 && count($f1) == 5) &&
        (count(array_diff($f2, $tombola)) === 0 && count($f2) == 5) &&
        (count(array_diff($f3, $tombola)) === 0 && count($f3) == 5)) {
        $resultado = "<font color='green'>!!!! BINGO !!!!</font>";       //Si las 3 filas en su conjunto están contenidas en de array es BINGO
    } else if ((count(array_diff($f1, $tombola)) === 0 && count($f1) == 5) ||
        (count(array_diff($f2, $tombola)) === 0 && count($f2) == 5) ||
        (count(array_diff($f3, $tombola)) === 0 && count($f3) == 5)) {
        $resultado = "<font color='green'>!! LÍNEA !!</font>";           //Si sólo 1 de las filas está contenida en el array es LÍNEA
    } else {
        $resultado = "<font color='red'>Sin Premio</font>";              //En caso contrario no tiene premio el cartón enviado
    }
    return $resultado;
}

/**
 * Método usado para reproducir un sonido al validar el cartón de Bingo si el jugador acierta.
 *
 * @param array $f1 vector con los números seleccionados en la fila 1
 * @return string
 */
function reproducirAudio($titulo)
{
    $sw = true;
    if (strpos($titulo, "BINGO") || strpos($titulo, "LÍNEA")) {
        $audio = "win";
    } elseif (strpos($titulo, "Sin Premio")) {
        $audio = "fail";
    } else {
        $sw = false;
    }
    if ($sw) {
        $reproductor = "\t\t<audio autoplay>\n";
        $reproductor.= "\t\t\t<source src='/recursos/audio/".$audio.".mp3' type='audio/mpeg'>\n";
        $reproductor.= "\t\t\t<source src='/recursos/audio/".$audio.".ogg' type='audio/ogg'>\n";
        $reproductor.= "\t\t</audio>\n";
        return $reproductor;
    }
}

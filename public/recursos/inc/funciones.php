<?php
    function dibujaTabla($actual, $tombola)                          //Función usada para generar el código HTML que
    {                                                                //utilizaremos para insertar una tabla en la página
        $tabla = "\t\t\t\t<table>\n";                                //recibiendo como parámetros el último número generado
        for ($i = 1; $i < 12; $i++) {                                //y los anteriores (éstos últimos en forma de vector)
            $tabla.= "\t\t\t\t\t<tr>\n";
            for ($j = 0; $j < 9; $j++) {
                $estilo = "";
                $pos = obtenerIndice($i, $j);
                if (($i == 10 && $j == 0) || ($i == 11 && $j != 8)) {
                    $estilo = "oculto";
                } else if ($pos != $actual && $tombola[$pos] != 0) {
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
    function dibujaCarton()                                          //Función usada para generar el código HTML que
    {                                                                //utilizaremos para insertar un cartón en la página
        $boleto = "\t\t\t\t<table>\n";                                 //asignando valores mínimos y máximos para cada uno
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
    function obtenerIndice($i, $j)                                   //Función usada para obtener el índice utilizado
    {                                                                //en la generación de la tabla usada como tómbola
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
        return ($jAux).($iAux);
    }
    function comprobarCarton($carton, $f1, $f2, $f3, $tombola)       //Función usada para comrpobar si un cartón tiene premio
    {                                                                //devolviendo una cadena que insertaremos en la página
        if (count(array_diff($carton, $tombola)) === 0) {            //diferenciando entre Bingo, Línea o Sin premio
            $resultado = "<font color='green'>!!!! BINGO !!!!</font>";
        } else if ((count(array_diff($f1, $tombola)) === 0 && count($f1) >= 5) || 
                   (count(array_diff($f2, $tombola)) === 0 && count($f2) >= 5) || 
                   (count(array_diff($f3, $tombola)) === 0 && count($f3) >= 5)) {
            $resultado = "<font color='green'>!! LÍNEA !!</font>";
        } else {
            $resultado = "<font color='red'>Sin Premio</font>";
        }
        return $resultado;
    }
    function reproducirAudio($titulo)                                //Función usada para reproducir un sonido al validar
    {                                                                //el cartón de Bingo, comprobando si existe parcialmente
        $sw = true;                                                  //una cadena en un título recibido como parámetro
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

<?php
    function dibujaTabla($actual,$tombola)
    {
        $tabla="\t\t\t\t<table>\n";
        for ($i=1;$i<12;$i++) {
            $tabla.="\t\t\t\t\t<tr>\n";
            for ($j=0;$j<9;$j++) {
                $estilo="";
                $pos=obtenerIndice($i, $j);
                if (($i==10 && $j==0) || ($i==11 && $j!=8)) {
                    $estilo="oculto";
				} else if ($pos!=$actual && $tombola[$pos]!=0) {
                    $estilo="boleto";
				} else if ($pos==$actual) {
                    $estilo="actual";
				}
                $tabla.="\t\t\t\t\t\t<td class='".$estilo."'>".$pos."</td>\n";
            }
            $tabla.="\t\t\t\t\t</tr>\n";
        }
        return $tabla."\t\t\t\t</table>\n";
    }
    function dibujaBoleto()
    {
        $boleto="\t\t\t\t<table>\n";
        for ($i=1;$i<4;$i++) {
            $boleto.="\t\t\t\t\t<tr>\n";
            for ($j=0;$j<9;$j++) {
                $minAux=($j==0) ? 1 : $j*10;
                $min="min='".$minAux."'";
                $maxAux=($j==0) ? 9 : $minAux+9;
                $max="max='".(($j==8) ? 90 : $maxAux)."'";
                $name="name='casilla".($i+$j*3)."'";
                $boleto.="\t\t\t\t\t\t<td><input type='number' ".$name." ".$min." ".$max."></td>\n";
            }
            $boleto.="\t\t\t\t\t</tr>\n";
        }
        return $boleto."\t\t\t\t</table>\n";
    }
    function obtenerIndice($i,$j)        //reinsertar funcion en funcion padre en version final
    {
        if ($j>0) {
            $iAux=$i-1;
            $jAux=$j;
            if ($j==8 && $i==11) {
                $iAux=0;
                $jAux=$j+1;
            }
        } else {
            $iAux=$i;
            $jAux="";
        }
        return ($jAux).($iAux);
    }
    function comprobarCarton($carton,$fila1,$fila2,$fila3,$tombola)	//
    {
        if (count(array_diff($carton, $tombola)) === 0) {
            $resultado="<font color='green'>!!!! BINGO !!!!</font>";
        } else if ((count(array_diff($fila1, $tombola)) === 0 && count($fila1)>=5) || 
                   (count(array_diff($fila2, $tombola)) === 0 && count($fila2)>=5) || 
                   (count(array_diff($fila3, $tombola)) === 0 && count($fila3)>=5)) {
            $resultado="<font color='green'>!! LÍNEA !!</font>";
		} else {
            $resultado="<font color='red'>Sin Premio</font>";
		}
        return $resultado;
    }
    function reproducirAudio($titulo)
    {
        $sw=true;
        if (strpos($titulo, "BINGO") || strpos($titulo, "LÍNEA")) {
            $audio="win";
		} elseif (strpos($titulo, "Sin Premio")) {
            $audio="fail";
		} else {
            $sw=false;
		}
        if ($sw) {
            $reproductor="\t\t<audio autoplay>\n";
            $reproductor.="\t\t\t<source src='/recursos/audio/".$audio.".mp3' type='audio/mpeg'>\n";
            $reproductor.="\t\t\t<source src='/recursos/audio/".$audio.".ogg' type='audio/ogg'>\n";
            $reproductor.="\t\t</audio>\n";
            return $reproductor;
        }
    }
    function isDebug($debug)            //eliminar funcion en version final
    {
        if ($debug) {
            for ($i=1;$i<12;$i++) {
                for ($j=0;$j<9;$j++) {
                    if (($i==10 && $j==0)||($i==11 && $j!=8)) {
                        echo "&nbsp; &nbsp;";
					} else if ($_SESSION['tombola'][obtenerIndice($i, $j)]!=0) {
                        echo "1 ";
					} else {
                        echo "0 ";
					}
				}
                echo "<br/>";
            }
            echo "<br/>Contador de Números Tómbola: ".count(array_keys($_SESSION['tombola'], 1))."</br>";
            echo "Contador de Huecos Tómbola: ".count(array_keys($_SESSION['tombola'], 0))."<br/><br/>";
            if (isset($_POST['comprobar'])) {
                for ($i=1;$i<4;$i++) {
                    for ($j=0;$j<9;$j++) {
                        if ($_POST["casilla".($i+$j*3)]=="") {
                            echo "0 ";
						} else {
                            echo "1 ";
						}
					}
                    echo "<br/>";
                }
            }
        }
    }

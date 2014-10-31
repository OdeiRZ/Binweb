<?php
	function dibujaTabla()
	{
		$tabla="";
		for($i=1;$i<=11;$i++)
		{
			$tabla.="\t\t\t<table>\n\t\t\t\t<tr>\n";
			for($j=0;$j<9;$j++)
			{
				if(($i==10 && $j==0)||($i==11 && $j!=8))
					$tabla.="\t\t\t\t\t<td class='oculto'></td>\n";
				else						
					$tabla.="\t\t\t\t\t<td>".obtenerIndice($i,$j)."</td>\n";
			}
			$tabla.="\t\t\t\t</tr>\n\t\t\t</table>\n";
		}
		return $tabla;
	}
	function obtenerIndice($i,$j)
	{
		if($j>0)
		{
			$iAux=$i-1;
			$jAux=$j;
			if($j==8 && $i==11)
			{
				$iAux=0;
				$jAux=$j+1;
			}
		}
		else
		{
			$iAux=$i;
			$jAux="";
		}
		return ($jAux).($iAux);
	}
	function isDebug($debug)
	{
		if($debug)
		{
			for($i=1;$i<=11;$i++)
			{
				for($j=0;$j<9;$j++)
					if(($i==10 && $j==0)||($i==11 && $j!=8))
						echo "&nbsp; &nbsp;";
					else						
						echo $_SESSION['carton'][obtenerIndice($i,$j)]." ";
				echo "<br/>";
			}
			echo "Contador de Números: ".count(array_keys($_SESSION['carton'],1))."</br>";
			echo "Contador de Huecos: ".count(array_keys($_SESSION['carton'],0));
		}
	}
?>
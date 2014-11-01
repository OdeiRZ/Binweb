<?php
	function dibujaTabla($actual,$tombola)
	{
		$tabla="\t\t\t\t<table>\n";
		for($i=1;$i<12;$i++)
		{
			$tabla.="\t\t\t\t\t<tr>\n";
			for($j=0;$j<9;$j++)
			{
				$estilo="";
				$indice=obtenerIndice($i,$j);
				if(($i==10 && $j==0)||($i==11 && $j!=8))
					$estilo="oculto";
				else if($indice!=$actual && $tombola[$indice]!=0)
					$estilo="boleto";
				else if($indice==$actual)
					$estilo="actual";
				$tabla.="\t\t\t\t\t\t<td class='".$estilo."'>".$indice."</td>\n";
			}
			$tabla.="\t\t\t\t\t</tr>\n";
		}
		return $tabla."\t\t\t\t</table>\n";
	}
	function dibujaBoleto()
	{
		$boleto="\t\t\t\t<table>\n";
		for($i=1;$i<4;$i++)
		{
			$boleto.="\t\t\t\t\t<tr>\n";
			for($j=0;$j<9;$j++)
			{
				$min=($j==0)? 1 : $j*10;
				$max=($j==0)? 9 : $min+9;
				$max=($j==8)? 90: $max;
				$boleto.="\t\t\t\t\t\t<td><input type='number' name='casilla".($i+$j*3)."' min='".$min."' max='".$max."'></td>\n";
			}
			$boleto.="\t\t\t\t\t</tr>\n";
		}
		return $boleto."\t\t\t\t</table>\n";
	}
	function obtenerIndice($i,$j)		//reinsertar funcion en funcion padre en version final
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
	function comprobarCarton($carton,$tombola)
	{
		$vCartonI=0;
		$vTombolaI=0;
		for($i=1;$i<count($carton);$i++)
			if($carton[$i]!=0)
				$vCarton[$vCartonI++]=$carton[$i];
		for($i=1;$i<count($tombola);$i++)
			if($tombola[$i]!=0)
				$vTombola[$vTombolaI++]=$tombola[$i];		
		return (count(array_diff($carton, $tombola)) === 0) ? "<font color='green'>!!! BINGO !!!</font>" : "<font color='red'>Sin Premio</font>";
	}
	function isDebug($debug)			//eliminar funcion en version final
	{
		if($debug)
		{
			for($i=1;$i<12;$i++)
			{
				for($j=0;$j<9;$j++)
					if(($i==10 && $j==0)||($i==11 && $j!=8))
						echo "&nbsp; &nbsp;";
					else if($_SESSION['tombola'][obtenerIndice($i,$j)]!=0)
						echo "1 ";
					else
						echo "0 ";
				echo "<br/>";
			}
			echo "<br/>Contador de Números Tómbola: ".count(array_keys($_SESSION['tombola'],1))."</br>";
			echo "Contador de Huecos Tómbola: ".count(array_keys($_SESSION['tombola'],0))."<br/><br/>";
			if(isset($_POST['comprobar']))
			{
				for($i=1;$i<4;$i++)
				{
					for($j=0;$j<9;$j++)
						if($_POST["casilla".($i+$j*3)]=="")
							echo "0 ";
						else
							echo "1 ";
					echo "<br/>";
				}
			}
		}
	}
?>
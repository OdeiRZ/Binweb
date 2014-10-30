<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="recursos/css/estilos.css"/>
		<link rel="shortcut icon" type="image/png" href="recursos/imagenes/favicon.png">	
		<title>BinWeb</title>
	<head>
	<body>
		<div>
			<table>
<?php
				for($i=1;$i<=11;$i++)
				{
					echo "<tr>";
					for($j=0;$j<9;$j++)
					{
						if(($i==10 && $j==0)||($i==11 && $j!=8))
							echo "<td class='oculto'></td>";
						else
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
							echo "<td>".($jAux).($iAux)."</td>";
						}
					}
					echo "</tr>";
				}
?>
			</table>
			<form action="index.php" method="post">
				<input type="submit" name="obtener" value="Obtener Número">
				<input type="submit" name="nuevo" 	value="Nuevo Juego">
			</form>
		</div>
	</body>
</html>
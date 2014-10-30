<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BinWeb</title>
		<style>
			body
			{
				padding:20px;
				margin:20px auto;
				width:300px;
				background-color:#6DADAD;
			}
			table
			{
				border:2px solid #15595E;
				padding:10px;
				background-color:#F7C617;
				border-radius:10px;
			}
			table td
			{
				border:1px inset black;
				border-radius:20px;
				background-color:white;
				width:25px;
				text-align:center;
				font-weight:bold;
			}
			table td.oculto
			{
				visibility:hidden;
			}
		</style> 
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
			<table>
		</div>
	</body>
</html>
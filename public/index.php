<?php
	require("recursos/inc/funciones.php");
	$debug=false;
	
	session_name('loteria');
	session_start();
	$aleatorio=0;
	
	if(isset($_POST['nuevo']))
	{
		session_destroy();
		session_start();
	}
	if(!isset($_SESSION['carton']))
		$_SESSION['carton']=array_fill(1,90,0);
	if(isset($_POST['obtener']))
	{
		if(count(array_keys($_SESSION['carton'],"0"))>0)
		{
			do{
				$aleatorio=mt_rand(1,90);
				$auxAleatorio=strval($aleatorio);
				$indice=($aleatorio>9) ? obtenerIndice($auxAleatorio[1]+1,$auxAleatorio[0]) : obtenerIndice($auxAleatorio[0],"0");
			}while($_SESSION['carton'][$indice]==1);
			$_SESSION['carton'][$indice]=1;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="recursos/css/estilos.css"/>
		<link rel="shortcut icon" type="image/png" href="recursos/imagenes/favicon.png">	
		<title>BinWeb</title>
	</head>
	<body>
		<form action="index.php" method="post">
			<div>
<?php
				$auxAleatorio=($aleatorio!=0)? $aleatorio :"";
				echo "\t\t\t\t<p><span>".$auxAleatorio."</span><span>Tómbola</span></p>\n";
				echo dibujaTabla($aleatorio,$_SESSION['carton']);
?>
				<input type="submit" name="obtener" value="Obtener Número" <?= (count(array_keys($_SESSION['carton'],0))==0) ? "disabled" : ""; ?>>
				<input type="submit" name="nuevo"	value="Nuevo Juego">
			</div>		
			<div>
				<?= dibujaBoleto(); ?>
			</div>
		</form>
<?= isDebug($debug); ?>
	</body>
</html>
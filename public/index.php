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
		$aleatorio=mt_rand(1,90);
		$auxAleatorio=strval($aleatorio);
		$indice=($aleatorio>9) ? obtenerIndice($auxAleatorio[1]+1,$auxAleatorio[0]) : obtenerIndice($auxAleatorio[0],"0");
		$_SESSION['carton'][$indice]=1;
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
		<div>
<?php
			$auxAleatorio=($aleatorio!=0)? $aleatorio :"";
			echo "\t\t\t<p><span>".$auxAleatorio."</span></p>\n";
			echo dibujaTabla();
?>
			<form action="index.php" method="post">
				<input type="submit" name="obtener" value="Obtener Número">
				<input type="submit" name="nuevo"	value="Nuevo Juego">
			</form>
		</div>
		<?= isDebug($debug); ?>
	</body>
</html>
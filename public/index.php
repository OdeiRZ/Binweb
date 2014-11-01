<?php
	require("recursos/inc/funciones.php");
	$debug=false;
	
	session_name('loteria');
	session_start();
	$aleatorio=0;
	$titulo="Bingo Online";
	
	if(isset($_POST['nuevo']))
	{
		session_destroy();
		session_start();
	}
	if(!isset($_SESSION['tombola']))
		$_SESSION['tombola']=array_fill(1,90,0);
	if(isset($_POST['obtener']))
	{
		do{
			$aleatorio=mt_rand(1,90);
			$auxAleatorio=strval($aleatorio);
			$indice=($aleatorio>9) ? obtenerIndice($auxAleatorio[1]+1,$auxAleatorio[0]) : obtenerIndice($auxAleatorio[0],0);
		}while($_SESSION['tombola'][$indice]!=0);
		$_SESSION['tombola'][$indice]=$aleatorio;
	}
	if(isset($_POST['comprobar']))
	{
		$carton=array_fill(1,27,0);
		for($i=1;$i<4;$i++)
			for($j=0;$j<9;$j++)
			{
				$indice=($i+$j*3);
				if($_POST["casilla".$indice]!="")
					$carton[$indice]=$_POST["casilla".$indice];
			}
		if(count(array_keys($carton,0))!=12)
			$titulo="<font color='red'>Cartón no rellenado</font>";
		else
			$titulo=comprobarCarton($carton,$_SESSION['tombola']);
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
				echo "\t\t\t\t<p><span>".$auxAleatorio."</span><span>".$titulo."</span></p>\n";
				echo dibujaTabla($aleatorio,$_SESSION['tombola']);
?>
				<input type="submit" name="obtener" value="Obtener Número" <?= (count(array_keys($_SESSION['tombola'],0))==0) ? "disabled" : ""; ?>>
				<input type="submit" name="nuevo"	value="Nuevo Juego">
			</div>
			<div>
<?= dibujaBoleto(); ?>
				<input type="submit" name="comprobar" value="Comprobar Cartón">
			</div>
		</form>
<?= isDebug($debug); ?>
	</body>
</html>
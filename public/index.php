<?php
	require("recursos/inc/funciones.php");
	$debug=false;
	$aleatorio=0;
	$titulo="Bingo Online";
	
	session_name('loteria');
	session_start();
	
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
		$fila1=array();
		$fila2=array();
		$fila3=array();
		for($i=1;$i<4;$i++)
			for($j=0;$j<9;$j++)
			{
				$indice=($i+$j*3);
				if($_POST["casilla".$indice]!="")
				{	//alternativa => funcion de php in_array();
					$carton[$indice]=$_POST["casilla".$indice];
					($indice==1||$indice==4||$indice==7||$indice==10||$indice==13||$indice==16||$indice==19||$indice==22||$indice==25) ? array_push($fila1,$carton[$indice]) : "";
					($indice==2||$indice==5||$indice==8||$indice==11||$indice==14||$indice==17||$indice==20||$indice==23||$indice==26) ? array_push($fila2,$carton[$indice]) : "";
					($indice==5||$indice==6||$indice==9||$indice==12||$indice==15||$indice==18||$indice==21||$indice==24||$indice==27) ? array_push($fila3,$carton[$indice]) : "";
				}
			}
		if(count(array_keys($carton,0))!=12)
			$titulo="<font color='red'>Cartón no rellenado</font>";
		else
			$titulo=comprobarCarton($carton,$fila1,$fila2,$fila3,$_SESSION['tombola']);
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
<?= reproducirAudio($titulo); ?>
	</body>
</html>
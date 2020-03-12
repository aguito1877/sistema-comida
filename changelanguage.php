<?php
session_start();

	include 'library/configServer.php';
	include 'library/consulSQL.php';

	if ($_SESSION['nombreUser'] != "")
		$usuario = $_SESSION['nombreUser'];
	else if ($_SESSION['nombreAdmin'] != "")
		$usuario = $_SESSION['nombreAdmin'];


	if (isset($_GET["language"])){
	$_SESSION["language"]=$_GET["language"];
	header ('Location:'.$_SERVER['HTTP_REFERER']);
	}
    
  
	$codigo = "INGRESO_OK_INDEX";
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	$tipoAccion = "INGRESO";
	$mensaje = "USUARIO INGRESO CORRECTAMENTE A INDEX[".$tipoAccion.": ".$codigo."]";
	ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");

  
  
  
  
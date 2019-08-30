<?php
session_start();

require_once("config/config.inc.php");

require_once("inc/funktionen/zeichenketten_funktionen.inc.php");
require_once("inc/funktionen/datum_und_zeit_funktionen.inc.php");

	

function autoLoad($name)
{
	$pfad = "inc/".$name.".php";
	if(file_exists($pfad))
	{
		require_once($pfad);
	}	
}

spl_autoload_register("autoLoad"); 


$_SESSION["debug"] = new \tools\Debug();	


if(!isset($_GET["action"]))
{
	$_GET["action"] = "home";
}

$controller = new \Seitensteuerung\Seitensteuerung();
echo $controller->selectPage($_GET["action"]); 



echo $_SESSION["debug"];


?>





















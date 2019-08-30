<?php
namespace Seitensteuerung;

use klassen\pdo\Datenbank; 
use klassen\Dateien;
use klassen\bearbeitung;
use klassen\kategorie;
use klassen\Mitarbeiter;
use klassen\Status;

use klassen\Datei;
use klassen\Dateimanager;

class Seitensteuerung
{
	
	public $action 		= "";								
	public $formData 	= array();							
	public $template 	= "templates/grundgeruest.html";	
	public $content 	= "Inhalt ist noch leer"; 			
	
	public function selectPage($page)
	{
		$this->action = $page;
		
		
		if(isset($_POST["login_formular"]))
		{
			$db = new Datenbank();
			$mitarbeiter = $db->sql_select("select * from mitarbeiter where login =:login",
											array("login" => $_POST['login']));
			if(count($mitarbeiter) == 1)
			{
				$hash = $mitarbeiter[0]["passwort"];
				if(password_verify($_POST["passwort"], $hash))
				{
					
					$_SESSION["mitarbeiternr"] = $mitarbeiter[0]["mitarbeiternr"];
				}
				else
				{
					
				}				
			}
			else
			{
				
			}
						
		}
		
		switch($this->action)
		{
			case "home":				$this->actionHome(); 				break;
			case "dokument_hochladen":	$this->actionDokument_hochladen();  break;
			case "verwaltung":			$this->actionVerwaltung();			break;
			
			
			case "login":				$this->actionLogin();				break;	
			case "logout":				$this->actionLogout();				break;
			
			
			case "kontakt":				$this->actionKontakt();				break;
			case "impressum":			$this->actionImpressum();			break;
			case "agb":					$this->actionAGB();					break;
			case "download":			$this->actionDownload();			break;
			case "veraltet": 			$this->actionVeraltet();	 		break;
			default:					$this->actionSeiteNichtGefunden();

		}	

		
		$zeichenkette = file_get_contents($this->template);
		
		
		$logout_string = "";
		$login_string = "";
		
		if(isset($_SESSION["mitarbeiternr"]))
		{
			$logout_string = '<a href="index.php?action=logout">Logout</a>';
		}
		else
		{
		
		}
		
		$zeichenkette =	suchen_und_ersetzen("__#__LOGIN__#__", $login_string, 		$zeichenkette);
		$zeichenkette =	suchen_und_ersetzen("__#__LOGOUT__#__", $logout_string, 		$zeichenkette);
		
											
		$neue_zeichenkette = suchen_und_ersetzen("__#__CONTENT__#__", $this->content, 		$zeichenkette);
		return $neue_zeichenkette;		
	}
	
	protected function actionHome()
	{
		
		$this->content = file_get_contents("templates/startseite.html");
	}
	
		
	
	protected function actiondokument_hochladen()
	{
		$this->content = "<h1>Dokument hochladen</h1>";
		$this->formData = $_POST;
		

################################################################################################		
$_SESSION["debug"]->hinzufuegen_variable("Formulardaten für dokument_hochladen:", print_r($_POST,true));			
################################################################################################			
				
		if(isset($this->formData["dokument_hochladen"]))
		{
			$speicherbare_zeichenkette = serialize($this->formData);
			
			################################################################################################
			$_SESSION["debug"]->hinzufuegen_variable("Zeichenkette speichern:", $speicherbare_zeichenkette);
			################################################################################################			
					
			
			
	
			$dateiname = uniqid("dokument_hochladen_");
			
			file_put_contents("dokument_hochladen/$dateiname.txt", $speicherbare_zeichenkette);
			$this->content .= "Daten wurden gespeichert";		


			#############################################################
			
			
			$db = new Datenbank();
			$Kategorie = $db->sql_select("select * from Kategorie where nr =".$this->formData["KategorieNr"]);

################################################################################################
$_SESSION["debug"]->hinzufuegen_variable("Kategorie:", print_r($Kategorie,true));
################################################################################################

################################################################################################
$_SESSION["debug"]->hinzufuegen_variable("Upload FILES:", print_r($_FILES,true));
$_SESSION["debug"]->hinzufuegen_variable("Upload POST:", print_r($_POST,true));
################################################################################################

			$datei = new Datei($_FILES["uploaddatei"]);
			$dateimanager = new Dateimanager();





			$auftrag_id = $db->sql_insert("insert into dateien 
					(StatusNr, Datum, KategorieNr, neuer_dateiname, eitenanzahl, DokumentTitel, bilddatei)
					values
					(
						:platzhalter_StatusNr, 
						:platzhalter_Datum, 
						:platzhalter_KategorieNr, 
						:platzhalter_neuer_dateiname, 
						:platzhalter_eitenanzahl, 
						:platzhalter_DokumentTitel, 
						:platzhalter_bilddatei
					)",
					array(
						"platzhalter_status" => 1,						
						"platzhalter_IDnummer" => uniqid(),		
						"platzhalter_DokumentTitel" => $this->formData["DokumentTitel"],
						"platzhalter_StatusNr" => $this->formData["StatusNr"],
						"platzhalter_KategorieNr" => $this->formData["KategorieNr"],
						"platzhalter_eitenanzahl" => $preisliste[0]["eitenanzahl"],
						"platzhalter_bilddatei" => $dateimanager->datei_hochladen($datei->getDateiinfo())
					)
				);
			
		}
		else
		{
			$this->content .= file_get_contents("templates/dokument_hochladen_formular.html");
		}
	}
	
	
	
	
	
	protected function actionVerwaltung()
	
		{
		if(isset($_SESSION["mitarbeiternr"]))
		{
			include("verwaltung_uebersicht.php");
		}
		else
		{
			$this->actionLogin(); 
		}
	}
	
	
	
	protected function actionLogin()
	{
		$this->content = "<h1>Login</h1>";
		
		$this->content .= file_get_contents("templates/login.html");
		
	}
	
	protected function actionLogout()
	{
		$this->content = "<h1>Logout</h1>";
		$this->content .= "Sie sind nun abgemeldet";
		unset($_SESSION["mitarbeiternr"]);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	protected function actionKontakt()
	{
		$this->content = "<h1>Kontakt</h1>";
	}	
	
	protected function actionImpressum()
	{
		$this->content = "<h1>Impressum</h1>";
	}		
	
	protected function actionAGB()
	{
		$this->content = "<h1>AGB</h1>";
	}
	
	protected function actionDownload()
	{
		$this->content = "<h1>Download</h1>";
		header("Location: downloads/download.php");
	}	
	
	protected function actionVeraltet()
	{
		$this->content = "<h1>Veraltet</h1>";
		header("Expires: Tue, 24 Apr 2018 11:06:00 GMT");
	}	
	
	protected function actionSeiteNichtGefunden()
	{
		$this->content = "<h1>Seite nicht gefunden</h1>";
		header("HTTP/1.1 404 Not Found"); 
	}		
	
}
?>
<?php
namespace tools;

class Debug
{

	public $debugliste 			= array(); 	
	public $aktiv_datenbank		= _DEBUG_AKTIV_DATENBANK; 
	public $aktiv_funktion 		= _DEBUG_AKTIV_FUNKTION; 
	public $aktiv_variable 		= _DEBUG_AKTIV_VARIABLE;
	

	protected function hinzufuegen($beschreibung, $inhalt, $kategorie)
	{
		$array = array("beschreibung" 	=> $beschreibung,
					   "inhalt" 		=> $inhalt,
					   "kategorie" 		=> $kategorie);
		$this->debugliste[] = $array; 				   
	}

	public function hinzufuegen_datenbank($beschreibung, $inhalt)
	{
		$this->hinzufuegen($beschreibung, $inhalt, "Datenbankzugriff");
	}

	public function hinzufuegen_funktion($beschreibung, $inhalt)
	{
		$this->hinzufuegen($beschreibung, $inhalt, "Funktion");
	}

	public function hinzufuegen_variable($beschreibung, $inhalt)
	{
		$this->hinzufuegen($beschreibung, $inhalt, "Variable");
	}	
	
	public function __toString()
	{
		$string = "";
		
		foreach($this->debugliste as $nr => $eintrag)
		{
			switch($eintrag["kategorie"])
			{
				case "Funktion":
					if($this->aktiv_funktion)
					$string .= "<div style='background-color:orange; color:black'><b>".($nr+1)
								.". Funktionen:</b>".$eintrag["beschreibung"]."<br />(<pre>".$eintrag["inhalt"]."</pre>)</div>";
				break;
				case "Variable":
					if($this->aktiv_variable)
					$string .= "<div style='background-color:yellow; color:black'><b>".($nr+1)
								.". Variablen:</b>".$eintrag["beschreibung"]."<br />(<pre>".$eintrag["inhalt"]."</pre>)</div>";
				break;
				case "Datenbankzugriff":
					if($this->aktiv_datenbank)
					$string .= "<div style='background-color:red; color:white'><b>".($nr+1)
								.". Datenbankzugriff:</b> ".$eintrag["beschreibung"]."<br />(<pre>".$eintrag["inhalt"]."</pre>)</div>";
				break;
			}
		}
		
		if($string == "" && ($this->aktiv_funktion || $this->aktiv_variable || $this->aktiv_datenbank))
		{
			return "DEBUG ist leer";
		}	
		return $string;		
	}		
	
}

?>
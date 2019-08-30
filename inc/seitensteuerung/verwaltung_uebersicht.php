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
	
	
	
$this->content = "<h1>Verwaltung</h1>";
		
$this->content .= file_get_contents("templates/verwaltung_tabelle_oben.html");
		
		
$db = new Datenbank();
		
$dateien = $db->sql_select("select * from dateien LEFT JOIN status 
									ON dateien.StatusNr= status.StatusNr
									");
		
foreach($dateien as $nr => $auftrag)
		{
			$zeichenkette = file_get_contents("templates/verwaltung_tabelle_mitte.html");
			
			$austausch_array = array(	"__IDnummer__" 		    => $auftrag["IDnummer"],
										"__Datum__" 	        => $auftrag["Datum"],
										"__DokumentTitel__" 	=> $auftrag["DokumentTitel"],
										"__Kategorie__" 		=> $auftrag["Kategorie"],
										"__Status__" 		    => $auftrag["status"],
										"__Seitenanzahl__"      => $auftrag["statusbeschreibung"],
										"__BILD__" 				=> $auftrag["bilddatei"]
									);
									
foreach($austausch_array as $platzhalter => $austauschwert)
			{
				$zeichenkette = suchen_und_ersetzen($platzhalter, $austauschwert, $zeichenkette);
			}
			
			$this->content .= $zeichenkette;
		}
		
		$this->content .= file_get_contents("templates/verwaltung_tabelle_unten.html");
	}
	
	?>
	
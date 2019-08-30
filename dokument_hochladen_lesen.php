<?php
$verzeichnis = "dokumentenarchiven";
$content = "";

if( is_dir($verzeichnis) )
{
	
	if($geoeffnetes_verzeichnis = opendir($verzeichnis))
	{
		
		while( ($datei = readdir($geoeffnetes_verzeichnis)) !== false)
		{
			if($datei != "." && $datei != "..")
			{
				$content .= "<h1>".$datei."</h1>";
				
				
				$rohdaten = file_get_contents("dokumentenarchiven/$datei");
				
				$formulardaten = unserialize($rohdaten);
				
				$content .= "<pre>";
				$content .= print_r($formulardaten, true); 
				$content .= "</pre>";				
			}
		}
	}
}

echo $content;
?>
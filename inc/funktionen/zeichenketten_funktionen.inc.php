<?php

function leerzeichen_entfernen($zeichenkette, $sonderzeichen = null)
{
	
	if($sonderzeichen != null)
	{
		return trim($zeichenkette, $sonderzeichen); 
	}
	else
	{
		return trim($zeichenkette);	
	}		
}

function klein_schreiben($zeichenkette)
{
	return mb_strtolower($zeichenkette);
}


function gross_schreiben($zeichenkette)
{
	return mb_strtoupper($zeichenkette);
}


function anfang_gross_schreiben($zeichenkette)
{
	return ucfirst($zeichenkette);
}


function html_konvertieren($zeichenkette)
{
	return htmlspecialchars($zeichenkette, ENT_HTML5 | ENT_QUOTES , "UTF-8");
}



function html_tags_entfernen($zeichenkette, $ausnahme="")
{
	return strip_tags($zeichenkette, $ausnahme);
	
}



function eingabe_saeubern($zeichenkette, $ausnahme = "")
{
	return html_konvertieren(html_tags_entfernen($zeichenkette, $ausnahme));
}




function ausgabeformat_ohne_rueckgabewert($format, $array)
{

	vprintf($format, $array); 
}


function ausgabeformat_mit_rueckgabewert($format, $array)
{
	return vsprintf($format, $array); 
}




function laenge_der_zeichenkette($zeichenkette)
{
	return mb_strlen($zeichenkette); 
	
}


function suche_in_der_zeichenkette($heuhaufen, $nadel)
{
	return mb_strpos($heuhaufen, $nadel); 
	
}


function ausschneiden($zeichenkette, $start, $laenge = null)
{
	if($laenge == null)
	{
		return mb_substr($zeichenkette, $start); 
	}
	else
	{
		return mb_substr($zeichenkette, $start, $laenge); 
	}
}

function suchen_und_ersetzen($suche, $ersatz, $vorlage)
{
	$ersetzte_zeichenkette = str_replace($suche, $ersatz, $vorlage, $anzahl); 
	return $ersetzte_zeichenkette;

}





?>
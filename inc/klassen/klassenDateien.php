<?php
class Dateien
{
	// Attribute
	protected $IDnummer;
	protected $DokumentTitel ;
	protected $Seitenanzahl;
	protected $Datum;
	protected $KategorieNr;
	protected $DokumentDatei;
	protected $StatusNr;
	// GET- und SET-Methoden
	protected function getIDnummer()
	{
		return $this->IDnummer;
	}
	protected function setIDnummer($IDnummer)
	{
		$this->IDnummer = $IDnummer;
	}
	protected function getDokumentTitel ()
	{
		return $this->DokumentTitel ;
	}
	protected function setDokumentTitel ($DokumentTitel )
	{
		$this->DokumentTitel  = $DokumentTitel ;
	}
	protected function getSeitenanzahl()
	{
		return $this->Seitenanzahl;
	}
	protected function setSeitenanzahl($Seitenanzahl)
	{
		$this->Seitenanzahl = $Seitenanzahl;
	}
	protected function getDatum()
	{
		return $this->Datum;
	}
	protected function setDatum($Datum)
	{
		$this->Datum = $Datum;
	}
	protected function getKategorieNr()
	{
		return $this->KategorieNr;
	}
	protected function setKategorieNr($KategorieNr)
	{
		$this->KategorieNr = $KategorieNr;
	}
	protected function getDokumentDatei()
	{
		return $this->DokumentDatei;
	}
	protected function setDokumentDatei($DokumentDatei)
	{
		$this->DokumentDatei = $DokumentDatei;
	}
	protected function getStatusNr()
	{
		return $this->StatusNr;
	}
	protected function setStatusNr($StatusNr)
	{
		$this->StatusNr = $StatusNr;
	}
}
?>

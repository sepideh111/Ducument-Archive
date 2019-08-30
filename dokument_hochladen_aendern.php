<?php

$rohdaten = file_get_contents("dokumentenarchiven/dokumentenarchiv_5cecf5489e8c5.txt");
echo $rohdaten;

$formulardaten = unserialize($rohdaten);

echo "<pre>";
print_r($formulardaten);
echo "</pre>";


$formulardaten["status"] = "erledigt";

$speicherbare_zeichenkette = serialize($formulardaten);
$anzahl_der_zeichen = file_put_contents("dokumentenarchiven/formulardaten.txt", $speicherbare_zeichenkette);
echo $anzahl_der_zeichen;
?>
<?php
// lesen einer Datei
$rohdaten = file_get_contents("dokumentenarchiven/dokument_hochlade_5cecf5489e8c5.txt");
echo $rohdaten;

// umwandeln in den normalen Zustand vorher
$formulardaten = unserialize($rohdaten);

echo "<pre>";
print_r($formulardaten);
echo "</pre>";
?>
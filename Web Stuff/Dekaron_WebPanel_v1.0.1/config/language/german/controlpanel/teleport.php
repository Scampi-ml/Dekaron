<?php

$language = array(
//Split Names
'split1' => "Charakter Name",
'split2' => "Ausgew�hlter Charakter :",
'split3' => "Teleport art nach :",
'split4' => "Positions angabe :",
'split5' => "Map Wahl",
'split6' => "W�hle eine Map",
'split7' => "Gebe Map Daten an :",
'split8' => "Map Id",
'split9' => "X / X Pos.",
'split11' => "W�hle eine Map",

//Selects
'select1' => "Map Wahl",
'select2' => "Map Id",
'select3' => "Map Positionen",
'select4' => "Manuelle Pos.",

//Text
'text1' => "Setzte es auf <b>SELECT1</b> um den Charakter auf die ausgw�hlte Map zu setzten.<br>Setzte es auf <b>SELECT2</b> um Manuel eine Map Id einzugeben.",
'text2' => "Benutze <b>SELECT3</b> um die Position in der gew�hlten Map zu benutzen , funktioniert nur bei SELECT1.<br>Benutze SELECT4 um die Position anzugeben.",

//Error Messages
'error1' => "Konnte Charakter Namen nicht finden.",
'error2' => "Es wurden mehrere Charaktere mit diesem Namen gefunden.<br>Bitte �berpr�fe dies Manuel in der Datenbank.",
'error3' => "Dieser Charakter kann derzeit nicht auf eine andere Map gesetzt werden , da dieser Online ist.",
'error4' => "Du kannst nicht die Kombination SELECT2 und SELECT1 zusammen benutzen, bitte Korrigiere dies.",
'error5' => "Du hast dich f�r die angabe von Map Positionen gew�hlt , doch leider hast du keine Map Positionen angegeben.",
'error6' => "Die Angegebenen Map Positionen X und Y sind keine Zahlen.",
'error7' => "Die Angegebenen Map Positionen X und Y m�ssen zwischen 1 und 500 sein.",
'error8' => "Du hast vergessen eine Map Id anzugeben.",
'error9' => "Die Angegebenen Map Id ist keine Zahl.",
'error10' => "Die Angegebenen Map Id existiert nicht.",

//Headers
'head1' => "Teleporte Charakter",

//Ready Message
'ready1' => "Der Charakter namens CHARACTERNAME wurde erfolgreich auf die gew�nschte Map (Map Id : MAPID , X : MAPPOSX , Y : MAPPOSY ) gesetzt.",

//Buttons
'button1' => "Weiter im Programm",
'button2' => "Setzt Charakter auf Map",
'back' => "Zur�ck",

//General Script Errors
's_error1' => "This function does not exist.",
's_error2' => "You are not a GM , you have no access to this function."

//ATTENTION
//Bei den Variablen 'text1','text2','error4' kannst du die Variablen 'select1','select2','select3' und 'select4' als SELECT1,SELECT2,SELECT3,SELECT4 benutzen
//Bei der Variable 'ready1' kannst du CHARACTERNAME f�r den Charakter Name einsetzten,MAPID f�r die Map Id,MAPPOSX als Map Pos X und MAPPOSY als Map Pos Y einsetzten.

);

?>
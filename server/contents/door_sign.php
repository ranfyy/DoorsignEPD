<?php
	// define your settings here
	const ROOM = 'Raum 267';
	$PERSONS = array("John Doe", "Jane Doe", "Otto Normalverbraucher");
	
	$fontSize = $scale;
	
	$cursorY += $fontSize*1.5;
    imagettftext($im, $fontSize, 0, 10, $cursorY, $black, $DEFAULT_FONT['bold'], ROOM);
	$cursorY += 5;
	imageline ($im , 10 , $cursorY , 1000 , $cursorY , $black );
	
	$fontSize = 0.5*$scale;	
	foreach($PERSONS as $person){
		$cursorY = $cursorY+$fontSize*1.5;
	imagettftext($im, $fontSize, 0, 20, $cursorY, $black, $DEFAULT_FONT['regular'], $person );
	}

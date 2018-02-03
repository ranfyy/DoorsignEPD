<?php
$fontSize = $scale;
$cursorY = 0;
$cursorY += $fontSize*1.5;
$fontSize = 0.5*$scale;
$arr = file( "sample.txt" );
foreach( $arr as $line ) {
        imagettftext($im, $fontSize, 0, 20, $cursorY, $black, $DEFAULT_FONT['notomono'], $line );
        $cursorY += $fontSize*1.5;
}

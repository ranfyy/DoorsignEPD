<?php
$fontSize = 0.5 *$scale;
$cursorY  = $fontSize *1.5;
$arr = file( "sample.txt" );
foreach( $arr as $line ) {
    imagettftext($im, $fontSize, 0, 20, $cursorY, $black, $DEFAULT_FONT['notomono'], $line );
    $cursorY += $fontSize *1.5;
}

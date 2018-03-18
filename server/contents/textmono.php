<?php
#define( "DEBUG", true );
define( "DEBUG", false );

$fontSize = 0.5 *$scale;
$cursorY  = $fontSize *1.5;
$cursorX  = $fontSize * .5;
$green = imagecolorallocate($im, 0, 255, 0);
$blue  = imagecolorallocate($im, 0, 0, 255);

$dst_x = $displayWidth  - $cursorX;
$dst_y = $displayHeight - $cursorY;
$arr = file( "sample.txt" );
foreach( $arr as $line ) {
    $line = str_replace( "\t", str_repeat( " ", 4 ), $line );
    imagettftext($im, $fontSize, 0, $cursorX, $cursorY, $black, $DEFAULT_FONT['notomono'], $line );
    $cursorY += $fontSize *1.5;
}

// right side
$bg = $background_color;
if( DEBUG ) $bg = $blue;
imagefilledrectangle( $im, $dst_x, 0, $cursorY, $displayHeight, $bg );
// bottom
if( DEBUG ) $bg = $green;
imagefilledrectangle( $im, 0, $dst_y, $displayWidth, $cursorY, $bg );

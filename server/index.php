<?php
//To activate productionMode (display entering deep sleep), set http-header X-productionMode: true
#header("X-productionMode: true");
//To stop productionMode (no deep sleep, web config), set http-header X-productionMode: false 
#header("X-productionMode: false");

#error_reporting('E_ERROR');
# Supported displays:
# 1.54 inches: https://www.waveshare.com/wiki/1.54inch_e-Paper_Module
#  2.7 inches: https://www.waveshare.com/wiki/2.7inch_e-Paper_HAT
#  2.9 inches: https://www.waveshare.com/wiki/2.9inch_e-Paper_Module
#  4.2 inches: https://www.waveshare.com/wiki/4.2inch_e-Paper_Module
#  7.5 inches: https://www.waveshare.com/wiki/7.5inch_e-Paper_HAT
const DISPLAYS = array(	
	"7.5"	=> array("size"=>"640x384","rotate"=>"false"),
	"4.2"	=> array("size"=>"400x300","rotate"=>"false"),
	"2.9"	=> array("size"=>"296x128","rotate"=>"true"),
	"2.7"	=> array("size"=>"264x176","rotate"=>"true"),
	"1.54"	=> array("size"=>"200x200","rotate"=>"false"),
);
						
$DEFAULT_FONT = array(
	"regular"=>realpath("./fonts/LiberationSans-Regular.ttf"),
	"bold"=>realpath("./fonts/LiberationSans-Bold.ttf"),
	"italic"=>realpath("./fonts/LiberationSans-Italic.ttf"),
);
	
if (!extension_loaded('gd')) {
	echo "GD library is not installed. Please install GD on your server (http://php.net/manual/de/image.installation.php)";
	exit;
}


if(strlen($_GET['scale']) AND is_numeric($_GET['scale'])){
	$scale = $_GET['scale'];
}else{
	$scale = $_GET['scale'] = 32;
}
						
$displayType = $_GET['display'];
if(!isset(DISPLAYS[$displayType])){
	echo ("Not a valid display size.");
	exit;
}

//Read existing contents	
$contents = scandir('contents');

if(!count($contents)){
	 echo "No content definitions";
	 exit;
}

foreach ($contents as $content) { 
	$contentFile = pathinfo("contents/".$content); 
	
	if($contentFile['extension'] == "php"){
	$allContents[$contentFile['filename']] = "contents/".$content;
	}	
}

$selectedContent = $allContents[$_GET['content']];

$displayWidth = explode("x",DISPLAYS[$displayType]['size'])[0];
$displayHeight = explode("x",DISPLAYS[$displayType]['size'])[1];
$im = imagecreate($displayWidth, $displayHeight);
$background_color = ImageColorAllocate ($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
if(is_file($selectedContent)){
	include($selectedContent);
}else{
	echo "Not a valid content.";
	exit;
}
	
	
	if($_GET['debug'] == 'true'){
		header("Content-type: image/png");
		imagepng($im);
		imagedestroy($im);
	}
	else{
		if(DISPLAYS[$displayType]['rotate'] == "true"){
			$im = imagerotate($im, 90, 0);
		}
		$im = imagerotate($im, 0, 0);
		
		echo rawImage($im);
	}

function rawImage($im) {
	$bits = "";
	$bytes = "";
	$pixelcount = 0;

    for ($y = 0; $y < imagesy($im); $y++) {
		for ($x = 0; $x < imagesx($im); $x++) {
			
			$rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8 ) & 0xFF;
            $b = $rgb & 0xFF;
            $gray = ($r + $g + $b) / 3;
			
            if ($gray < 0xFF) {
				$bits .= "1";
            }else {
   				$bits .= "0";
			}
			
			$pixelcount++;
			if ($pixelcount % 8 == 0) {
				$bytes .= pack('H*', str_pad(base_convert($bits, 2, 16),2, "0", STR_PAD_LEFT));
				$bits = "";
			}
		}
    }
	return $bytes;
}

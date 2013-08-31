<?php
header("Content-type: image/png");

$width = 30;
$height = 30;
$colorset = (isset($_GET['cs']) ? (int) $_GET['cs'] : 2);

$img = imagecreatetruecolor($width,$height);

imagelayereffect($img,IMG_EFFECT_ALPHABLEND);

if ( $colorset == 1 ) {
	$fff = imagecolorallocatealpha($img,201,0,0,0);
	$ink = imagecolorallocate($img,255,0,0);
}
elseif ( $colorset == 2 ) {
	$fff = imagecolorallocatealpha($img,255,0,0,0);
	$ink = imagecolorallocate($img,255,255,0);
}
$cx = 4;
$cy = $colorset == 1 ? 24 : 4;
for ( $c = 0; $c < (int) $_GET['cc']; $c++ ) {
	#$cx = mt_rand(3,$width - 3);
	#$cy = mt_rand(3,$height - 3);
	if ( $cx > 25 ) {
		$cx = 4;
		$cy += 5;
	}
	imagefilledrectangle ( $img , $cx-1, $cy-2, $cx+1, $cy+2, $fff );
	imagefilledrectangle ( $img , $cx-2, $cy-1, $cx+2, $cy+1, $fff );
	imagefilledrectangle ( $img , $cx-1, $cy-1, $cx+1, $cy+1, $ink );
	$cx += 5;
	
}

$trans_index = imagecolorexact($img, 0, 0, 0); 
imagecolortransparent($img, $trans_index); 

imagepng($img);
imagedestroy($img);

?>
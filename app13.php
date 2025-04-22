
<?php

if(!($image = @imagecreatefrompng("php.png")))
 {
 //error, so create an error image and exit
 $image = imagecreate(200,200);
 $colorWhite = imagecolorallocate($image, 255, 255, 255);
 $colorBlack = imagecolorallocate($image, 0, 0, 0);
 imagefill($image, 0, 0, $colorWhite);
 imagestring($image, 4, 10, 10, "Couldn't load image!",
 $colorBlack);
 header("Content-type: image/jpeg");
 imagejpeg($image);
 exit();
 }

 //create a color to be transparent, hopefully
 //not already in the image
 $colorMagenta = imagecolorallocate($image, 255, 0, 255);

 //draw a circle
 imagearc($image,
 100, 50,
 100, 100,
 0, 360,
 $colorMagenta);

 //fill outside of circle with Magenta
 imagefilltoborder($image, 0, 0, $colorMagenta, $colorMagenta);

 //turn magenta transparent
 imagecolortransparent($image, $colorMagenta);

 //send image to browser
 header("Content-type: image/png");
 imagepng($image);
?> 
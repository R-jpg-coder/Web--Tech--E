
<?php
 /*
 ** Put PHP logo into field of red
 ** and resize it to 180x180
 */

 //create red square
 $image = imagecreate(200,200);
 $colorRed = imagecolorallocate($image, 255, 0, 0);
 imagefill($image, 0, 0, $colorRed);

 //attempt to open image, suppress error messages
 if(!($image2 = @imagecreatefromjpeg("php_lang.jpg")))
 {
 //error, so create an error image and exit
 $image = imagecreate(200,200);
 $colorWhite = imagecolorallocate($image, 255, 255, 255);
Core PHP Programming
IT-SC book 335
 $colorBlack = imagecolorallocate($image, 0, 0, 0);
 imagefill($image, 0, 0, $colorWhite);
 imagestring($image, 4, 10, 10, "Couldn't load image!",
 $colorBlack);
 header("Content-type: image/jpeg");
 imagejpeg($image);
 exit();
 }

 //drop image2 into image, and stretch or squash it
 imagecopyresized($image, $image2, 10, 10, 0, 0,
 180, 180, imagesx($image2), imagesy($image2));

 //send 
 ?>
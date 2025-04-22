
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    public function createImage()
    {
        // Create red square
        $image = imagecreate(200, 200);
        $colorRed = imagecolorallocate($image, 255, 0, 0);
        imagefill($image, 0, 0, $colorRed);

        // Attempt to open image
        $imagePath = public_path('php_lang.jpg');
        if (!($image2 = @imagecreatefromjpeg($imagePath))) {
            // Error, create an error image
            $image = imagecreate(200, 200);
            $colorWhite = imagecolorallocate($image, 255, 255, 255);
            $colorBlack = imagecolorallocate($image, 0, 0, 0);
            imagefill($image, 0, 0, $colorWhite);
            imagestring($image, 4, 10, 10, "Couldn't load image!", $colorBlack);

            return Response::make($image, 200, [
                'Content-Type' => 'image/jpeg'
            ]);
        }

        // Drop image2 into image, and stretch or squash it
        imagecopyresized($image, $image2, 10, 10, 0, 0, 180, 180, imagesx($image2), imagesy($image2));

        // Send the final image
        return Response::make($image, 200, [
            'Content-Type' => 'image/jpeg'
        ]);
    }
}
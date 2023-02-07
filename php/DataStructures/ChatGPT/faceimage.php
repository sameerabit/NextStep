<?php

$file = 'face.jpg'; // source image file

// read image into a resource
$image = imagecreatefromjpeg($file);

// resize image to 500x500
$resized_image = imagecreatetruecolor(500, 500);
imagecopyresampled($resized_image, $image, 0, 0, 0, 0, 500, 500, imagesx($image), imagesy($image));

// get image dimensions
$width = imagesx($resized_image);
$height = imagesy($resized_image);

// iterate over each pixel and print 1 or 0 based on its color
for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
        $rgb = imagecolorat($resized_image, $x, $y);
        $red = ($rgb >> 16) & 0xFF;
        $green = ($rgb >> 8) & 0xFF;
        $blue = $rgb & 0xFF;

        $brightness = ($red + $green + $blue) / 3;
        if ($brightness > 128) {
            echo "1";
        } else {
            echo "0";
        }
    }
    echo "\n";
}

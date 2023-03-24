<?php
// Create a new image resource
$image = imagecreatetruecolor(400, 400);

// Set the background color to white
$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);

// Define colors
$black = imagecolorallocate($image, 0, 0, 0);
$gray = imagecolorallocate($image, 128, 128, 128);
$brown = imagecolorallocate($image, 150, 75, 0);

// Draw the face
$face_x = 200;
$face_y = 200;
$face_radius = 150;
imagefilledellipse($image, $face_x, $face_y, $face_radius, $face_radius, $gray);
imageellipse($image, $face_x, $face_y, $face_radius, $face_radius, $black);

// Draw the eyes
$eye_radius = 30;
$left_eye_x = $face_x - 60;
$right_eye_x = $face_x + 60;
$eye_y = $face_y - 30;
imagefilledellipse($image, $left_eye_x, $eye_y, $eye_radius, $eye_radius, $white);
imagefilledellipse($image, $right_eye_x, $eye_y, $eye_radius, $eye_radius, $white);
imageellipse($image, $left_eye_x, $eye_y, $eye_radius, $eye_radius, $black);
imageellipse($image, $right_eye_x, $eye_y, $eye_radius, $eye_radius, $black);
imagefilledellipse($image, $left_eye_x, $eye_y, $eye_radius - 10, $eye_radius - 10, $black);
imagefilledellipse($image, $right_eye_x, $eye_y, $eye_radius - 10, $eye_radius - 10, $black);

// Draw the nose
$nose_x = $face_x;
$nose_y = $face_y + 30;
$nose_radius = 50;
imagefilledellipse($image, $nose_x, $nose_y, $nose_radius, $nose_radius, $brown);
imageellipse($image, $nose_x, $nose_y, $nose_radius, $nose_radius, $black);

// Draw the mouth
$mouth_x = $face_x;
$mouth_y = $face_y + 70;
$mouth_radius_x = 80;
$mouth_radius_y = 40;
imagefilledellipse($image, $mouth_x, $mouth_y, $mouth_radius_x, $mouth_radius_y, $white);
imageellipse($image, $mouth_x, $mouth_y, $mouth_radius_x, $mouth_radius_y, $black);

// Output the image to the browser
header('Content-Type: image/png');
imagepng($image);

// Free up memory
imagedestroy($image);
?>

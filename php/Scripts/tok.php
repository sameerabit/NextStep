<?php

// Import the necessary libraries.
require 'vendor/autoload.php';

use TikTok\Api;

// Set the user's TikTok username.
$username = 'example_username';

// Create a new TikTok API instance.
$api = new Api();

// Try to follow the user.
try {
    $api->followUser($username);
    echo 'Successfully followed user';
} catch (Exception $e) {
    echo 'Failed to follow user: ' . $e->getMessage();
}

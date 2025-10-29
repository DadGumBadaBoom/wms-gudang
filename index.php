<?php

/**
 * This file allows you to run the app from the project root.
 * Works around the requirement to access /public/
 */

// Change to the public directory
chdir(__DIR__ . DIRECTORY_SEPARATOR . 'public');

// Load the front controller
require_once __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'index.php';

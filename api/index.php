<?php

/**
 * Vercel Bridge for CodeIgniter 4
 * Debug version - forces development mode to show detailed errors
 */

// CRITICAL FIX: Set as $_SERVER and $_ENV, NOT as define()
// CI4 reads from $_ENV['CI_ENVIRONMENT'], not from PHP constants.
$_ENV['CI_ENVIRONMENT'] = 'development';
$_SERVER['CI_ENVIRONMENT'] = 'development';

// Force PHP error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the public index file directly
require __DIR__ . '/../public/index.php';

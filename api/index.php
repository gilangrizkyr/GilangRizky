<?php

/**
 * Vercel Bridge for CodeIgniter 4
 * This file handles the routing from Vercel Serverless Functions
 * to the CodeIgniter 4 front controller.
 */

// Force development mode for debugging Vercel issues
// REMOVE THIS AFTER BUG IS FIXED
if (!defined('CI_ENVIRONMENT')) {
    define('CI_ENVIRONMENT', 'development');
}

// Include the public index file directly
require __DIR__ . '/../public/index.php';

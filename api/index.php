<?php

/**
 * Vercel Bridge for CodeIgniter 4
 *
 * On Vercel the filesystem is read-only, except for /tmp.
 * We create the required CodeIgniter writable subdirectories here
 * before the framework boots.
 */

// Set development mode to show detailed errors
// Remove this once the site is working correctly
$_ENV['CI_ENVIRONMENT'] = 'development';
$_SERVER['CI_ENVIRONMENT'] = 'development';

// Force error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create required subdirectories in /tmp
// (Vercel's only writable location)
$tmpDirs = ['/tmp/cache', '/tmp/logs', '/tmp/session', '/tmp/uploads', '/tmp/debugbar'];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Boot CodeIgniter
require __DIR__ . '/../public/index.php';

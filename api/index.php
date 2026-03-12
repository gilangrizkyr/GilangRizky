<?php

/**
 * Vercel Bridge for CodeIgniter 4
 */

// Production settings
$_ENV['CI_ENVIRONMENT'] = 'production';
$_SERVER['CI_ENVIRONMENT'] = 'production';

// Error reporting off for production
ini_set('display_errors', 0);
error_reporting(0);

// Create required subdirectories in /tmp
$tmpDirs = ['/tmp/cache', '/tmp/logs', '/tmp/session', '/tmp/uploads', '/tmp/debugbar'];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Boot CodeIgniter
require __DIR__ . '/../public/index.php';

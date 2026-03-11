<?php

/**
 * Vercel Bridge for CodeIgniter 4
 * Diagnostic version - outputs early debug info
 */

// Force error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Output early diagnostic
echo "<?php start OK ?>\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Extensions: " . implode(', ', get_loaded_extensions()) . "\n";
echo "pgsql: " . (extension_loaded('pgsql') ? 'YES' : 'NO') . "\n";
echo "pdo_pgsql: " . (extension_loaded('pdo_pgsql') ? 'YES' : 'NO') . "\n";

// Check if vendor exists
$vendorPath = __DIR__ . '/../vendor/autoload.php';
echo "Vendor exists: " . (file_exists($vendorPath) ? 'YES' : 'NO') . "\n";

// Include the public index file directly
require __DIR__ . '/../public/index.php';

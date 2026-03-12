<?php

/**
 * Vercel Bridge for CodeIgniter 4
 *
 * This version includes a Database Diagnostic to troubleshoot "relation not found" errors.
 */

// Set development mode to show detailed errors
$_ENV['CI_ENVIRONMENT'] = 'development';
$_SERVER['CI_ENVIRONMENT'] = 'development';

// Force error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create required subdirectories in /tmp
$tmpDirs = ['/tmp/cache', '/tmp/logs', '/tmp/session', '/tmp/uploads', '/tmp/debugbar'];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// --- DATABASE DIAGNOSTIC BLOCK ---
// We do this BEFORE Booting CI to see raw connectivity
if (isset($_GET['diag_db'])) {
    echo "<h1>Database Diagnostic</h1>";
    $host = getenv('DB_HOSTNAME');
    $user = getenv('DB_USERNAME');
    $pass = getenv('DB_PASSWORD');
    $db = getenv('DB_DATABASE') ?: 'postgres';
    $port = getenv('DB_PORT') ?: '5432';

    $conn_str = "host=$host port=$port dbname=$db user=$user password=$pass connect_timeout=5";
    $conn = pg_connect($conn_str);

    if (!$conn) {
        echo "Connection Failed: " . pg_last_error();
    } else {
        echo "Connection OK!<br>";

        // Check current schema
        $res = pg_query($conn, "SELECT current_schema()");
        $row = pg_fetch_assoc($res);
        echo "Current Schema: " . ($row['current_schema'] ?? 'N/A') . "<br>";

        // List tables in all schemas
        echo "<h2>Visible Tables:</h2>";
        $res = pg_query($conn, "SELECT table_schema, table_name FROM information_schema.tables WHERE table_schema NOT IN ('information_schema', 'pg_catalog') ORDER BY table_schema, table_name");
        echo "<table border='1'><tr><th>Schema</th><th>Table</th></tr>";
        while ($row = pg_fetch_assoc($res)) {
            echo "<tr><td>{$row['table_schema']}</td><td>{$row['table_name']}</td></tr>";
        }
        echo "</table>";
        pg_close($conn);
    }
    exit;
}
// --- END DIAGNOSTIC BLOCK ---

// Boot CodeIgniter
require __DIR__ . '/../public/index.php';

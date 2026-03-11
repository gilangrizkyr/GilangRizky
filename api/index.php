<?php

/**
 * Vercel Bridge for CodeIgniter 4
 * This file handles the routing from Vercel Serverless Functions
 * to the CodeIgniter 4 front controller.
 */

// Include the public index file directly
// FCPATH will be defined in public/index.php as current directory
require __DIR__ . '/../public/index.php';

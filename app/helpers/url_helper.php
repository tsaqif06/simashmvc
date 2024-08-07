<?php

function base_url($path = '')
{
    // Get the protocol
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    // Get the host
    $host = $_SERVER['HTTP_HOST'];
    // Get the directory
    $directory = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    return $protocol . $host . $directory . '/' . ltrim($path, '/');
}

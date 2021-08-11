<?php
session_start();
if (!isset($_SESSION['security_check']))
    $_SESSION['security_check'] = false;
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Origin: http://localhost:8080');
header("Content-type: application/json");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
require_once 'application/bootstrap.php';
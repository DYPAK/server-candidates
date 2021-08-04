<?php

session_id('a123');
session_start();
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: http://localhost:8080');
header("Content-type: application/json");
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
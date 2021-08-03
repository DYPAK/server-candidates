<?php
ini_set('session.gc_maxlifetime', 3600*24*30);
session_start();
header('Access-Control-Allow-Origin: http://localhost:8080');
header("Content-type: application/json");
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
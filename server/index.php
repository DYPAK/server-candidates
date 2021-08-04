<?php
//ini_set('session.use_cookies', 1);
//ini_set('session.use_trans_sid', 1);
//ini_set('session.cookie_lifetime', 3600);
//ini_set('session.cookie_httponly', 0);
//ini_set('session.cookie_domain', '*');
//session_set_cookie_params(7200, "/", "localhost:8080/ListCandidates", false, false);
//ini_set('session.gc_maxlifetime', 3600*24*30);
//ini_set('session.cookie_lifetime', 3600*24*30);
session_id('13');
session_start();
$_SESSION['path'] = session_get_cookie_params();
//$_COOKIE['PHPSESSID'] = 'luqk5oj2mivk0fqsl3uars6vlm2c9g20';
header('Access-Control-Allow-Origin: *'); //http://localhost:8080
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: *'); //http://localhost:8080
header("Content-type: application/json");
//header('Set-Cookie: KEY=VerySecretUniqueKey');
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
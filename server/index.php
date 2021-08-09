<?php

//ini_set( 'session.cookie_httponly', 0 );
//ini_set('session.cookie_domain', $_SERVER['REMOTE_ADDR'].':80'); //http://server/Candidate/index
session_set_cookie_params(["SameSite" => "none"]); //none, lax, strict
session_set_cookie_params(["Secure" => "true"]);
//(["Secure" => "true"]); //false, true
session_set_cookie_params(["HttpOnly" => "true"]); //false, true
session_id('a123');
session_start();
//header("Set-Cookie: PHPSESSID=471r3d559lff4j7b3ufu0g3r5kum42q4; path=/; Secure; HttpOnly; SameSite=none");
//setcookie("dasdas","12312",3600,"/","",true,true);
//header("Set-Cookie: asdasd=12331; path=/; HttpOnly; SameSite=none; Secure;");
//$_SESSION['HTTP_ORIGIN'] = $_SERVER ['HTTP_ORIGIN'];
//$_SESSION['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
//$_SESSION['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] = $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'];
//$_SESSION['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'] = $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']  ;
//$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
//$_SESSION['SERVER_NAME'] = $_SERVER['SERVER_NAME'];
//$_SESSION['HTTP_HOST'] = $_SERVER['HTTP_HOST'];
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Headers: http://localhost:8080');
header("Content-type: application/json");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//header('Access-Control-Expose-Headers: Set-Cookie,Cookie');
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
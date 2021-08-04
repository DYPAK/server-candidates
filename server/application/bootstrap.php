<?php
session_start();
/* подключаем файлы ядра */
require_once 'core/controller.php';
require_once 'core/model.php';

/* подключаем маршрутизатор и запускаем его на выполнение */
require_once 'core/route.php';
Route::start();
?>

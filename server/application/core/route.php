<?php
session_start();
class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Authorization';
		$action_name = 'index';
    //разделение адреса на составляющие по explode
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		 //получаем имя контроллера
		if ( !empty($routes[1])  && ($routes[1]!='favicon.ico') )
		{
			$controller_name = $routes[1];
		}

		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
            $action_routes = explode('?', $routes[2]);
            $action_name = $action_routes[0];
		}

		// добавляем префиксы
    $model_name = 'Model_'.$controller_name;
	  $controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

    // подцепляем файл с классом модели (файла модели может и не быть)
    $model_file = strtolower($model_name).'.php';
	  $model_path = "application/models/".$model_file;
    if(file_exists($model_path))
    {
      include "application/models/".$model_file;
		}
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name);
		$controller_path = "application/controller/".$controller_file.'.php';
		if(file_exists($controller_path))
		{
		    include "application/controller/" .$controller_file.'.php';
		} else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();

		}
		else
		{
			Route::ErrorPage404();
			// здесь также разумнее было бы кинуть исключение		}
		}
	}
	static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
				header("Status: 404 Not Found");
				header('Location:'.$host.'404');
  }
}
?>
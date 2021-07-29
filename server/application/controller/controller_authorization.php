<?php

class Controller_Authorization extends Controller
{
    public function __construct()
    {
//        $this->view= new View();
        $this->model = new Model_Authorization();
    }

    function action_index()
    {
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['login'])) {

            $login = trim($_POST['login']);
            $password = trim($_POST['password']);

            $key = $this->model->authorizationUser($login, $password);
//            header('Access-Control-Allow-Origin: http://localhost:8080/');
            header("Content-type: application/json");
            if (isset($key))
            echo json_encode($key);
        }

        if($_GET['page'] != NULL) {
            echo json_encode("lol");
        }

    }
}

?>
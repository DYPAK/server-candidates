<?php

class Controller_Registration extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Registration();
    }

    function action_index()
    {
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['full_name'])) {

            $login = trim($_POST['login']);
            $password = trim($_POST['password']);

            $key = $this->model->registrationUser($_POST['full_name'], $_POST['login'], $_POST['email'], $_POST['password'], $_POST['password_confirm']);
            if(isset($key)){
                echo json_encode($key);
            }
        }
    }
}

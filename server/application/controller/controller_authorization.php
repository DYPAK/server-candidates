<?php

class Controller_Authorization extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Authorization();
    }

    function action_index()
    {
<<<<<<< HEAD
=======

>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['login'])) {

            $login = trim($_POST['login']);
            $password = trim($_POST['password']);

<<<<<<< HEAD
=======
            $login = htmlspecialchars($login);
            $password = htmlspecialchars($password);

>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
            $key = $this->model->authorizationUser($login, $password);
            if (isset($key))
                echo json_encode($key);
        }

<<<<<<< HEAD
=======
        if($_GET['page'] != NULL) {
            echo json_encode("lol");
        }
>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
    }
}

?>
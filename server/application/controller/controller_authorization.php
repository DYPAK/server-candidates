<?php

class Controller_Authorization extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Authorization();
    }

    function action_index()
    {
        $_SESSION['namePage'] = "authorization";
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['login'])) {

            $login = htmlspecialchars(trim($_POST['login']));
            $password = htmlspecialchars(trim($_POST['password']));

            $key = $this->model->authorizationUser($login, $password);
            if (isset($key))
                echo json_encode($key);
        }

        if($_GET['page'] != NULL) {
            echo json_encode("lol");
        }
       
    }
}

?>

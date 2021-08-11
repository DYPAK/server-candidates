<?php
session_start();
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
            if (isset($key)) {

                $_SESSION['security_check'] = $key;
                echo json_encode($key);
            }
        }

       
    }
}

?>

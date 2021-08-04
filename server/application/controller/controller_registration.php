<?php
session_start();
class Controller_Registration extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Registration();
    }

    function action_index()
    {
        $_SESSION['namePage'] = "registration";
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['registration']['full_name'])) {

            $full_name = htmlspecialchars(trim($_POST['registration']['full_name']));
            $login = htmlspecialchars(trim($_POST['registration']['login']));
            $email = htmlspecialchars(trim($_POST['registration']['email']));
            $password = htmlspecialchars(trim($_POST['registration']['password']));
            $password_confirm = htmlspecialchars(trim($_POST['registration']['passwordConfirm']));

            $key = $this->model->registrationUser($full_name, $login, $email, $password, $password_confirm);
            if(isset($key)){
                echo json_encode($key);
            }
        }
    }
}

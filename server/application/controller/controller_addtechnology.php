<?php
session_start();
class Controller_AddTechnology extends Controller
{
    public function __construct()
    {
        $this->model = new Model_AddTechnology();
    }

    function action_index()
    {
        $_SESSION['namePage'] = "addtechnology";
        $answer = false;
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);
        if (isset($_POST['name'])) {
            $name = htmlspecialchars(trim($_POST['name']));
            $answer = $this->model->addTechnology($name);
            echo json_encode($answer);
        }
    }

}

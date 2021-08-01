<?php

class Controller_Technology extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Technology();
    }

    function action_index()
    {
        $output = false;
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);
        if(isset($_POST['updateTechnology'])) {
            $id = htmlspecialchars(trim($_POST['updateTechnology']['id']));
            $name = htmlspecialchars(trim($_POST['updateTechnology']['newName']));
            $output = $this->model->updateTechnology($id,$name);
        } else {
            $output = $this->model->getAllTechnologies();
        }

        echo json_encode($output);
    }
}
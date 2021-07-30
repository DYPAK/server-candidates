<?php

class Controller_Candidate extends Controller
{

    public function __construct()
    {
        $this->model = new Model_Candidate();
    }

    function action_index()
    {
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['id'])) {
            echo json_encode("rrr");
        }
        else {
            echo json_encode("arr");
        }

    }
}
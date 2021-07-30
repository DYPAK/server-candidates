<?php

class Controller_Candidates extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Candidates();
    }

    function action_index()
    {
        $data = $this->model->getAllTechnology();

        if ($_POST != NULL) {
            $this->model->addCandidates($_POST);
        }
    }

}


?>
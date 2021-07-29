<?php

class Controller_Candidates extends Controller
{
    public function __construct()
    {
        $this->view= new View();
        $this->model = new Model_Candidates();
    }

    function action_index()
    {
        $data = $this->model->getAllTechnology();

        $this->view->generate('candidates.php', null, $data);

        if ($_POST != NULL) {
            $this->model->addCandidates($_POST);
        }
    }

}


?>
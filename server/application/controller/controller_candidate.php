<?php

class Controller_Candidate extends Controller
{

    public function __construct()
    {
        $this->view= new View();
        $this->model = new Model_Candidate();
    }

    function action_index()
    {
        if($_POST != NULL)
        {
            $this->model->changeCandidate($_POST);
        }
        $data = $this->model->getAllCandidates();
        $this->view->generate('candidate.php', null,$data);

    }
}
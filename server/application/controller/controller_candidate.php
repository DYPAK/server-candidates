<?php

class Controller_Candidate extends Controller
{
    const CANDIDATES = 5;

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
            $allTechnologies = $this->model->getAllTechnologies();
            $mas = $this->model->getAllCandidates($allTechnologies);
            $candidates = $this->model->sortCandidates($mas,$allTechnologies,self::CANDIDATES);
            echo json_encode($candidates);
        }
    }
}
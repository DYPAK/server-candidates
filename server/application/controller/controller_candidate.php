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
        $output = false;
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['updateCandidate'])) {

            $output = false;
            $id = htmlspecialchars(trim($_POST['updateCandidate']['id']));
            $name = htmlspecialchars(trim($_POST['updateCandidate']['name']));
            $date = htmlspecialchars(trim($_POST['updateCandidate']['date']));
            $description = htmlspecialchars(trim($_POST['updateCandidate']['description']));
            $technology = null; $i = 0;
            foreach ($_POST['updateCandidate']['technologies'] as $value)
            {
                $technology[$i] = htmlspecialchars(trim($value));
                $i++;
            }
            if ($technology != null) {

            }

        }
        if (isset($_POST['page'])) {
            $page =  htmlspecialchars(trim($_POST['page']));
            $this->model->checkSelector($_POST['page']);
        }
        if (isset($_POST['searchCandidates'])) {
            $name = htmlspecialchars(trim($_POST['searchCandidates']['name']));
            $dateStart = htmlspecialchars(trim($_POST['searchCandidates']['dateStart']));
            $dateEnd = htmlspecialchars(trim($_POST['searchCandidates']['dateEnd']));
            $i=0;
            $technology = [];
            foreach ($_POST['searchCandidates']['technologies'] as $value)
            {
                $technology[$i] = htmlspecialchars(trim($value));
                $i++;
            }
            $allTechnologies = $this->model->getAllTechnologies();
            $mas = $this->model->getAllCandidates($technology,$name,$dateStart,$dateEnd);
            $output = $this->model->sortCandidates($mas,$allTechnologies,self::CANDIDATES);
        }
        else {

            $allTechnologies = $this->model->getAllTechnologies();
            $mas = $this->model->getAllCandidates();
            $output = $this->model->sortCandidates($mas,$allTechnologies,self::CANDIDATES);

        }
        echo json_encode($output);
    }

}

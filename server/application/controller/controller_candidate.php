<?php
session_start();
class Controller_Candidate extends Controller
{
    const CANDIDATES = 2;

    public function __construct()
    {
        $this->model = new Model_Candidate();
    }

    function action_index()
    {
        $output = false;
        $_SESSION['BAD'] = $_GET;
        if ($_SESSION['namePage'] != "candidate") {
            $_SESSION['name'] = "";
            $_SESSION['dateStart'] = "0001-01-01";
            $_SESSION['dateEnd'] = "9999-12-31";
            $_SESSION['technology'] = [];
        }
        $_SESSION['namePage'] = "candidate";
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (isset($_POST['updateCandidate'])) {
            $output = false;
            $id = htmlspecialchars(trim($_POST['updateCandidate']['id']));
            $name = htmlspecialchars(trim($_POST['updateCandidate']['name']));
            $date = htmlspecialchars(trim($_POST['updateCandidate']['date']));
            $description = htmlspecialchars(trim($_POST['updateCandidate']['description']));
            $technology = [];
            foreach ($_POST['updateCandidate']['technologies'] as $key => $value)
            {
                $i = htmlspecialchars(trim($key));
                $technology[$i]['skill'] = htmlspecialchars(trim($value['value']));
                if ($value['id_connect'] != null) {
                    $technology[$i]['id_connect'] = htmlspecialchars(trim($value['id_connect']));
                } else {
                    $technology[$i]['id_connect'] = $value['id_connect'];
                }
            }
            if ($technology != []) {
                $output = $this->model->UpdateCandidate($id,$name,$date,$description,$technology);
            }
        }
        else if (isset($_POST['send'])) {
            $selectorAction =  $_POST['send']['selectorAction'];
            $currentPage =  htmlspecialchars(trim($_POST['send']['currentPage']));
            $maxPage =  htmlspecialchars(trim($_POST['send']['maxPage']));
            $page = $this->model->checkSelector($selectorAction, $currentPage, $maxPage );
            $allTechnologies = $this->model->getAllTechnologies();
            $mas = $this->model->getAllCandidates($_SESSION['technology'],$_SESSION['name'],$_SESSION['dateStart'],$_SESSION['dateEnd']);
            $output = $this->model->sortCandidates($mas,$allTechnologies,self::CANDIDATES, $page);
            //$output = ($_POST['send']['selectorAction']);
        }
        else if (isset($_POST['searchCandidates'])) {
            $_SESSION['name'] = htmlspecialchars(trim($_POST['searchCandidates']['name']));
            $_SESSION['dateStart'] = htmlspecialchars(trim($_POST['searchCandidates']['dateStart']));
            $_SESSION['dateEnd'] = htmlspecialchars(trim($_POST['searchCandidates']['dateEnd']));
            $i=0;
            ($_SESSION['dateStart'] == "") ? $_SESSION['dateStart'] = "0001-01-01" : 0;
            ($_SESSION['dateEnd'] == "") ? $_SESSION['dateEnd'] = "9999-11-20" : 0 ;
            $_SESSION['technology'] = [];
            foreach ($_POST['searchCandidates']['technologies'] as $value)
            {
                $_SESSION['technology'][$i] = htmlspecialchars(trim($value));
                $i++;
            }
            $allTechnologies = $this->model->getAllTechnologies();
            $mas = $this->model->getAllCandidates($_SESSION['technology'],$_SESSION['name'],$_SESSION['dateStart'],$_SESSION['dateEnd']);
            $output = $this->model->sortCandidates($mas,$allTechnologies,self::CANDIDATES);
        }
        else {
            $allTechnologies = $this->model->getAllTechnologies();
            $mas = $this->model->getAllCandidates($_SESSION['technology'],$_SESSION['name'],$_SESSION['dateStart'],$_SESSION['dateEnd']);
            $output = $this->model->sortCandidates($mas,$allTechnologies,self::CANDIDATES);
//            $allTechnologies = $this->model->getAllTechnologies();
//            $candidates = $this->model->getAllCandidates(self::CANDIDATES);
//            $skills = $this->model->getAllSkill($candidates);
//            $output = $this->model->sortCandidates($allTechnologies, $candidates, $skills);
        }
        echo json_encode($output);
    }
}

<?php
session_start();
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
            $technology = $this->checkUpdateCandidate($_POST);
            if ($technology != []) {
                $output = $this->model->UpdateCandidate($id,$name,$date,$description,$technology);
            }
        }
        else if (isset($_POST['send'])) {
            $selectorAction =  $_POST['send']['selectorAction'];
            $currentPage =  htmlspecialchars(trim($_POST['send']['currentPage']));
            $maxPage =  htmlspecialchars(trim($_POST['send']['maxPage']));
            $page = $this->model->checkSelector($selectorAction, $currentPage, $maxPage );
            $number = ($page-1)*self::CANDIDATES+1;
            $output = $this->createPage(self::CANDIDATES,$_SESSION['name'],$_SESSION['dateStart'],$_SESSION['dateEnd'], $_SESSION['technology'],$page, $number);
        }
        else if (isset($_POST['searchCandidates'])) {
            $_SESSION['name'] = htmlspecialchars(trim($_POST['searchCandidates']['name']));
            $_SESSION['dateStart'] = htmlspecialchars(trim($_POST['searchCandidates']['dateStart']));
            $_SESSION['dateEnd'] = htmlspecialchars(trim($_POST['searchCandidates']['dateEnd']));
            ($_SESSION['dateStart'] == "") ? $_SESSION['dateStart'] = "0001-01-01" : 0;
            ($_SESSION['dateEnd'] == "") ? $_SESSION['dateEnd'] = "9999-11-20" : 0 ;
            $_SESSION['technology'] = []; $i=0;
            foreach ($_POST['searchCandidates']['technologies'] as $value)
            {
                $_SESSION['technology'][$i] = htmlspecialchars(trim($value));
                $i++;
            }
            $output = $this->createPage(self::CANDIDATES,$_SESSION['name'],$_SESSION['dateStart'],$_SESSION['dateEnd'], $_SESSION['technology']);
        }
        else {
            $output = $this->createPage(self::CANDIDATES,$_SESSION['name'],$_SESSION['dateStart'],$_SESSION['dateEnd'], $_SESSION['technology']);
        }
        echo json_encode($output);
    }

    /** Функия вызывает методы
     * для генерации страницы
     * @param $limit
     * @param string $name
     * @param string $dateStart
     * @param string $dateEnd
     * @param array $searchTechnology
     * @param int $page
     * @param int $number
     * @return array
     */
    function createPage($limit, $name="", $dateStart="0001-01-01", $dateEnd="9999-11-20", $searchTechnology=[], $page=1, $number=1) {

        $allTechnologies = $this->model->getAllTechnologies();
        $mas= $this->model->getAllCandidates($limit, $name, $dateStart,$dateEnd,$searchTechnology,$page);
        $skills = $this->model->getAllSkill($mas['candidates']);
        $output = $this->model->sortCandidates($allTechnologies, $mas['candidates'], $skills,$number);
        $output['maxPage'] = $mas['maxPage'];

        return $output;
    }

    /** Функция проверяет массив технологий
     * @param array $technologies
     * @return array
     */
    function checkUpdateCandidate($technologies=[]) {

        $technology = [];
        foreach ($technologies['updateCandidate']['technologies'] as $key => $value)
        {
            $i = htmlspecialchars(trim($key));
            $technology[$i]['skill'] = htmlspecialchars(trim($value['value']));
            if ($value['id_connect'] != null) {
                $technology[$i]['id_connect'] = htmlspecialchars(trim($value['id_connect']));
            } else {
                $technology[$i]['id_connect'] = $value['id_connect'];
            }
        }
        return $technology;
    }
}

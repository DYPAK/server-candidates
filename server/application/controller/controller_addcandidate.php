<?php
session_start();
class Controller_AddCandidate extends Controller
{
    public function __construct()
    {
        $this->model = new Model_AddCandidate();
    }

    function action_index()
    {
        $_SESSION['namePage'] = "addcandidate";
        $answer = false;
        $_POST = (array)json_decode(file_get_contents('php://input'), TRUE);
        if ($_POST['candidateObject']) {
            $technology = [];
            foreach ($_POST['candidateObject']['technologies'] as $key => $id)
            {
                $i = htmlspecialchars(trim($key));
                $technology[$i] = htmlspecialchars(trim($id['value']));
            }
            if ($technology != []) {
                $name = htmlspecialchars(trim($_POST['candidateObject']['name']));
                $date = htmlspecialchars(trim($_POST['candidateObject']['date']));
                $description = htmlspecialchars(trim($_POST['candidateObject']['description']));
                $answer = $this->model->AddCandidate($name,$date,$description,$technology);
            }
            echo json_encode($answer);
        } else {
           echo json_encode($this->model->getAllTechnologies());
        }
    }

}


?>
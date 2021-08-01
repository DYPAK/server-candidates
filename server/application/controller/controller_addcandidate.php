<?php

class Controller_AddCandidate extends Controller
{
    public function __construct()
    {
        $this->model = new Model_AddCandidate();
    }

    function action_index()
    {
        $answer = false;
        if ($_POST['candidateObject']) {
            $technology = [];
            foreach ($_POST['candidateObject']['technologies'] as $key => $value)
            {
                $i = htmlspecialchars(trim($key));
                $technology[$i] = htmlspecialchars(trim($value));
            }
            if ($technology != []) {
                $name = htmlspecialchars(trim($_POST['candidateObject']['name']));
                $date = htmlspecialchars(trim($_POST['candidateObject']['date']));
                $description = htmlspecialchars(trim($_POST['candidateObject']['description']));
                $answer = $this->model->AddCandidate($name,$date,$description,$technology);
            }
        }
        echo json_encode($answer);
    }

}


?>
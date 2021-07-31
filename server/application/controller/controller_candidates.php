<<<<<<< HEAD
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


=======
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


>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
?>
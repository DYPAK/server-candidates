<<<<<<< HEAD
<?php

class Controller_Technologies extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Technologies();
    }

    function action_index()
    {
        $data = $this->model->getAllTechnologies();
    }
=======
<?php

class Controller_Technologies extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Technologies();
    }

    function action_index()
    {
        $data = $this->model->getAllTechnologies();
    }
>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
}
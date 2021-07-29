<?php

class Controller_Technologies extends Controller
{
    public function __construct()
    {
        $this->view= new View();
        $this->model = new Model_Technologies();
    }

    function action_index()
    {
        $data = $this->model->getAllTechnologies();
        $this->view->generate('technologies.php', null,$data);
    }
}
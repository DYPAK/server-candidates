<?php

class Controller_Technology extends Controller
{
    public function __construct()
    {
        $this->view= new View();
        $this->model = new Model_Technology();
    }

    function action_index()
    {
        $key_security = $this->model->checkTechnology($_POST["new_technology"]);

        if ($key_security)
        {
            $this->model->addTechnology($_POST["new_technology"]);
        }

        $this->view->generate('technology.php', null, $key_security);
    }
}
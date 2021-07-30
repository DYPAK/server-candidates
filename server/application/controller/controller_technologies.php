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
}
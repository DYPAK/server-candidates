<?php

class Controller_404 extends Controller
{
    public function __construct()
    {
        $this->view= new View();
        $this->model = new Model_Authorization();
    }

    function action_index()
    {
        $error = "404";
        return json_encode($error);
    }
}

?>
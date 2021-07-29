<?php

class Controller_Registration extends Controller
{
    public function __construct()
    {
        $this->view= new View();
        $this->model = new Model_Registration();
    }

    function action_index()
    {

        $this->model->registrationUser($_POST['full_name'], $_POST['login'], $_POST['email'], $_POST['password'], $_POST['password_confirm']);
        $this->view->generate('registration.php',"");
    }
}
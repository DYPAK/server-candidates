<<<<<<< HEAD
<?php

class Controller_Technology extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Technology();
    }

    function action_index()
    {
        $key_security = $this->model->checkTechnology($_POST["new_technology"]);

        if ($key_security)
        {
            $this->model->addTechnology($_POST["new_technology"]);
        }

    }
=======
<?php

class Controller_Technology extends Controller
{
    public function __construct()
    {
        $this->model = new Model_Technology();
    }

    function action_index()
    {
        $key_security = $this->model->checkTechnology($_POST["new_technology"]);

        if ($key_security)
        {
            $this->model->addTechnology($_POST["new_technology"]);
        }

    }
>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
}
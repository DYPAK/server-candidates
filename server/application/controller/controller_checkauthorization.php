<?php
session_start();
class Controller_CheckAuthorization extends Controller
{
    public function __construct()
    {
        $this->model = new Model_CheckAuthorization();
    }

    function action_index()
    {
        if(isset($_SESSION['security_check'])){
            echo json_encode($_SESSION['security_check']);
        }
        else {
            echo false;
        }
    }
}
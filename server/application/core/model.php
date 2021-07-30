<?php

class Model
{
    public $connect;

    function __construct()
    {
        $this->connect = new PDO('mysql:host=localhost;dbname=ritg v', 'root','root');
        $this->connect->exec("SET NAME UTF8");
        //$this->connect = mysqli_connect('localhost','root','root','ritg v');

        if (!$this->connect)
        {
            die("Problem with data base");
        }
    }

}
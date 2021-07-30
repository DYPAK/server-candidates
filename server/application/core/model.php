<?php

class Model
{
    public $connect;

    function __construct()
    {
        $this->connect = new PDO('mysql:host=localhost;dbname=ritg v','root','root');
        $this->connect->exec("SET NAME UTF8");
        if (!$this->connect)
        {
            die("Problem with data base");
        }
    }

}
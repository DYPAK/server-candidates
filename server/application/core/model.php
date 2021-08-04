<?php
session_start();
class Model
{
    public $connect;

    function __construct()
    {
        $this->connect = new PDO('mysql:host=localhost;dbname=ritg v', 'root','root');

        if (!$this->connect)
        {
            die("Problem with data base");
        }
    }

}
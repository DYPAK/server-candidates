<?php

class Model
{
    public $connect;

    function __construct()
    {
        $this->connect = mysqli_connect('localhost','root','root','ritg v');

        if (!$this->connect)
        {
            die("Problem with data base");
        }
    }

}
<<<<<<< HEAD
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

=======
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

>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
}
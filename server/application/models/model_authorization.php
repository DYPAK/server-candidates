<?php

class Model_Authorization extends Model
{
    function authorizationUser($login, $password)
    {
        $connect = $this->connect;
        $key = null;
        $password = md5($password);
        if ($login != "" && $password != "")
        {
            $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
            if(mysqli_num_rows($check_user) > 0) {
                $key = true;
            }
            else{
                $key = false;
            }
        }
        return $key;
    }
}
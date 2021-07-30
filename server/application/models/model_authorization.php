<?php

class Model_Authorization extends Model
{
    function authorizationUser($login, $password)
    {
        $key = null;
        $password = md5($password);
        if ($login != "" && $password != "")
        {
            $sql = "SELECT * FROM `users` WHERE `login`=:login AND `password`=:password";
            $query = $this->connect->prepare($sql);
            $params = ['login'=> $login, 'password'=>$password];
            $query ->execute($params);
            $check_user = $query -> fetch(PDO::FETCH_NUM) ;
            if($check_user != NULL) {
                $key = true;
            }
            else{
                $key = false;
            }
        }
        return $key;
    }
}
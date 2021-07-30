<?php

class Model_Registration extends Model
{
    function registrationUser($full_name, $login, $email, $password, $password_confirm) {
      $key = null;
      $connect = $this->connect;
      $password = md5($password);
      $password_confirm = md5($password_confirm);
        if($full_name != NULL && $login != NULL && $email != NULL && $password != NULL && $password_confirm != NULL) {
              $data_email = "SELECT * FROM `users` WHERE `email`!=:email";
              $query_email = $connect->prepare($data_email);
              $email_param = ['email'=>$email];
              $query_email->execute($email_param);
              $check_email = $query_email -> fetch(PDO::FETCH_NUM);
              if($check_email != NULL) {
                if($password == $password_confirm){
                $sql= "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) VALUES (NULL, :full_name, :login, :email, :password";
                $query = $connect->prepare($sql);
                $params = ['full_name'=>$full_name, 'login'=>$login, 'email'=>$email, 'password'=>$password];
                $query->execute($params);
                $key = true;
              } else {
                $key = false;
              }
            }
        }
        return $key;
    }
}
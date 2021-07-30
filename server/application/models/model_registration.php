<?php

class Model_Registration extends Model
{
    function registrationUser($full_name, $login, $email, $password, $password_confirm) {

      if($full_name != NULL && $login != NULL && $email != NULL && $password != NULL && $password_confirm != NULL) {
        if($password == $password_confirm) {
            $password = md5($password);
            mysqli_query($this->connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) VALUES (NULL, '$full_name', '$login', '$email', '$password')");
            //header('Location: ../../Authorization/index');
            return true;

        } else {
          //header('Location: ../../Registration/index');
            return false;
        }
      }
    }
}
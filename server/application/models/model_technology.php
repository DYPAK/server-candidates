<?php

class Model_Technology extends Model
{
    function addTechnology($technology)
    {
        $connect = $this->connect;
        $table = "candidates";

        $sql = "ALTER TABLE `".$table."` ADD `".$technology."` INT(10) NOT NULL AFTER `review`";

        mysqli_query($connect, $sql);
    }

    function checkTechnology($technology)
    {
        // Установления ключа проверки
        $key = true;

        //Подключение базы данных
        $connect = $this->connect;
        $table = "candidates";

        //Проверка на повтрор технологии
        $column_candidates = mysqli_query($connect, "SHOW COLUMNS FROM `".$table."`");
        $column_candidates = mysqli_fetch_all($column_candidates);

        for ($i = 7; $i < count($column_candidates); $i++)
        {
            if($column_candidates[$i][0] == $technology)
            {
                $key = false;
            }
        }

        return $key;
    }

}
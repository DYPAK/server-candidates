<?php

class Model_Technologies extends Model
{
    function getAllTechnologies()
    {
        $connect = $this->connect;
        $table = "candidates";

        //Получение массива технологий
        $column_candidates = mysqli_query($connect, "SHOW COLUMNS FROM `".$table."`");
        $column_candidates = mysqli_fetch_all($column_candidates);

        for ($i = 7; $i < count($column_candidates); $i++)
        {
            $all_technology[$i] = $column_candidates[$i][0];
        }

        return $all_technology;
    }
}
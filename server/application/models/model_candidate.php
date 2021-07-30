<?php

class Model_Candidate extends Model
{
    /**
     * function return
     * array from data base candidates
     * @return array
     */
    function getAllCandidates(){
        $connect = $this->connect;
        // Выбор таблицы
        $table = "candidates";

        //Получение массива технологий
        $column_candidates = mysqli_query($connect, "SHOW COLUMNS FROM `".$table."`");
        $column_candidates = mysqli_fetch_all($column_candidates);

        //Получение кандидатов
        $all_candidates = mysqli_query($connect, "SELECT * FROM `".$table."`");
        $all_candidates = mysqli_fetch_all($all_candidates);

        for ($i = 7; $i < count($column_candidates); $i++)
        {
            $all_technology[$i] = $column_candidates[$i][0];
        }

        $data[0] = $all_candidates;
        $data[1] = $all_technology;

        return $data;
    }

    function changeCandidate($data)
    {
        $connect = $this->connect;
        // Выбор таблицы
        $table = "candidates";

        $sql = "UPDATE `".$table."` SET ";

        $i = 0;
        foreach ($data as $key => $value)
        {
            $mas_key[$i] = $key;
            $mas_value[$i]= $value;
            $i++;
        }

        for ($i = 0; $i < count($data)-2; $i++)
        {
            $sql .= '`'.$mas_key[$i]."` = '".$mas_value[$i]."', ";
        }

        $sql .= "`".$mas_key[$i]."` = '".$mas_value[$i]."' WHERE `".$table.'`.`'.$mas_key[$i + 1].'` = '.$mas_value[$i+1];

        mysqli_query($connect, $sql);
    }

}

<<<<<<< HEAD
<?php

class Model_Candidates extends Model
{
    /**
     * @param $wage
     * function check the
     * correctness of the
     * wage
     * @return bool
     */
    function checkСandidates($wage)
    {
        $key = true;
        if (!(preg_match("/\d+/",$wage))) {
            $key = false;
        }
        return $key;
    }

    /**
     * @param $data
     * add new string
     * in data base
     */
    function addCandidates($data){
        $connect = $this->connect;

        //Подключение таблицы
        $table = "`candidates`";

        //Формирование sql запроса
        $sql_key = "INSERT INTO ".$table." (";
        $sql_value = ") VALUES (";

        $i = 0;
        foreach ($data as $key => $value)
        {
            $mas_key[$i] = "`".$key."`";
            $mas_value[$i]= "'".$value."'";
            $i++;
        }

        for ($i = 0; $i < count($data)-1; $i++)
        {
            $sql_key .= $mas_key[$i].", ";
            $sql_value .= $mas_value[$i].", ";
        }

        $sql_key .= $mas_key[$i];
        $sql_value .= $mas_value[$i].")";

        //Финальный sql запрос
        $sql = $sql_key.$sql_value;

        mysqli_query($connect, $sql);
    }

    function getAllTechnology()
    {
        $connect = $this->connect;

        //Подключение таблицы
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
=======
<?php

class Model_Candidates extends Model
{
    /**
     * @param $wage
     * function check the
     * correctness of the
     * wage
     * @return bool
     */
    function checkСandidates($wage)
    {
        $key = true;
        if (!(preg_match("/\d+/",$wage))) {
            $key = false;
        }
        return $key;
    }

    /**
     * @param $data
     * add new string
     * in data base
     */
    function addCandidates($data){
        $connect = $this->connect;

        //Подключение таблицы
        $table = "`candidates`";

        //Формирование sql запроса
        $sql_key = "INSERT INTO ".$table." (";
        $sql_value = ") VALUES (";

        $i = 0;
        foreach ($data as $key => $value)
        {
            $mas_key[$i] = "`".$key."`";
            $mas_value[$i]= "'".$value."'";
            $i++;
        }

        for ($i = 0; $i < count($data)-1; $i++)
        {
            $sql_key .= $mas_key[$i].", ";
            $sql_value .= $mas_value[$i].", ";
        }

        $sql_key .= $mas_key[$i];
        $sql_value .= $mas_value[$i].")";

        //Финальный sql запрос
        $sql = $sql_key.$sql_value;

        mysqli_query($connect, $sql);
    }

    function getAllTechnology()
    {
        $connect = $this->connect;

        //Подключение таблицы
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
>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce
}
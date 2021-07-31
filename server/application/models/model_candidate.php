<<<<<<< HEAD
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
=======
<?php

class Model_Candidate extends Model
{
    /**
     * function take
     * in bd mas technologies
     * @return array
     */
    function getAllTechnologies()
    {
        $sql = "SELECT technology FROM `technologies`";
        $query = $this->connect->prepare($sql);
        $query ->execute();
        $mas = $query -> fetchAll(PDO::FETCH_NAMED);
        $result = Array();
            $i = 0;
            foreach ($mas as $technology)
            {
                $result[$i] = $technology['technology'];
                $i++;
            }
        return $result;
    }


    /**
     * function search and return
     * mas witch candidates
     * @param array $technologiesCheck
     * @param string $name
     * @param string $dateStart
     * @param string $dateEnd
     * @return array
     */
    function getAllCandidates($technologiesCheck=[], $name="", $dateStart="0001-01-01", $dateEnd="9999-12-31") {

        $sql = 'SELECT id_candidates, full_name, date_of_birth, description, technology, skill  FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id '
            .'WHERE (full_name LIKE ? ) AND (date_of_birth >= ?) AND (date_of_birth <= ?)';

        $params = [0 => "%$name%", 1 => $dateStart, 2 => $dateEnd];

        if ($technologiesCheck != null) {
            $sql .=" AND (technology = ? )";
            $params[3] = $technologiesCheck[0];
            for($i = 1; $i < count($technologiesCheck); $i++ ) {
                $sql .=" AND (technology = ? )";
                $params[$i+3] = $technologiesCheck[$i];
            }
        }
        $sql .= "ORDER BY can.id";
        $query = $this->connect->prepare($sql);
        $query ->execute($params);
        return $query -> fetchAll(PDO::FETCH_CLASS);

    }

    /**
     * function create
     * answer user
     * @param $allCandidates
     * @param $technologiesBase
     * @param $candidates_one_page
     * @param int $page
     * @return array
     */
    function sortCandidates($allCandidates, $technologiesBase, $candidates_one_page, $page=1) {
        $cand= [];
        $technologies = [];
        if (isset($technologiesBase))
            foreach($technologiesBase as $technologyBase) {
                $technologies[$technologyBase] = 0;
            }
        $j = -1; $temp_1 = $allCandidates[0]->id_candidates + 1;
        $result['technologies'] = $technologiesBase;
        for ($i = 0; $i < count($allCandidates); $i++) {
            if ($temp_1 != $allCandidates[$i] ->id_candidates) {
                $j++;
                $cand[$j]['number'] = $j+1;
                $cand[$j]['id'] = $allCandidates[$i] -> id_candidates;
                $cand[$j]['name'] = $allCandidates[$i] -> full_name;
                $cand[$j]['date'] = $allCandidates[$i] -> date_of_birth;
                $cand[$j]['description'] = $allCandidates[$i] -> description;
                $cand[$j]['technology'] = $technologies;
                $temp_1 = $allCandidates[$i] ->id_candidates;
            }
            $cand[$j]['technology'][$allCandidates[$i] ->technology] = $allCandidates[$i] ->skill;

        }
        $j = 0; $i = $page-1; $candidates_one_page = $candidates_one_page + $i;
        while (($i < $candidates_one_page) && ($cand[$i] == [])) {
            $result['candidate'][$j] = $cand[$i];
            $i++; $j++;
        }
        $result['maxPage'] = ceil(count($cand)/$candidates_one_page);
        ($result['maxPage'] == 0) ? $result['maxPage'] = 1 : 0;
        $result['candidate'] = $cand;
        return $result;
    }

//    function UpdateCandidate($id, $name, $date, $description, $technologies) {
//        $sql = 'SELECT id_candidates, full_name, date_of_birth, description, technology, skill  FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id '
//            .'WHERE (full_name LIKE ? ) AND (date_of_birth >= ?) AND (date_of_birth <= ?)';
//
//        //  $params = [0 => "%$name%", 1 => $dateStart, 2 => $dateEnd];
//
//    }
//
//    function checkSelector($selector, $number_page, $max_page)
//    {
//        if (preg_match("/(-)|(\+)/",$selector)) {
//            ($selector == "+")? $selector = ++$number_page : $selector = --$number_page;
//        }
//        if (preg_match("/\d+/",$selector)) {
//            ($selector > $max_page) ? $selector = $max_page : 0 ;
//            ($selector < 1) ? $selector = 1 : 0 ;
//            return (int)$selector;
//        }
//        return $number_page;
//    }


}
>>>>>>> 785a677b0f9f43ff19f1957ce50a97de5229b9ce

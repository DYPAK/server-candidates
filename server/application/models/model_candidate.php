<?php

class Model_Candidate extends Model
{

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

    function getAllCandidates($technologiesCheck=[], $name="", $dateStart="0001-01-01", $dateEnd="9999-12-31") {

        $sql = 'SELECT id_candidates, full_name, date_of_birth, description, technology, skill  FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id '
            .'WHERE (full_name LIKE ? ) AND (date_of_birth >= ?) AND (date_of_birth <= ?)';

        $params = [0 => "%$name%", 1 => $dateStart, 2 => $dateEnd];

        if ($technologiesCheck != null) {
            $sql .=" AND (technology = ? )";
            $params[3] = $technologiesCheck[0];
            for($i = 1; $i < count($technologiesCheck); $i++ ) {
                $sql .=" OR (technology = ? )";
                $params[$i+3] = $technologiesCheck[$i];
            }
        }
        $sql .= "ORDER BY can.id";
        $query = $this->connect->prepare($sql);
            $query ->execute($params);
        return $query -> fetchAll(PDO::FETCH_CLASS);

    }

    function sortCandidates($allCandidates, $technologiesBase, $candidates_one_page, $page=1) {
        $cand= [];
        $technologies = [];
        if (isset($technologiesBase))
            foreach($technologiesBase as $technologyBase) {
                $technologies[$technologyBase] = 0;
            }
        $temp_2 = -1; $temp_1 = $allCandidates[0]->id_candidates + 1;
        $result['technologies'] = $technologiesBase;
        for ($i = 0; $i < count($allCandidates); $i++) {
            if ($temp_1 != $allCandidates[$i] ->id_candidates) {
                $temp_2++;
                $cand[$temp_2]['id'] = $allCandidates[$i] -> id_candidates;
                $cand[$temp_2]['name'] = $allCandidates[$i] -> full_name;
                $cand[$temp_2]['date'] = $allCandidates[$i] -> date_of_birth;
                $cand[$temp_2]['description'] = $allCandidates[$i] -> description;
                $cand[$temp_2]['technology'] = $technologies;
                $temp_1 = $allCandidates[$i] ->id_candidates;
            }
            $cand[$temp_2]['technology'][$allCandidates[$i] ->technology] = $allCandidates[$i] ->skill;

        }
        $result['maxPage'] = ++$temp_2;
        $result['candidate'] = $cand;
        return $result;
    }

}

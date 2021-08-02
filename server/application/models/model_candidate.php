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
        $sql = "SELECT id, technology FROM `technologies`";
        $query = $this->connect->prepare($sql);
        $query ->execute();
        $mas = $query -> fetchAll(PDO::FETCH_NAMED);
        $result = Array();
            foreach ($mas as $value)
            {
                $result[$value['id']] = $value['technology'];
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

        $sql = 'SELECT id_candidates, full_name, date_of_birth, description, id_technologies, technology, skill  FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id '
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
        $technologies = []; $j = 0;
        if (isset($technologiesBase))
            foreach($technologiesBase as $key => $value) {
                $technologies[$key] = ['name' => $value, 'value' => 0];
                $result['technologies'][$j] =  $value;
                $j++;
            }
        $j = -1; $temp_1 = $allCandidates[0]->id_candidates + 1;
        for ($i = 0; $i < count($allCandidates); $i++) {
            if ($temp_1 != $allCandidates[$i] ->id_candidates) {
                $j++;
                $cand[$j]['number'] = $j+1;
                $cand[$j]['id'] = $allCandidates[$i] -> id_candidates;
                $cand[$j]['name'] = $allCandidates[$i] -> full_name;
                $cand[$j]['date'] = $allCandidates[$i] -> date_of_birth;
                $cand[$j]['description'] = $allCandidates[$i] -> description;
                $cand[$j]['technologies'] = $technologies;
                $temp_1 = $allCandidates[$i] ->id_candidates;
            }
            $cand[$j]['technologies'][$allCandidates[$i] ->id_technologies]['value'] = $allCandidates[$i] ->skill;
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

    function UpdateCandidate($id, $name, $date, $description, $technologies) {
        $sql = 'UPDATE connect INNER JOIN candidates ON id_candidates = candidates.id  SET candidates.full_name = ? , candidates.date_of_birth = ? , candidates.description = ? ,  connect.skill = CASE';
        $params = [0 => $name, 1 => $date, 2 => $description]; $i = 3;
        foreach($technologies as $key => $value) {
            $sql .= ' WHEN id_technologies = ? THEN ? ';
            $params[$i] = $key;
            $i++;
            $params[$i] = $value;
            $i++;
        }
        $params[$i] = $id;
        $sql .= " ELSE connect.skill END WHERE candidates.id = ? ";
        $query = $this->connect->prepare($sql);
        return $query ->execute($params);

    }

    function UpdateCandidateAddTechnologies($id, $technologies) {
        //$sql = 'INSERT INTO connect '
    }


    function checkSelector($selector, $number_page, $max_page)
    {
        if ((bool)$selector) {
            ($selector)? $selector = ++$number_page : $selector = --$number_page;
        }
        if (preg_match("/\d+/",$selector)) {
            ($selector > $max_page) ? $selector = $max_page : 0 ;
            ($selector < 1) ? $selector = 1 : 0 ;
            return (int)$selector;
        }
        return $number_page;
    }
}


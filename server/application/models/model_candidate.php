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

        $sql = 'SELECT id_candidates, full_name, date_of_birth, description, c.id , id_technologies, technology, skill  FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id '
            .'WHERE (full_name LIKE ? ) AND (date_of_birth >= ?) AND (date_of_birth <= ?)';

        $params = [0 => "%$name%", 1 => $dateStart, 2 => $dateEnd];

        if ($technologiesCheck != []) {
            $sql .=" AND (technology = ? AND skill > 0 )";
            $params[3] = $technologiesCheck[0];
            for($i = 1; $i < count($technologiesCheck); $i++ ) {
                $sql .=" OR (technology = ? AND skill > 0 )";
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
                $technologies[$key] = ['name' => $value, 'value' => 0, 'id_connect' => null];
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
            $cand[$j]['technologies'][$allCandidates[$i] ->id_technologies]['id_connect'] = $allCandidates[$i] ->id;
        }
        $j = 0; $i = ($page-1) * $candidates_one_page; //$candidates_one_page = $candidates_one_page + $i;
        while (($j < $candidates_one_page) && ($cand[$i] != null)) {
            $result['candidate'][$j] = $cand[$i];
            $i++; $j++;
        }
        $result['maxPage'] = ceil(count($cand)/$candidates_one_page);
        ($result['maxPage'] == 0) ? $result['maxPage'] = 1 : 0;
        //$result['candidate'] = $cand;
        return $result;
    }

//    function getAllCandidates($limit, $name="", $dateStart = "0001-01-01", $dateEnd = "9999-11-20", $technologies = [],$page=1) {
//
//        $sql = ' SELECT id_candidates, full_name, date_of_birth, description FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id  WHERE (full_name LIKE ? ) AND (date_of_birth >= ? ) AND (date_of_birth <= ? ) ';
//        $params = [0 => "%$name%", 1 =>$dateStart, 2 => $dateEnd]; $i = 3;
//        foreach($technologies as $technology) {
//            $sql .= ' AND ( technology = ? )';
//            $params[$i] = $technology;
//            $i++;
//        }
//        $page--;
//        $sql .= ' GROUP BY can.id ORDER BY can.id ASC';// LIMIT '.($page*$limit).' , '.($page*$limit+$limit).' ';
//        //$sql = "SELECT id_candidates, full_name, date_of_birth, description FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id  WHERE (full_name LIKE '%%' ) AND (date_of_birth >= '0001-01-01' ) AND (date_of_birth <= '9999-12-31' ) GROUP BY can.id ORDER BY can.id ASC LIMIT 0 , 2";
//        $query = $this->connect->prepare($sql);
//        $query ->execute($params);
//        return $query -> fetchAll(PDO::FETCH_CLASS); //PDO::FETCH_CLASS
//    }
//
//    function getAllSkill($candidate) {
//        $sql = 'SELECT `connect`.id, id_candidates, id_technologies, technology, skill FROM `connect` INNER JOIN candidates ON id_candidates = candidates.id INNER JOIN technologies ON id_technologies = technologies.id WHERE ';
//        if ($candidate != null) {
//            $sql .="(id_candidates = ? )";
//            $params[0] = $candidate[0]->id_candidates;
//            for($i = 1; $i < count($candidate); $i++ ) {
//                $sql .=" OR (id_candidates = ? )";
//                $params[$i] = $candidate[$i]->id_candidates;
//            }
//        }
//        $sql .= " ORDER BY id_candidates";
//        $query = $this->connect->prepare($sql);
//        $query ->execute($params);
//        return $query -> fetchAll(PDO::FETCH_CLASS);
//    }
//
//    function sortCandidates($technologiesBase, $candidates, $skills, $page=1) {
//        $technology = []; $i= 0;
//        foreach ($technologiesBase as $key => $value) {
//            $technology[$key]['name'] = $value;
//            $technology[$key]['value'] = 0;
//            $technology[$key]['id_connect'] = 0;
//            $candidatesData['technologies'][$i] = $value;
//            $i++;
//        }
//        $i = 0; $j = 0;
//        foreach( $candidates as $value) {
//            $candidatesData['candidates'][$i]['number'] = $page +$i;
//            $candidatesData['candidates'][$i]['name'] = $value->full_name;
//            $candidatesData['candidates'][$i]['date'] = $value->date_of_birth;
//            $candidatesData['candidates'][$i]['description'] = $value->description;
//            $candidatesData['candidates'][$i]['id'] = $value->id_candidates;
//            $candidatesData['candidates'][$i]['technologies'] = $technology;
//            while ($candidatesData['candidates'][$i]['id'] == $skills[$j]->id_candidates) {
//                $candidatesData['candidates'][$i]['technologies'][$skills[$j]->id_technologies]['value'] = $skills[$j]->skill;
//                $candidatesData['candidates'][$i]['technologies'][$skills[$j]->id_technologies]['id_connect'] = $skills[$j]->id;
//                $j++;
//            }
//            $i++;
//        }
//
//        return $candidatesData;
//    }

    function UpdateCandidate($id, $name, $date, $description, $technologies) {
        $key = 0;
        $sql = 'UPDATE candidates SET full_name = ? , date_of_birth = ? , description = ?  WHERE id = ? ';
        $params = [0 => $name, 1 => $date, 2 => $description, 3 => $id];
        $query = $this->connect->prepare($sql);
        ($query ->execute($params)) ? 0 : ++$key;
        $sql = 'REPLACE INTO connect VALUES ';
        $params = []; $i = 0;
        foreach($technologies as $key => $value) {
            $params[$i] = $value['id_connect'];
            $params[++$i] = $id;
            $params[++$i] = $key;
            $params[++$i] = $value['skill'];
            $i++; $sql .= '( ? , ? , ? , ? ), ';
        }
        $sql = substr_replace($sql,';',-2);
        $query = $this->connect->prepare($sql);
        ($query ->execute($params)) ? 0 : ++$key;
//        foreach($technologies as $key => $value) {
//            $sql .= ' WHEN id_technologies = ? THEN ? ';
//            $params[$i] = $key;
//            $i++;
//            $params[$i] = $value;
//            $i++;
//        }
//        $params[$i] = $id;
        ($key == 0) ? $key = true : $key = false;
        return $key;
    }

    function UpdateCandidateAddTechnologies($id, $technologies) {
        //$sql = 'INSERT INTO connect '
    }


    function checkSelector($selector, $number_page, $max_page)
    {
        if (is_bool($selector)) {
            ($selector)? $selector = ++$number_page : $selector = --$number_page;
        }
        if (preg_match("/\d+/",$selector)) {
            ($selector >= $max_page) ? $selector = $max_page : 0 ;
            ($selector <= 1) ? $selector = 1 : 0 ;
            return (int)$selector;
        }
        return $number_page;
    }
}


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
     * Функция возвращает кандидатов,
     * которые отсортированы в зависимости от страницы
     * и введенных данных
     * @param $limit
     * @param string $name
     * @param string $dateStart
     * @param string $dateEnd
     * @param array $technologies
     * @param int $page
     * @return array
     */
    function getAllCandidates($limit, $name="", $dateStart = "0001-01-01", $dateEnd = "9999-11-20", $technologies = [],$page=1) {

        $sql = ' SELECT id_candidates, count(id_candidates) as CU, full_name, date_of_birth, description FROM `candidates` can JOIN `connect` c ON can.id = c.id_candidates JOIN `technologies` t ON c.id_technologies = t.id  WHERE (full_name LIKE ? ) AND (date_of_birth >= ? ) AND (date_of_birth <= ? ) ';
        $params = [0 => "%$name%", 1 =>$dateStart, 2 => $dateEnd]; $i = 3;
        if ($technologies != []) {
            $j = 0;
            $sql .= ' AND ( technology = ? AND skill > 0 )';
            $params[$i] = $technologies[$j]; $j++;
            for ($i = 4; $i < count($technologies)+3; $i++) {
                $sql .= ' OR ( technology = ? AND skill > 0 )';
                $params[$i] = $technologies[$j]; $j++;
            }
        }
        $sql .= ' GROUP BY can.id ';
        if ($technologies != []) {
            $sql .= ' HAVING CU = '.count($technologies);
        }
        $sql .= ' ORDER BY can.id ASC';
        $query = $this->connect->prepare($sql);
        $query ->execute($params);
        $mas =  $query -> fetchAll(PDO::FETCH_CLASS); //PDO::FETCH_CLASS
        $j = 0; $i = ($page-1)*$limit; $result['candidates'] = [];
        while (($i < $page*$limit) && ($mas[$i] != []))
        {
            $result['candidates'][$j] = $mas[$i];
            $i++; $j++;
        }
        $result['maxPage'] = ceil(count($mas)/$limit);
        if ($result['maxPage'] == 0) $result['maxPage'] = 1;
        return $result;
    }

    /**
     * Функция возвращает навыки выбранных
     * кандидатов
     * @param $candidate
     * @return array
     */
    function getAllSkill($candidate) {
        $sql = 'SELECT `connect`.id, id_candidates, id_technologies, technology, skill FROM `connect` INNER JOIN candidates ON id_candidates = candidates.id INNER JOIN technologies ON id_technologies = technologies.id WHERE ';
        if ($candidate != null) {
            $sql .="(id_candidates = ? )";
            $params[0] = $candidate[0]->id_candidates;
            for($i = 1; $i < count($candidate); $i++ ) {
                $sql .=" OR (id_candidates = ? )";
                $params[$i] = $candidate[$i]->id_candidates;
            }
        }
        $sql .= " ORDER BY id_candidates";
        $query = $this->connect->prepare($sql);
        $query ->execute($params);
        return $query -> fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Функция формирует массив
     * на фронтенд
     * @param $technologiesBase
     * @param $candidates
     * @param $skills
     * @param int $page
     * @return array
     */
    function sortCandidates($technologiesBase, $candidates, $skills, $page=1) {
        $technology = []; $i= 0;
        foreach ($technologiesBase as $key => $value) {
            $technology[$key]['name'] = $value;
            $technology[$key]['value'] = 0;
            $technology[$key]['id_connect'] = 0;
            $candidatesData['technologies'][$i] = $value;
            $i++;
        }
        $i = 0; $j = 0;
        foreach( $candidates as $value) {
            $candidatesData['candidates'][$i]['number'] = $page+$i;
            $candidatesData['candidates'][$i]['name'] = $value->full_name;
            $candidatesData['candidates'][$i]['date'] = $value->date_of_birth;
            $candidatesData['candidates'][$i]['description'] = $value->description;
            $candidatesData['candidates'][$i]['id'] = $value->id_candidates;
            $candidatesData['candidates'][$i]['technologies'] = $technology;
            while ($candidatesData['candidates'][$i]['id'] == $skills[$j]->id_candidates) {
                $candidatesData['candidates'][$i]['technologies'][$skills[$j]->id_technologies]['value'] = $skills[$j]->skill;
                $candidatesData['candidates'][$i]['technologies'][$skills[$j]->id_technologies]['id_connect'] = $skills[$j]->id;
                $j++;
            }
            $i++;
        }

        return $candidatesData;
    }

    /**
     * Функия обновляет данные
     * о кандидате
     * @param $id
     * @param $name
     * @param $date
     * @param $description
     * @param $technologies
     * @return bool
     */
    function UpdateCandidate($id, $name, $date, $description, $technologies) {
        $key_security = 0;
        $sql = 'UPDATE candidates SET full_name = ? , date_of_birth = ? , description = ?  WHERE id = ? ';
        $params = [0 => $name, 1 => $date, 2 => $description, 3 => $id];
        $query = $this->connect->prepare($sql);
        ($query ->execute($params)) ? 0 : ++$key_security;
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
        ($query ->execute($params)) ? 0 : ++$key_security;
        ($key_security== 0) ? $key_security = true : $key_security = false;
        return $key_security;
    }

    /**
     * Функция проверяет пагинацию
     * @param $selector
     * @param $number_page
     * @param $max_page
     * @return int|mixed
     */
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


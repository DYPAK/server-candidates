<?php
session_start();
class Model_AddCandidate extends Model
{
    /**
     * Add new candidate in base
     * in table candidate and table connect
     * @param $name
     * @param $date
     * @param $description
     * @param $technologies
     * @return bool
     */
    function AddCandidate($name, $date, $description, $technologies) {
        $key_security = 0;
        $sql = "INSERT INTO `candidates` (`id`, `full_name`, `description`, `date_of_birth`) VALUES (NULL, :name , :description, :date );";
        $query = $this->connect->prepare($sql);
        $params = ['name' => $name, 'description' => $description, 'date' => $date];
        $key = $query ->execute($params);
        (!$key) ? ++$key_security : 0;
        $id = $this->connect->lastInsertId();
        $sql = "INSERT INTO `connect` (`id`, `id_candidates`, `id_technologies`, `skill`) VALUES ";
        $i = 0; $params = [];
        foreach ($technologies as $key => $value) {
            $sql .= " (NULL, ? , ? , ? ),";
            $params[$i] = $id; $i++; $params[$i] = $key; $i++; $params[$i] = $value; $i++;
        }
        $sql = substr_replace($sql,';',-1);
        $query = $this->connect->prepare($sql);
        $key = $query ->execute($params);
        (!$key) ? ++$key_security : 0;
        ($key_security == 0) ? $key = true : $key = false;
        return $key;
    }

    /** Функция пвозвращает из бд
     * все технологии
     * @return array
     */
    function getAllTechnologies() {
        $sql = "SELECT id, technology FROM `technologies`";
        $query = $this->connect->prepare($sql);
        $query ->execute();
        $mas = $query -> fetchAll(PDO::FETCH_NAMED);
        $result = Array();
        foreach ($mas as $value)
        {
            $result[$value['id']]['name'] = $value['technology'];
            $result[$value['id']]['value'] = 0;
        }
        return $result;
    }
}
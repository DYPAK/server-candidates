<?php
session_start();
class Model_Technology extends Model
{
    /**
     * Функция выдает из бд
     * массив технологий и их id
     * @return array
     */
    function getAllTechnologies()
    {
        $sql = "SELECT id, technology FROM `technologies` ";
        $query = $this->connect->prepare($sql);
        $query ->execute();
        $mas = $query -> fetchAll(PDO::FETCH_NAMED);
        $result = Array();
        foreach ($mas as $value)
        {
            $result[$value['id']]['name'] = $value['technology'];
        }
        return $result;
    }

    /**
     * Функция обновляет технологию
     * @param $id (int)
     * @param $name (string)
     * @return bool
     */
    function updateTechnology($id,$name) {
        $sql = "UPDATE `technologies` SET `technology` = :name WHERE `technologies`.`id` = :id";
        $params = ['name' => $name, 'id' => $id];
        $query = $this->connect->prepare($sql);
        return  $query->execute($params);
    }
}
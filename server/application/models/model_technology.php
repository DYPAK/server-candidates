<?php
session_start();
class Model_Technology extends Model
{
    /**
     * function take from base
     * all technology and return
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
     * function update technology
     * @param $id (int)
     * @param $name (string)
     * @return bool
     */
    function updateTechnology($id,$name) {
        $sql = "SELECT * FROM `technologies` WHERE `technology` != :name";
        $query = $this->connect->prepare($sql);
        $param = ['name'=>$name];
        $query -> execute($param);
        $key = $query -> fetch(PDO::FETCH_NUM);
        if($key != NULL) {
            $sql = "UPDATE `technologies` SET `technology` = :name WHERE `technologies`.`id` = :id";
            $params = ['name' => $name, 'id' => $id];
            $query = $this->connect->prepare($sql);
            $key = $query->execute($params);
        }
        else{
            $key = false;
        }
        return $key;
    }
}
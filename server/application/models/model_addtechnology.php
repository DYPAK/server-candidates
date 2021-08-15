<?php
session_start();
class Model_AddTechnology extends Model
{
    /**
     * Функция добавляет технологию
     * в таблицу
     * @param $name
     * @return bool
     */
    function addTechnology($name)
    {
        $sql = 'INSERT INTO `technologies` (`id`, `technology`) VALUES (NULL, :technology)';
        $query = $this->connect->prepare($sql);
        $params = ['technology' => $name];
        return $query ->execute($params);;
    }

}

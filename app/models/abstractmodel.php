<?php

namespace PHPMVC\Models;


use PHPMVC\lib\Database\DatabaseHandler;

class AbstractModel
{
    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
    const DATA_TYPE_STR = \PDO::PARAM_STR;
    const DATA_TYPE_INT = \PDO::PARAM_INT;
    const DATA_TYPE_DECIMAL = 4;
    const DATA_TYPE_DATE = 5;

    private static $db;

    private function prepareValues(\PDOStatement &$stmt)
    {
        foreach (static::$tableSchema as $columnName => $type) {
            if ($type == 4) {
                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $sanitizedValue);
            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);
            }
        }
    }

    private function buildNameParametersSQL()
    {
        $namedParams = '';
        foreach (static::$tableSchema as $columnName => $type) {
            $namedParams .= $columnName . ' = :' . $columnName . ', ';
        }
        return trim($namedParams, ', ');
    }

    public function create()
    {
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL();
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        if ($stmt->execute()) {
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }

    public function update()
    {
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    public function save($primaryKeyCheck = true)
    {
        if (false === $primaryKeyCheck) {
            return $this->create();
        }
        return $this->{static::$primaryKey} === null ? $this->create() : $this->update();
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$tableName . '  WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        return $stmt->execute();
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        if (method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        };
        return false;
    }

    public static function getByPK($pk)
    {
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . static::$primaryKey . ' = "' . $pk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if ($stmt->execute() === true) {
            if (method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return !empty($obj) ? array_shift($obj) : false;
        }
        return false;
    }

    public static function getBy($columns, $options = array())
    {
        $whereClauseColumns = array_keys($columns);
        $whereClauseValues = array_values($columns);
        $whereClause = [];
        for ($i = 0, $ii = count($whereClauseColumns); $i < $ii; $i++) {
            $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
        }
        $whereClause = implode(' AND ', $whereClause);
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;
        return static::get($sql, $options);
    }

    public static function get($sql, $options = array())
    {
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if (!empty($options)) {
            foreach ($options as $columnName => $type) {
                if ($type[0] == 4) {
                    $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}", $sanitizedValue);
                } elseif ($type[0] == 5) {
                    if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                        $stmt->bindValue(":{$columnName}", self::DEFAULT_MYSQL_DATE);
                        continue;
                    }
                    $stmt->bindValue(":{$columnName}", $type[1]);
                } else {
                    $stmt->bindValue(":{$columnName}", $type[1], $type[0]);
                }
            }
        }
        $stmt->execute();
        if (method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        };
        return false;
    }

    public static function getOne($sql, $options = array())
    {
        $result = static::get($sql, $options);
        return $result === false ? false : $result->current();
    }

    public static function checkAuth($user, $pass)
    {
        $sql = "SELECT * FROM " . static::$tableName . " WHERE user_name = :user and user_pass = :password";
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->bindParam('user', $user, \PDO::PARAM_STR);
        $stmt->bindParam('password', $pass, \PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($count == 1 && !empty($row)) {
            $_SESSION['session_id'] = $row['user_id'];
            $_SESSION['session_first_name'] = $row['user_first_name'];
            $_SESSION['session_user_name'] = $row['user_last_name'];
            $_SESSION['session_user_role'] = $row['role'];

            return true;

        } else {
            return false;
        }
    }

    // return number of row for statistic
    public static function count()
    {
        $sql = "SELECT COUNT(*) FROM " . static::$tableName;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_COLUMN);
//        while ($result){
//            extract($result);
//        }
        return $result;
    }

//    function that's return product information and user information
    public static function affichereserve($user_id)
    {
        $sql = "SELECT R.reservation_id, R.duration, U.user_name, U.user_email, P.product_name,
       P.product_price FROM `reservation` as R inner JOIN products as P ON
           R.product_id = P.product_id INNER JOIN users as U ON R.user_id = U.user_id WHERE R.user_id =". $user_id;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;

    }

    public static function getModelTableName()
    {
        return static::$tableName;
    }
}

//class AbstractModel
//{
//    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
//    const DATA_TYPE_STR = \PDO::PARAM_STR;
//    const DATA_TYPE_INT = \PDO::PARAM_INT;
//    const DATA_TYPE_DECIMAL = 4;
//
//    protected function prepareValues(\PDOStatement &$stmt)
//    {
//        foreach (static::$table_shema as $column_name => $type) {
//            if ($type == 4) {
//                $sanitize_value = filter_var($this->$column_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
//                $stmt->bindValue(":{$column_name}", $sanitize_value);
//            } else {
//                $stmt->bindValue(":{$column_name}", $this->$column_name, $type);
//            }
//        }
//    }
//
//    private static function buildNameParametersSql()
//    {
//
//        $namedParams = '';
//        foreach (static::$table_shema as $column_name => $type) {
//            $namedParams .= $column_name . ' = :' . $column_name . ', ';
//        }
//        return trim($namedParams, ', ');
//
//    }
//
//    public function create()
//    {
//
//        $sql = 'INSERT INTO ' . static::$table_name . ' SET ' . self::buildNameParametersSql();
//        $stmt = DatabaseHandler::factory()->prepare($sql);
////        echo $sql;
////        var_dump(self::buildNameParametersSql());
//
//
//        $this->prepareValues($stmt);
//        if ($stmt->execute()){
//            $this->{static::$primary_key} = DatabaseHandler::factory()->lastInserId();
//            var_dump($stmt->execute());
//            return true;
//        }
//        return false;
//
//    }
//
//    private function update()
//    {
//
//        $sql = 'UPDATE ' . static::$table_name . ' SET ' . self::buildNameParametersSql() . ' WHERE '. static::$primary_key .' =  '.$this->{static::$primary_key};
//        $stmt = DatabaseHandler::factory()->prepare($sql);
//
//        $this->prepareValues($stmt);
//
//        return $stmt->execute();
//
//    }
//
//    public function save($primaryKeyCheck = true){
//        if(false === $primaryKeyCheck) {
//            return $this->create();
//        }
//        return $this->{static::$primary_key} === null ? $this->create() : $this->update();
////        return $this->{static::$primary_key} === null ? $this->create() : $this->update();
//    }
//    public function delete(){
//
//        $sql = 'DELETE FROM ' . static::$table_name . ' WHERE '. static::$primary_key .' =  '.$this->{static::$primary_key};
//        $stmt = DatabaseHandler::factory()->prepare($sql);
//
//        return $stmt->execute();
//    }
//
//    public static function getAll(){
//
//        $sql = 'SELECT * FROM ' . static::$table_name;
////        var_dump(static::$table_name);
//        $stmt =DatabaseHandler::factory()->prepare($sql);
//        $stmt->execute();
//        if (method_exists(get_called_class(), '__construct')) {
//            $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_shema));
//        } else {
//            $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
//        }
//        if ((is_array($result) && !empty($result))) {
//            return new \ArrayIterator($result);
//        }
//
//        return false;
//    }
//
//    public static function getByPk($pk){
//
//        $sql = 'SELECT * FROM '. static::$table_name. ' WHERE '. static::$primary_key .' =  '. $pk;
//        $stmt =DatabaseHandler::factory()->prepare($sql);
//        if ($stmt->execute() === true)
//        {
//            $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_shema));
//            return array_shift($obj);
//        }
//        return false;
//    }
//
//    public static function get ($sql, $options = array()){
//
//        $stmt = DatabaseHandler::factory()->prepare($sql);
//        if (!empty($options)){
//            foreach ($options as $column_name => $type) {
//                if ($type[0] == 4) {
//                    $sanitize_value = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
//                    $stmt->bindValue(":{$column_name}", $sanitize_value);
//                } else {
//                    $stmt->bindValue(":{$column_name}", $type[1], $type[0]);
//                }
//            }
//        }
//        $stmt->execute();
//        $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_shema));
//        return  (is_array($result) && !empty($result)) ? $result  : false;
//
//    }
//
//    public static function getModelTableName()
//    {
//        return static::$table_name;
//    }
//
//}
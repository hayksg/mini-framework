<?php

namespace Application\Components;

abstract class BaseModel 
{
    private static $table;
    private $data = [];
    
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    
    // Without __get method did not work (\PDO::FETCH_CLASS, $className)
    public function __get($name)
    {
        return $this->data[$name];
    }
    
    private static function getPrimaryKeyName()
    {
        $sql = "SHOW KEYS FROM " . static::$table . " WHERE Key_name = 'PRIMARY'";
        $db = DB::getConnection();
        $result = $db->query($sql);
        $row = $result->fetch();
        if ($row) {
            return $row['Column_name'];
        }
    }
    
    public static function getAll($order = false)
    {
        $className = get_called_class();
        $primaryKeyName = self::getPrimaryKeyName();
        
        DB::setClassName($className);
        
        $sql  = "SELECT * FROM ";
        $sql .= static::$table;
        if (! $order) {
            $sql .= " ORDER BY " . $primaryKeyName;
            $sql .= " DESC";
        }
        
        $result = DB::query($sql);
        
        return $result ?: false;
    }
    
    public static function getById($id)
    {       
        $className = get_called_class();
        $primaryKeyName = self::getPrimaryKeyName();

        DB::setClassName($className);

        $sql  = "SELECT * FROM ";
        $sql .=  static::$table;
        $sql .= " WHERE ";
        $sql .= $primaryKeyName . ' = :' . $primaryKeyName;
        
        $result = DB::query($sql, [$primaryKeyName => $id]);
        return $result[0] ?: false;
    }
    
    private function add()
    {
        $className = get_called_class();
        DB::setClassName($className);
        
        $db = DB::getConnection();
        
        $params = [];
        foreach ($this->data as $key => $value) {
            $params[':' . $key] = $value;
        }

        $sql  = "INSERT INTO ";
        $sql .= static::$table;
        $sql .= "(" . implode(', ', array_keys($this->data)) . ")";
        $sql .= " VALUES ";
        $sql .= "(" . implode(', ', array_keys($params)) . ")";
        
        return DB::persist($sql, $params);
    }
    
    private function update()
    {
        $primaryKeyName = self::getPrimaryKeyName();

        $params = [];
        $newData = [];

        foreach ($this->data as $key => $value) {
            if ($key == $primaryKeyName) {
                $params[':' . $key] = $value;
            }

            $params[':' . $key] = $value;
            $newData[] = $key . ' = :' . $key;
        }

        $sql  = "UPDATE ";
        $sql .= static::$table;
        $sql .= " SET ";
        $sql .= implode(', ', $newData);
        $sql .= " WHERE ";
        $sql .= $primaryKeyName . ' = :' . $primaryKeyName;

        return DB::persist($sql, $params);
    }
    
    public function save()
    {
        if (isset($this->data['id'])) {
            return $this->update();
        } else {
            return $this->add();
        }
    }
    
    public static function delete($id)
    {
        $primaryKeyName = self::getPrimaryKeyName();

        $sql  = "DELETE FROM ";
        $sql .= static::$table;
        $sql .= " WHERE ";
        $sql .= $primaryKeyName . ' = :' . $primaryKeyName;

        return DB::persist($sql, [$primaryKeyName => $id]);
    }
}

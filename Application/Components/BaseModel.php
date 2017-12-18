<?php

namespace Application\Components;

abstract class BaseModel 
{
    private static $table;
    
    public static function getAll()
    {
        $db = DB::getConnection();
        
        $sql = "SELECT * FROM " . static::$table;
        $result = $db->query($sql);
        $result->execute();
        
        $articles = $result->fetchAll(\PDO::FETCH_OBJ);
        
        return $articles ?: false;
    }
    
    public static function getById($id)
    {
        $db = DB::getConnection();
        
        $sql  = "SELECT * FROM ";
        $sql .= static::$table;
        $sql .= " WHERE id = :id ";
        $sql .= "LIMIT 1";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        
        $article = $stmt->fetch(\PDO::FETCH_OBJ);
        
        return $article ?: false;
    }
}

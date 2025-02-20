<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Store{
    
   
    private $table="store";
    private $db;
    
    public function __construct() {
        $this->db = Db::getInstance();
    }
    public function insertIntoTableStore($cod,$name,$tlf) {
        
        $sql = "INSERT INTO ".$this->table. "(cod, name, tlf) VALUES" .
                            "($cod, '$name', '$tlf')";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute();
    }
    
    public function updateTableStore($cod, $name, $tlf){
        
        $sql ="UPDATE ".$this->table. "SET name='$name', tlf='$tlf' WHERE cod='$cod'";
         $stmt = $this->db->prepare($sql);
        
        return $stmt->execute();
    }
    
    public function deleteFromTableStorebyCode($cod){
        
        $sql ="DELETE from ".$this->table." WHERE cod='$cod'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$cod]);
    }
 
     public function getStores() {
        $sql = "SELECT cod, name, tlf FROM ".$this->table;
        $stmt = $this->db->prepare($sql);
        return $stmt->fetchAll($this->db::FETCH_ASSOC);
    }
}

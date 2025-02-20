<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Store{
    private $table="store";
    private $conection;
    
    public function __construct() {
        
    }
    public function insertIntoTableStore($cod,$name,$tlf) {
        
        $sql = "INSERT INTO ".$this->table. "(cod, name, tlf) VALUES" .
                            "($cod, '$name', '$tlf')";
        
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function updateTableStore($cod, $name, $tlf){
        
        $sql ="UPDATE ".$this->table. "SET name='$name', tlf='$tlf' WHERE cod='$cod'";
         $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function deleteFromTableStorebyCode($cod){
        
        $sql ="DELETE from ".$this->table." WHERE cod='$cod'";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$cod]);
    }
 
     public function getStores() {
        $sql = "SELECT cod, name, tlf FROM store";
        $stmt = $this->conection->prepare($sql);
        return $stmt->fetchAll();
    }
}

<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Store{
    private $table;
    private $conection;
    
    public function __construct() {
        
    }
    public function insertIntoTable() {
        $cod;
        $name;
        $tlf;
        $sql = "INSERT INTO store (cod, name, tlf) VALUES" .
                            "($cod, '$name', '$tlf')";
        
        return $sql;
    }
    
    public function updateTable(){
         $cod;
        $name;
        $tlf;
        $sql ="UPDATE store SET name='$name', tlf='$tlf' WHERE cod='$cod'";
        
        return $sql;
    }
    
    public function deleteFromTable(){
        
    }
}

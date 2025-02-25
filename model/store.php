<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'db.php';
class Store{
    
   
    private $table="store";
    private $db;
    private $cod;
    private $name;
    private $tlf;
    
    public function __construct() {
        $this->db = Db::getInstance();
    }
    public function insertIntoTableStore($cod,$name,$tlf) {
        
        $sql = "INSERT INTO ".$this->table. "(cod, name, tlf) VALUES" .
                            "(:cod, :name, :tlf)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(['cod'=>$cod,'name'=>$name,'tlf'=>$tlf]);
    }
    
    public function updateTableStore($cod, $name, $tlf){
        
        $sql ="UPDATE ".$this->table. "SET name=:name, tlf=:tlf WHERE cod=:cod";
         $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(['cod'=>$cod,'name'=>$name,'tlf'=>$tlf]);
    }
    
    public function deleteFromTableStorebyCode($cod){
        
        $sql ="DELETE from ".$this->table." WHERE cod=:cod";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['cod'=>$cod]);
    }
 
     public function getStores() {
        $sql = "SELECT cod, name, tlf FROM ".$this->table;
        $stmt = $this->db->prepare($sql);
        return $stmt->fetchAll($this->db::FETCH_ASSOC);
    }
     public function displayStoreTable() {
        $stock = $this->getStores();
        echo "<table border='1'>";
        echo "<tr><th>Product</th><th>Store</th><th>Units</th></tr>";
        foreach ($stock as $row) {
            echo "<tr>";
            echo "<td>{$row['cod']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['tlf']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
$stock = new Store();
$stock->displayStoreTable();

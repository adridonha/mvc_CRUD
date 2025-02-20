<?php
require_once 'db.php';

class Family {
    private $pdo;
    private $cod;
    private $name;

    public function __construct() {
        $db = new Db();
        $this->pdo = $db->conection;
    }

    public function getCod() {
        return $this->cod;
    }

    public function setCod($cod) {
        $this->cod = $cod;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAllFamilies() {
        $sql = "SELECT cod, name FROM family";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertFamily($cod, $name) {
        $this->setCod($cod);
        $this->setName($name);
        
        $sql = "INSERT INTO family (cod, name) VALUES (:cod, :name)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['cod' => $this->cod, 'name' => $this->name]);
    }

    public function updateFamily($cod, $name) {
        $this->setCod($cod);
        $this->setName($name);
        
        $sql = "UPDATE family SET name = :name WHERE cod = :cod";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['cod' => $this->cod, 'name' => $this->name]);
    }

    public function deleteFamily($cod) {
        $this->setCod($cod);
        
        $sql = "DELETE FROM family WHERE cod = :cod";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['cod' => $this->cod]);
    }
    

    public function displayFamilyTable() {
        $families = $this->getAllFamilies();
    
        echo "<table border='1'>";
        echo "<tr><th>Cod</th><th>Name</th></tr>";
    
        foreach ($families as $family) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($family['cod']) . "</td>";
            echo "<td>" . htmlspecialchars($family['name']) . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
    }
    
}


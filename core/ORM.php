<?php
namespace app\core;

use app\config\Database;
use PDO;

class ORM {
    protected $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function update($id, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        $sql = "UPDATE {$this->table} SET $fields WHERE id = :id";
        $data['id'] = $id;
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function get($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function where(string $column, string $value) {
        $sql = "SELECT * FROM {$this->table} WHERE $column = :value";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['value' => $value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $conn = Database::connect();
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // One-to-One Relationship
    public function hasOne($relatedClass, $foreignKey, $localKey) {
        $relatedTable = (new $relatedClass())->table;
        $sql = "SELECT * FROM {$relatedTable} WHERE {$foreignKey} = :localKey";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['localKey' => $localKey]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // One-to-Many Relationship
    public function hasMany($relatedClass, $foreignKey, $localKey) {
        $relatedTable = (new $relatedClass())->table;
        $sql = "SELECT * FROM {$relatedTable} WHERE {$foreignKey} = :localKey";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['localKey' => $localKey]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Many-to-Many Relationship
    public function belongsToMany($relatedClass, $pivotTable, $foreignKey, $relatedKey, $localKey) {
        $relatedTable = (new $relatedClass())->table;
        $sql = "SELECT {$relatedTable}.* FROM {$relatedTable}
                JOIN {$pivotTable} ON {$pivotTable}.{$relatedKey} = {$relatedTable}.id
                WHERE {$pivotTable}.{$foreignKey} = :localKey";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['localKey' => $localKey]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
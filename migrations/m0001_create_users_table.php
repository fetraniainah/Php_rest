<?php
namespace app\migrations;

use app\config\Database;

class m0001_create_users_table {
    public function up() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn = Database::connect();
        $conn->exec($sql);
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS users";
        $conn = Database::connect();
        $conn->exec($sql);
    }
}
?>
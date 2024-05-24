<?php
namespace app\migrations;

use app\config\Database;

class m0002_create_messages_table {
    public function up() {
        $sql = "CREATE TABLE IF NOT EXISTS messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(250) NOT NULL,
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn = Database::connect();
        $conn->exec($sql);
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS messages";
        $conn = Database::connect();
        $conn->exec($sql);
    }
}
?>
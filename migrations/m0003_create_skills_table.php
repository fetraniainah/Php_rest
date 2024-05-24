<?php
namespace app\migrations;

use app\config\Database;

class m0003_create_skills_table {
    public function up() {
        $sql = "CREATE TABLE IF NOT EXISTS skills (
            id INT AUTO_INCREMENT PRIMARY KEY
            title VARCHAR(100) NOT NULL,
            link VARCHAR(255),
            details TEXT,
            image_uri VARCHAR(255)
        )";
        $conn = Database::connect();
        $conn->exec($sql);
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS skills";
        $conn = Database::connect();
        $conn->exec($sql);
    }
}
?>
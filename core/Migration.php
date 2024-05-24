<?php
namespace app\core;

use app\config\Database;
use PDO;

class Migration {
    public static function createMigrationsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn = Database::connect();
        $conn->exec($sql);
    }

    public static function getAppliedMigrations() {
        $sql = "SELECT migration FROM migrations";
        $conn = Database::connect();
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function saveMigration($migration) {
        $sql = "INSERT INTO migrations (migration) VALUES (:migration)";
        $conn = Database::connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['migration' => $migration]);
    }

    public static function migrate() {
        self::createMigrationsTable();
        $appliedMigrations = self::getAppliedMigrations();
        $files = scandir(__DIR__ . '/../migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') continue;
            require_once __DIR__ . '/../migrations/' . $migration;
            $className = 'app\\migrations\\' . pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $instance->up();
            self::saveMigration($migration);
        }
    }
}
?>
<?php

// Simple script to drop all tables for fresh migration
echo "Starting database cleanup...\n";

// Read database config from CodeIgniter
require_once __DIR__ . '/ci4/app/Config/Database.php';

$config = new \Config\Database();
$dbConfig = $config->default;

try {
    $pdo = new PDO(
        "mysql:host={$dbConfig['hostname']};dbname={$dbConfig['database']};port={$dbConfig['port']}",
        $dbConfig['username'],
        $dbConfig['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "Connected to database: {$dbConfig['database']}\n";
    
    // Get all table names
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Found " . count($tables) . " tables to drop\n";
    
    // Disable foreign key checks
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
    echo "Disabled foreign key checks\n";
    
    // Drop all tables
    foreach ($tables as $table) {
        try {
            $pdo->exec("DROP TABLE IF EXISTS `$table`");
            echo "✓ Dropped table: $table\n";
        } catch (Exception $e) {
            echo "✗ Error dropping $table: " . $e->getMessage() . "\n";
        }
    }
    
    // Re-enable foreign key checks
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    echo "Re-enabled foreign key checks\n";
    
    echo "✓ Database cleanup completed!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
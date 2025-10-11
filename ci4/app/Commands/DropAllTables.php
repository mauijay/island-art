<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class DropAllTables extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:drop-all';
    protected $description = 'Drop all tables from the database';

    public function run(array $params)
    {
        CLI::write('Starting to drop all tables...', 'yellow');

        $db = \Config\Database::connect();

        try {
            // Disable foreign key checks
            $db->query('SET FOREIGN_KEY_CHECKS = 0');
            CLI::write('Disabled foreign key checks', 'green');

            // Get all table names
            $query = $db->query("SHOW TABLES");
            $tables = [];
            foreach ($query->getResult() as $row) {
                $tables[] = array_values((array)$row)[0];
            }

            CLI::write('Found ' . count($tables) . ' tables to drop', 'cyan');

            // Drop each table
            foreach ($tables as $table) {
                try {
                    $db->query("DROP TABLE IF EXISTS `$table`");
                    CLI::write("✓ Dropped table: $table", 'green');
                } catch (\Exception $e) {
                    CLI::write("✗ Error dropping $table: " . $e->getMessage(), 'red');
                }
            }

            // Re-enable foreign key checks
            $db->query('SET FOREIGN_KEY_CHECKS = 1');
            CLI::write('Re-enabled foreign key checks', 'green');

            CLI::write('✓ All tables dropped successfully!', 'green');

        } catch (\Exception $e) {
            CLI::write('Error: ' . $e->getMessage(), 'red');
            return 1;
        }

        return 0;
    }
}
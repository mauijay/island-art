<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CollectEvents extends BaseCommand {
  protected $group = 'Events';
  protected $name = 'events:collect';
  protected $description = 'Collect art events from various Hawaiian cultural institutions';

  public function run(array $params)
  {
    CLI::write('Starting Hawaii Art Events Collection...', 'green');

    $projectRoot  = ROOTPATH;
    $pythonScript = $projectRoot . 'collect_events.py';

    // Check if Python script exists
    if (!file_exists($pythonScript)) {
      CLI::error('Python script not found: ' . $pythonScript);
      return;
    }

    // Check if Python is available
    $pythonCommand = $this->findPythonCommand();
    if (!$pythonCommand) {
      CLI::error('Python not found. Please install Python 3.6+ and ensure it\'s in your PATH.');
      return;
    }

    CLI::write('Found Python: ' . $pythonCommand, 'yellow');
    CLI::write('Running event collection script...', 'yellow');

    // Change to project root directory for proper path handling
    $originalDir = getcwd();
    chdir($projectRoot);

    // Execute Python script
    $command    = $pythonCommand . ' ' . escapeshellarg($pythonScript) . ' 2>&1';
    $output     = [];
    $returnCode = 0;

    exec($command, $output, $returnCode);

    // Return to original directory
    chdir($originalDir);

    // Display output
    if ($returnCode === 0) {
      CLI::write('Event collection completed successfully!', 'green');
      foreach ($output as $line) {
        CLI::write($line, 'white');
      }
    } else {
      CLI::error('Event collection failed with return code: ' . $returnCode);
      foreach ($output as $line) {
        CLI::error($line);
      }
    }

    // Display database stats
    $this->displayEventStats();
  }

  /**
   * Find available Python command
   */
  private function findPythonCommand(): ?string
  {
    $pythonCommands = ['python3', 'python', 'py'];

    foreach ($pythonCommands as $cmd) {
      $output     = [];
      $returnCode = 0;
      exec($cmd . ' --version 2>&1', $output, $returnCode);

      if ($returnCode === 0 && !empty($output)) {
        $version = $output[0];
        if (strpos($version, 'Python 3.') !== false) {
          return $cmd;
        }
      }
    }

    return null;
  }

  /**
   * Display current event statistics
   */
  private function displayEventStats()
  {
    try {
      $db = \Config\Database::connect();

      $totalEvents    = $db->table('events')->countAll();
      $activeEvents   = $db->table('events')
        ->where('status', 'approved')
        ->where('start_date >=', date('Y-m-d'))
        ->countAllResults();
      $featuredEvents = $db->table('events')
        ->where('is_featured', 1)
        ->where('status', 'approved')
        ->countAllResults();

      CLI::newLine();
      CLI::write('Event Statistics:', 'cyan');
      CLI::write('Total Events: ' . $totalEvents, 'white');
      CLI::write('Active Events: ' . $activeEvents, 'white');
      CLI::write('Featured Events: ' . $featuredEvents, 'white');
      CLI::newLine();

    } catch (\Exception $e) {
      CLI::error('Could not retrieve event statistics: ' . $e->getMessage());
    }
  }
}

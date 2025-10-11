<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ClearEvents extends BaseCommand {
  /**
   * The Command's Group
   *
   * @var string
   */
  protected $group = 'Events';

  /**
   * The Command's Name
   *
   * @var string
   */
  protected $name = 'events:clear';

  /**
   * The Command's Description
   *
   * @var string
   */
  protected $description = 'Clear all events from the database';

  /**
   * The Command's Usage
   *
   * @var string
   */
  protected $usage = 'events:clear';

  /**
   * The Command's Arguments
   *
   * @var array
   */
  protected $arguments = [];

  /**
   * The Command's Options
   *
   * @var array
   */
  protected $options = [];

  /**
   * Actually execute a command.
   *
   * @param array $params
   */
  public function run(array $params)
  {
    $db = \Config\Database::connect();

    CLI::write('Clearing all events from database...', 'yellow');

    $result = $db->table('events')->truncate();

    if ($result) {
      CLI::write('✅ All events cleared successfully!', 'green');
    } else {
      CLI::error('❌ Failed to clear events');
    }
  }
}

<?php
// task-cli.php
require_once 'TaskManager.php';

function printUsage()
{
    // Print usage instructions for each command and expected arguments
    echo "Usage: php task-cli.php <command> [arguments]\n";
    echo "Available commands:\n";
    echo "  add <description>        Add a new task with the given description\n";
    echo "  update <id> <description> Update the task with the given ID and description\n";
    echo "  delete <id>              Delete the task with the given ID\n";
    echo "  mark-in-progress <id>    Mark the task with the given ID as in progress\n";
    echo "  mark-done <id>           Mark the task with the given ID as done\n";
    echo "  list [status]            List all tasks, optionally filtered by status (todo, in-progress, done)\n";

}

// Instantiate the TaskManager class, assigning it to a variable (e.g., `$taskManager`)
$taskManager = new TaskManager();

if ($argc < 2) {
    // Print usage instructions and exit if no command is provided
    printUsage();
    exit;
}

// Capture the command from `$argv[1]` and create a `switch` statement to handle each supported command
$command = $argv[1];

switch ($command) {
    case 'add':
        // Check if description is provided (in `$argv[2]`), otherwise print an error and exit
        if (!isset($argv[2])) {
            echo "Error: Description is required.\n";
            printUsage();
            exit;
        }

        // Call `addTask` method on the task manager instance with the description
        $taskManager->addTask($argv[2]);
        break;

    case 'update':
        // Check if ID and new description are provided (`$argv[2]` and `$argv[3]`)
        if (!isset($argv[2]) || !isset($argv[3])) {
            echo "Error: ID and description are required.\n";
            printUsage();
            exit;
        }
        // Call `updateTask` with the given ID and new description
        $taskManager->updateTask($argv[2], $argv[3]);
        break;

    case 'delete':
        // Check if ID is provided
        if (!isset($argv[2])) {
            echo "Error: ID is required.\n";
            printUsage();
            exit;
        }

        // Call `deleteTask` with the given ID
        $taskManager->deleteTask($argv[2]);
        break;

    case 'mark-in-progress':
        // Check if ID is provided
        if (!isset($argv[2])) {
            echo "Error: ID is required.\n";
            printUsage();
            exit;
        }

        // Call `markInProgress` with the given ID
        $taskManager->markInProgress($argv[2]);
        break;

    case 'mark-done':
        // Check if ID is provided
        if (!isset($argv[2])) {
            echo "Error: ID is required.\n";
            printUsage();
            exit;
        }

        // Call `markDone` with the given ID
        $taskManager->markDone($argv[2]);
        break;

    case 'list':
        // Check if a status is optionally provided (e.g., `todo`, `in-progress`, `done`)
        $status = isset($argv[2]) ? $argv[2] : null;

        // Call `listTasks` with the status (or `null` if not provided)
        $taskManager->listTasks($status);
        break;

    default:
        // Print error message for unknown command and print usage instructions
        echo "Error: Unknown command.\n";
        printUsage();
        break;
}


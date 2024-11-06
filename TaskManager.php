<?php

class TaskManager
{
    private $filePath;

    public function __construct($filePath = 'tasks.json')
    {
        $this->filePath = $filePath;

        // Check if the JSON file exists; if not, create it with an empty JSON array
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode(array()));
        }
    }

    // Create a private method `loadTasks` to load tasks from the JSON file and return as an array
    private function loadTasks()
    {
        return json_decode(file_get_contents($this->filePath), true);
    }

    // Create a private method `saveTasks` to save an array of tasks to the JSON file in JSON format
    private function saveTasks($tasks)
    {
        file_put_contents($this->filePath, json_encode($tasks, JSON_PRETTY_PRINT));
    }

    //  Implement `addTask` to add a new task with:
    // - A unique ID
    // - A description provided as input
    // - Default status of "todo"
    // - Current timestamp for createdAt and updatedAt
    // After adding the task, save the tasks and print a success message
    public function addTask($description)
    {
        $tasks = $this->loadTasks();
        $taskId = uniqid();
        $newTask = [
            'id' => $taskId,
            'description' => $description,
            'status' => 'todo',
            'createdAt' => time(),
            'updatedAt' => time()
        ];
        $tasks[] = $newTask;
        $this->saveTasks($tasks);
        echo "Task added successfully!\n";
    }

    //  Implement `updateTask` to update a task’s description by ID.
    // - Find the task with the given ID
    // - Update its description and set updatedAt to the current timestamp
    // - If the task doesn’t exist, print an error message
    // - Save the tasks back to the JSON file
    public function updateTask($id, $description)
    {
        $tasks = $this->loadTasks();
        $taskUpdated = false;

        foreach ($tasks as $key => $task) {
            if ($task['id'] === $id) {
                $tasks[$key]['description'] = $description;
                $tasks[$key]['updatedAt'] = time();
                $taskUpdated = true;
                break;
            }
        }

        if ($taskUpdated) {
            $this->saveTasks($tasks);
            echo "Task updated successfully!\n";
        } else {
            echo "Error: Task with ID $id not found.\n";
        }
    }

    // Implement `deleteTask` to remove a task by ID
    // - Remove the task with the given ID
    // - Save the tasks back to the JSON file and print a success message
    public function deleteTask($id)
    {
        $tasks = $this->loadTasks();
        $taskDeleted = false;

        foreach ($tasks as $key => $task) {
            if ($task['id'] === $id) {
                unset($tasks[$key]);
                $taskDeleted = true;
                break;
            }
        }

        if ($taskDeleted) {
            $this->saveTasks(array_values($tasks));
            echo "Task deleted successfully!\n";
        } else {
            echo "Error: Task with ID $id not found.\n";
        }
    }

    //  Implement `markInProgress` to set the status of a task to "in-progress" by ID
    // - Use a helper method to change the status and save
    public function markInProgress($id)
    {
        $this->updateStatus($id, 'in-progress');
    }

    // Implement `markDone` to set the status of a task to "done" by ID
    // - Use a helper method to change the status and save
    public function markDone($id)
    {
        $this->updateStatus($id, 'done');
    }

    // Create a private helper method `updateStatus` to update the status of a task and set updatedAt
    // - This method will take ID and the new status as arguments
    // - If the task ID isn’t found, print an error message
    private function updateStatus($id, $status)
    {
        $tasks = $this->loadTasks();
        $taskUpdated = false;

        foreach ($tasks as $key => $task) {
            if ($task['id'] === $id) {
                $tasks[$key]['status'] = $status;
                $tasks[$key]['updatedAt'] = time();
                $taskUpdated = true;
                break;
            }
        }

        if ($taskUpdated) {
            $this->saveTasks($tasks);
        } else {
            echo "Error: Task with ID $id not found.\n";
        }
    }

    // Implement `listTasks` to display tasks, optionally filtered by status
    // - If no status is provided, display all tasks
    // - Otherwise, filter tasks by status before displaying
    // - Print each task with ID, description, status, and createdAt
    public function listTasks($status = null)
    {
        $tasks = $this->loadTasks();

        if ($status !== null) {
            $tasks = array_filter($tasks, function ($task) use ($status) {
                return $task['status'] === $status;
            });
        }

        foreach ($tasks as $task) {
            echo "ID: {$task['id']}\n";
            echo "Description: {$task['description']}\n";
            echo "Status: {$task['status']}\n";
            echo "Created At: " . date('d-m-Y H:i:s', $task['createdAt']) . "\n\n";
        }
    }
}


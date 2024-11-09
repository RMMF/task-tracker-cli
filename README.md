# Task Tracker CLI

A simple Command Line Interface (CLI) tool to track and manage tasks. This project allows you to add, update, delete, and manage tasks through the terminal. The tasks are stored in a `tasks.json` file, which is automatically created if it doesn't exist.

## Features

- **Add tasks**: Create new tasks and store them with a unique ID.
- **Update tasks**: Modify the description of existing tasks.
- **Delete tasks**: Remove tasks by ID.
- **Mark tasks** as **in-progress** or **done**.
- **List tasks**: View all tasks or filter tasks by their status (todo, in-progress, done).

## Requirements

- PHP (7.x or higher)
- Terminal or Command Line interface
- Basic understanding of PHP and command-line arguments

## Setup

### 1. Clone the repository

```bash
git clone https://github.com/rui95fer/task-tracker-cli.git
cd task-tracker-cli
```

### 2. Install Dependencies

There are no external dependencies for this project. It only requires PHP which is typically installed by default on most systems. However, make sure PHP is available by checking:

```bash
php -v
```

### 3. Start Using the CLI

The `task-cli.php` script is the main entry point for interacting with the task tracker.

## Commands and Usage

### **1. Add a Task**

To add a new task, use the `add` command. You need to provide the description of the task.

```bash
php task-cli.php add "Buy groceries"
```

This will add a task with the description "Buy groceries" to the task list and assign it a unique ID.

### **2. Update a Task**

To update an existing task's description, use the `update` command. You must provide the task's ID and the new description.

```bash
php task-cli.php update 1 "Buy groceries and cook dinner"
```

This will update the task with ID `1` to have the new description "Buy groceries and cook dinner".

### **3. Delete a Task**

To delete a task, use the `delete` command. You need to provide the ID of the task to delete.

```bash
php task-cli.php delete 1
```

This will delete the task with ID `1` from the task list.

### **4. Mark a Task as In Progress**

To mark a task as "in-progress", use the `mark-in-progress` command. Provide the task ID.

```bash
php task-cli.php mark-in-progress 1
```

This will set the status of the task with ID `1` to "in-progress".

### **5. Mark a Task as Done**

To mark a task as "done", use the `mark-done` command. Provide the task ID.

```bash
php task-cli.php mark-done 1
```

This will set the status of the task with ID `1` to "done".

### **6. List All Tasks**

To list all tasks, use the `list` command. By default, this will show all tasks regardless of their status.

```bash
php task-cli.php list
```

### **7. List Tasks by Status**

You can also filter the tasks by their status. Use the `list` command followed by the status (`todo`, `in-progress`, or `done`).

```bash
php task-cli.php list todo
php task-cli.php list in-progress
php task-cli.php list done
```

### Output

Each task will be displayed with the following details:

- Task ID
- Task Description
- Task Status
- Task Creation Timestamp

### Example Output for `list`

```bash
ID: 672bc556f0101
Description: Buy groceries
Status: todo
Created At: 06-11-2024 20:36:54

ID: 672bc562c8673
Description: Cook dinner
Status: todo
Created At: 06-11-2024 20:37:06

```

## Task File

Tasks are stored in a `tasks.json` file located in the same directory as `task-cli.php`. If the file doesn’t exist, it will be automatically created when the first task is added.

### Example of `tasks.json`

```json
[
  {
    "id": "672bc556f0101",
    "description": "Buy groceries",
    "status": "todo",
    "createdAt": 1730921814,
    "updatedAt": 1730921814
  },
  {
    "id": "672bc562c8673",
    "description": "Cook dinner",
    "status": "todo",
    "createdAt": 1730921826,
    "updatedAt": 1730921826
  }
]
```

## Troubleshooting

- If the task ID provided for updates or deletions does not exist, an error message will be printed.
- If there is an issue with the `tasks.json` file (e.g., file permissions or corruption), ensure that the file is writable.

## Project URL
For more information, visit the project page: https://roadmap.sh/projects/task-tracker
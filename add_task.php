<?php
$conn = new mysqli("localhost", "root", "", "todo_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = $conn->real_escape_string($_POST['task']);
    
    if (!empty($task_name)) {
        $sql = "INSERT INTO tasks (task_name) VALUES ('$task_name')";
        if ($conn->query($sql) === TRUE) {
            echo "Task added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
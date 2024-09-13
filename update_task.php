<?php
$conn = new mysqli("localhost", "root", "", "todo_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = (int) $_POST['id'];
    $task_name = $conn->real_escape_string($_POST['task']);
    
    if (!empty($task_name)) {
        $sql = "UPDATE tasks SET task_name='$task_name' WHERE id=$task_id";
        if ($conn->query($sql) === TRUE) {
            echo "Task updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<?php
$conn = new mysqli("localhost", "root", "", "todo_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = (int) $_POST['id'];
    
    $sql = "DELETE FROM tasks WHERE id = $task_id";
    if ($conn->query($sql) === TRUE) {
        echo "Task deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
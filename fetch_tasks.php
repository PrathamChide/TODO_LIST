<?php
$conn = new mysqli("localhost", "root", "", "todo_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<li id='task-" . $row['id'] . "'>" . $row['task_name'] . 
             " <button onclick='editTask(" . $row['id'] . ", \"" . addslashes($row['task_name']) . "\")'>Edit</button>" .
             " <button onclick='deleteTask(" . $row['id'] . ")'>Delete</button></li>";
    }
} else {
    echo "<li>No tasks available</li>";
}

$conn->close();
?>
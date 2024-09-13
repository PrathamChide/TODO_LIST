window.onload = function () {
  fetchTasks();
};

function validateForm() {
  const taskInput = document.getElementById("task").value.trim();
  const taskId = document.getElementById("task-id").value;
  const errorMessage = document.getElementById("error-message");

  if (taskInput === "") {
    errorMessage.innerHTML = "Task cannot be empty!";
    errorMessage.classList.add("error");
    return false;
  } else if (taskInput.length < 3) {
    errorMessage.innerHTML = "Task must be at least 3 characters!";
    errorMessage.classList.add("error");
    return false;
  }

  errorMessage.innerHTML = "";

  if (taskId) {
    updateTask(taskId, taskInput);
  } else {
    addTask(taskInput);
  }

  document.getElementById("task").value = "";
  document.getElementById("task-id").value = "";
  document.getElementById("submit-btn").textContent = "Add Task";

  return false;
}

function fetchTasks() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "fetch_tasks.php", true);

  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const taskList = document.getElementById("task-list");
      taskList.innerHTML = this.responseText;
    }
  };

  xhr.send();
}

function addTask(task) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "add_task.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      fetchTasks();
    }
  };

  xhr.send("task=" + task);
}

function editTask(id, taskName) {
  document.getElementById("task").value = taskName;
  document.getElementById("task-id").value = id;
  document.getElementById("submit-btn").textContent = "Update Task";
}

function updateTask(id, task) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "update_task.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      fetchTasks();
    }
  };

  xhr.send("id=" + id + "&task=" + task);
}

function deleteTask(id) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "delete_task.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      fetchTasks();
    }
  };

  xhr.send("id=" + id);
}

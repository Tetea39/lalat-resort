<?php
session_start();

// Check if username and password are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    include './auth.php';

    // Use prepared statements to prevent SQL injection
    $stmt = $dbhandle->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $_SESSION['username'], $_SESSION['password']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        header('Location: dashboard.php');
        exit();
    } else {
        session_destroy();
        header("Location: index.htm");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $dbhandle->close();
} else {
    echo "Username or password not set.";
}

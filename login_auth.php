<?php
include 'db_connect.php';
session_start();

extract($_POST);

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the hashed password using password_verify()
    if (password_verify($password, $row['password'])) {
        // Password is correct, set session variables excluding the 'password' field
        foreach ($row as $k => $val) {
            if ($k !== 'password') {
                $_SESSION['login_' . $k] = $val;
            }
        }
        echo 1; // Login success
    } else {
        echo 2; // Incorrect password
    }
} else {
    echo 2; // User not found or incorrect username
}
?>

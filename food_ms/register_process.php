<?php
require_once 'includes/config.php';
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
if($check->get_result()->num_rows > 0) {
    header("Location: register.php?error=exists");
    exit();
}

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
$stmt->bind_param("sss", $name, $email, $password);
if($stmt->execute()) {
    header("Location: login.php?registered=1");
} else {
    header("Location: register.php?error=1");
}
exit();
?>
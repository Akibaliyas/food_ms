<?php
require_once 'includes/config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if(password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        if($user['role'] == 'admin') header("Location: admin/dashboard.php");
        else header("Location: user/dashboard.php");
        exit();
    }
}
header("Location: login.php?error=1");
exit();
?>
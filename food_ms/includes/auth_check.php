<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Role check helper
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isUser() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}
?>
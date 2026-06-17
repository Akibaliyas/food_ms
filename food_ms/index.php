<?php
require_once 'includes/config.php';
if(isset($_SESSION['user_id'])) {
    if($_SESSION['role'] == 'admin') header("Location: admin/dashboard.php");
    else header("Location: user/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodMaster - Order Food Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://source.unsplash.com/1600x600/?restaurant,food'); background-size: cover; color: white; padding: 100px 0; text-align: center; }
    </style>
</head>
<body>
<div class="hero">
    <div class="container">
        <h1 class="display-4">Welcome to FoodMaster</h1>
        <p class="lead">Delicious food delivered to your doorstep</p>
        <a href="register.php" class="btn btn-primary btn-lg">Get Started</a>
        <a href="login.php" class="btn btn-outline-light btn-lg">Login</a>
    </div>
</div>
<div class="container text-center my-5">
    <h2>Why choose us?</h2>
    <div class="row mt-4">
        <div class="col-md-4"><i class="fas fa-hamburger fa-3x text-warning"></i><h4>Fresh Food</h4></div>
        <div class="col-md-4"><i class="fas fa-shipping-fast fa-3x text-warning"></i><h4>Fast Delivery</h4></div>
        <div class="col-md-4"><i class="fas fa-tag fa-3x text-warning"></i><h4>Best Prices</h4></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
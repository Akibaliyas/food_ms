<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php'; if(!isAdmin()) header("Location: ../user/dashboard.php"); ?>
<?php include '../includes/header.php'; ?>
<h1>Admin Dashboard</h1>
<div class="row mt-3">
    <div class="col-md-4"><div class="card text-white bg-primary mb-3"><div class="card-body"><h5 class="card-title">Total Orders</h5><p class="card-text display-6"><?php echo $conn->query("SELECT COUNT(*) as c FROM orders")->fetch_assoc()['c']; ?></p></div></div></div>
    <div class="col-md-4"><div class="card text-white bg-success mb-3"><div class="card-body"><h5>Menu Items</h5><p class="display-6"><?php echo $conn->query("SELECT COUNT(*) FROM menu_items")->fetch_assoc()['COUNT(*)']; ?></p></div></div></div>
    <div class="col-md-4"><div class="card text-white bg-info mb-3"><div class="card-body"><h5>Users</h5><p class="display-6"><?php echo $conn->query("SELECT COUNT(*) FROM users")->fetch_assoc()['COUNT(*)']; ?></p></div></div></div>
</div>
<div class="mt-4"><a href="manage_menu.php" class="btn btn-dark">Manage Menu</a> <a href="manage_orders.php" class="btn btn-dark">Manage Orders</a> <a href="manage_users.php" class="btn btn-dark">Users</a></div>
<?php include '../includes/footer.php'; ?>
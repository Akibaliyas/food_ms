<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php'; ?>
<?php include '../includes/header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron bg-light p-5 rounded">
            <h1 class="display-4">Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
            <p class="lead">Ready to order your favourite meal?</p>
            <a href="menu.php" class="btn btn-primary btn-lg">Browse Menu <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-6"><div class="card"><div class="card-body"><i class="fas fa-shopping-cart fa-2x"></i><h3>Quick Order</h3><p>View our delicious items</p><a href="menu.php" class="btn btn-outline-primary">Order Now</a></div></div></div>
    <div class="col-md-6"><div class="card"><div class="card-body"><i class="fas fa-history fa-2x"></i><h3>Your Orders</h3><p>Track order status</p><a href="my_orders.php" class="btn btn-outline-primary">View Orders</a></div></div></div>
</div>
<?php include '../includes/footer.php'; ?>
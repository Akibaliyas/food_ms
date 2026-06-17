<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php'; ?>
<?php include '../includes/header.php'; ?>
<h2>Our Menu <i class="fas fa-utensils text-warning"></i></h2>
<div class="row">
    <?php
    $result = $conn->query("SELECT * FROM menu_items WHERE status=1");
    while($item = $result->fetch_assoc()):
        $img = !empty($item['image']) ? '../assets/uploads/'.$item['image'] : '../assets/images/default_food.jpg';
    ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <img src="<?= $img ?>" class="card-img-top" height="200" style="object-fit:cover;" alt="<?= $item['name'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($item['description']) ?></p>
                <p class="fw-bold text-success">$<?= number_format($item['price'],2) ?></p>
                <form method="POST" action="cart.php?action=add&id=<?= $item['id'] ?>">
                    <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width:80px; display:inline-block;">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>
<?php include '../includes/footer.php'; ?>
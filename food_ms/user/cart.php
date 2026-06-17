<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php';
// Add item
if(isset($_GET['action']) && $_GET['action']=='add') {
    $id = $_GET['id'];
    $quantity = $_POST['quantity'];
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $item = $stmt->get_result()->fetch_assoc();
    $_SESSION['cart'][$id] = [
        'name' => $item['name'],
        'price' => $item['price'],
        'quantity' => $quantity
    ];
    header("Location: cart.php");
}
// Remove item
if(isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header("Location: cart.php");
}
?>
<?php include '../includes/header.php'; ?>
<h2>Shopping Cart</h2>
<?php if(empty($_SESSION['cart'])): ?>
    <div class="alert alert-info">Your cart is empty. <a href="menu.php">Order now</a></div>
<?php else: ?>
<form method="POST" action="update_cart.php">
<table class="table table-bordered">
    <thead><tr><th>Item</th><th>Price</th><th>Qty</th><th>Total</th><th></th></tr></thead>
    <tbody>
    <?php $grand = 0; foreach($_SESSION['cart'] as $id=>$item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td>$<?= $item['price'] ?></td>
            <td><input type="number" name="qty[<?= $id ?>]" value="<?= $item['quantity'] ?>" class="form-control w-50"></td>
            <td>$<?= $item['price'] * $item['quantity'] ?></td>
            <td><a href="cart.php?remove=<?= $id ?>" class="btn btn-danger btn-sm">Remove</a></td>
        </tr>
        <?php $grand += $item['price'] * $item['quantity']; ?>
    <?php endforeach; ?>
    <tr><td colspan="3"><strong>Total</strong></td><td colspan="2"><strong>$<?= $grand ?></strong></td></tr>
    </tbody>
</table>
<button type="submit" class="btn btn-secondary">Update Cart</button>
<a href="place_order.php" class="btn btn-success">Proceed to Checkout</a>
</form>
<?php endif; ?>
<?php include '../includes/footer.php'; ?>
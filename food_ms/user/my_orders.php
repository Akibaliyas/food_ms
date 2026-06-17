<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php'; ?>
<?php include '../includes/header.php'; ?>
<h2>My Orders</h2>
<table class="table">
    <thead><tr><th>Order ID</th><th>Total</th><th>Status</th><th>Date</th><th>Details</th></tr></thead>
    <tbody>
    <?php
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $orders = $stmt->get_result();
    while($order = $orders->fetch_assoc()):
    ?>
    <tr>
        <td>#<?= $order['id'] ?></td>
        <td>$<?= $order['total_amount'] ?></td>
        <td><span class="badge bg-<?= ($order['status']=='Pending')?'warning':(($order['status']=='Completed')?'success':'primary') ?>"><?= $order['status'] ?></span></td>
        <td><?= $order['created_at'] ?></td>
        <td><button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal<?= $order['id'] ?>">View Items</button></td>
    </tr>
    <!-- Modal for items -->
    <div class="modal fade" id="modal<?= $order['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5>Items</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><ul><?php $items = $conn->query("SELECT oi.quantity, oi.price, m.name FROM order_items oi JOIN menu_items m ON oi.menu_item_id=m.id WHERE oi.order_id={$order['id']}"); while($it = $items->fetch_assoc()): ?><li><?= $it['quantity'] ?> x <?= $it['name'] ?> - $<?= $it['price'] ?></li><?php endwhile; ?></ul></div></div></div></div>
    <?php endwhile; ?>
    </tbody>
</table>
<?php include '../includes/footer.php'; ?>
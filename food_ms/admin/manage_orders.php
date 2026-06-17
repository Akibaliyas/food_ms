<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php'; if(!isAdmin()) header("Location: ../user/dashboard.php");
if(isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $conn->query("UPDATE orders SET status='$status' WHERE id=$order_id");
}
?>
<?php include '../includes/header.php'; ?>
<h2>All Orders</h2>
<table class="table">
    <thead><tr><th>Order ID</th><th>User</th><th>Total</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php
    $res = $conn->query("SELECT o.*, u.name FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.created_at DESC");
    while($row=$res->fetch_assoc()):
    ?>
    <tr><td>#<?= $row['id'] ?></td><td><?= $row['name'] ?></td><td>$<?= $row['total_amount'] ?></td><td><form method="POST"><input type="hidden" name="order_id" value="<?= $row['id'] ?>"><select name="status" class="form-select d-inline w-auto"><?php foreach(['Pending','Preparing','Completed','Cancelled'] as $s): ?><option <?= ($s==$row['status'])?'selected':'' ?>><?= $s ?></option><?php endforeach; ?></select><button type="submit" name="update_status" class="btn btn-sm btn-primary">Update</button></form></td></tr>
    <?php endwhile; ?>
    </tbody>
</table>
<?php include '../includes/footer.php'; ?>
<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php'; if(!isAdmin()) header("Location: ../user/dashboard.php");
// Add / Edit / Delete logic
if(isset($_POST['add'])) {
    $name = $_POST['name']; $desc = $_POST['desc']; $price = $_POST['price'];
    $image = 'default.jpg';
    if($_FILES['image']['error']==0) {
        $target = "../assets/uploads/".time()."_".basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = basename($target);
    }
    $stmt = $conn->prepare("INSERT INTO menu_items (name, description, price, image) VALUES (?,?,?,?)");
    $stmt->bind_param("ssds", $name, $desc, $price, $image);
    $stmt->execute();
}
if(isset($_GET['delete'])) {
    $conn->query("DELETE FROM menu_items WHERE id=".intval($_GET['delete']));
}
?>
<?php include '../includes/header.php'; ?>
<h2>Manage Menu</h2>
<div class="row">
    <div class="col-md-4"><div class="card p-3"><h4>Add New Item</h4><form method="POST" enctype="multipart/form-data"><input type="text" name="name" class="form-control mb-2" placeholder="Name" required><textarea name="desc" class="form-control mb-2" placeholder="Description"></textarea><input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" required><input type="file" name="image" class="form-control mb-2"><button type="submit" name="add" class="btn btn-primary">Add Item</button></form></div></div>
    <div class="col-md-8"><table class="table"><thead><tr><th>Image</th><th>Name</th><th>Price</th><th>Action</th></tr></thead><tbody><?php $items = $conn->query("SELECT * FROM menu_items"); while($row=$items->fetch_assoc()): ?><tr><td><img src="../assets/uploads/<?= $row['image'] ?>" width="50" height="50"></td><td><?= $row['name'] ?></td><td>$<?= $row['price'] ?></td><td><a href="manage_menu.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete?')" class="btn btn-danger btn-sm">Delete</a> <a href="edit_menu.php?id=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">Edit</a></td></tr><?php endwhile; ?></tbody></table></div>
</div>
<?php include '../includes/footer.php'; ?>
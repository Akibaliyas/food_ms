<?php
require_once '../includes/config.php';
require_once '../includes/auth_check.php';
if(!isAdmin()) header("Location: ../user/dashboard.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$item = null;

// Fetch existing item
if($id > 0) {
    $result = $conn->query("SELECT * FROM menu_items WHERE id = $id");
    $item = $result->fetch_assoc();
    if(!$item) {
        header("Location: manage_menu.php");
        exit;
    }
}

// Update logic
if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $image = $item['image']; // keep old image by default

    // Handle new image upload
    if($_FILES['image']['error'] == 0) {
        $target = "../assets/uploads/".time()."_".basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = basename($target);
    }

    $stmt = $conn->prepare("UPDATE menu_items SET name=?, description=?, price=?, image=? WHERE id=?");
    $stmt->bind_param("ssdsi", $name, $desc, $price, $image, $id);
    $stmt->execute();
    header("Location: manage_menu.php");
    exit;
}

include '../includes/header.php';
?>

<h2>Edit Menu Item</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card p-3">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" class="form-control mb-2" value="<?= htmlspecialchars($item['name']) ?>" required>
                <textarea name="desc" class="form-control mb-2" placeholder="Description"><?= htmlspecialchars($item['description']) ?></textarea>
                <input type="number" step="0.01" name="price" class="form-control mb-2" value="<?= $item['price'] ?>" required>
                <input type="file" name="image" class="form-control mb-2">
                <small>Current image: <img src="../assets/uploads/<?= $item['image'] ?>" width="50"></small>
                <button type="submit" name="update" class="btn btn-primary mt-2">Update Item</button>
                <a href="manage_menu.php" class="btn btn-secondary mt-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php'; if(!isAdmin()) header("Location: ../user/dashboard.php");
if(isset($_GET['delete'])) $conn->query("DELETE FROM users WHERE id=".intval($_GET['delete']));
if(isset($_GET['make_admin'])) $conn->query("UPDATE users SET role='admin' WHERE id=".intval($_GET['make_admin']));
?>
<?php include '../includes/header.php'; ?>
<h2>Manage Users</h2>
<table class="table"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead><tbody>
<?php $res = $conn->query("SELECT * FROM users"); while($u=$res->fetch_assoc()): ?>
<tr><td><?= $u['id'] ?></td><td><?= $u['name'] ?></td><td><?= $u['email'] ?></td><td><?= $u['role'] ?></td><td><?php if($u['role']!='admin'): ?><a href="manage_users.php?make_admin=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Make Admin</a> <?php endif; ?><a href="manage_users.php?delete=<?= $u['id'] ?>" onclick="return confirm('Delete user?')" class="btn btn-sm btn-danger">Delete</a></td></tr>
<?php endwhile; ?></tbody></table>
<?php include '../includes/footer.php'; ?>
<?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white"><h3>Login</h3></div>
        <div class="card-body">
            <?php if(isset($_GET['error'])) echo "<div class='alert alert-danger'>Invalid credentials</div>"; ?>
            <form method="POST" action="authenticate.php">
                <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="mt-3 text-center">No account? <a href="register.php">Register</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
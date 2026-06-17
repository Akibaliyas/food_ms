<?php require_once '../includes/config.php'; require_once '../includes/auth_check.php';
if(empty($_SESSION['cart'])) header("Location: menu.php");
$total = 0;
foreach($_SESSION['cart'] as $item) $total += $item['price'] * $item['quantity'];

$conn->begin_transaction();
try {
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'Pending')");
    $stmt->bind_param("id", $_SESSION['user_id'], $total);
    $stmt->execute();
    $order_id = $conn->insert_id;

    $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach($_SESSION['cart'] as $mid => $item) {
        $stmt2->bind_param("iiid", $order_id, $mid, $item['quantity'], $item['price']);
        $stmt2->execute();
    }
    $conn->commit();
    unset($_SESSION['cart']);
    $_SESSION['message'] = "Order placed successfully!";
    header("Location: my_orders.php");
} catch(Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}
exit();
?>
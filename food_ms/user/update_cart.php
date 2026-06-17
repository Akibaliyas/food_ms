<?php
session_start();
if(isset($_POST['qty'])) {
    foreach($_POST['qty'] as $id => $qty) {
        if($qty <= 0) unset($_SESSION['cart'][$id]);
        else $_SESSION['cart'][$id]['quantity'] = $qty;
    }
}
header("Location: cart.php");
?>
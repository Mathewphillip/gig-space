<?php
include('../config/db_config.php');
include('../config/init.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../dashboards/client.php?error=" . urlencode("Please login first."));
    exit();
}

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
if ($order_id <= 0) {
    exit();
}

// Fetch order to validate ownership and status
$order_q = mysqli_query($conn, "
    SELECT id, client_id, status, total_price 
    FROM orders 
    WHERE id = $order_id AND client_id = $user_id AND status = 'pending'
    LIMIT 1
");
$order = mysqli_fetch_assoc($order_q);

if (!$order) {
    exit();
}

// Escrow removed: mark order completed immediately
$update_q = mysqli_query($conn, "
    UPDATE orders 
    SET status = 'completed', completed_at = NOW()
    WHERE id = $order_id
");

if ($update_q) {
    header("Location: ../dashboards/dashboard.php");
} else {
    header("Location: ../dashboards/client.php?error=" . urlencode("Failed to process payment."));
}
exit();
?>

<?php
session_start();
include('../config/db_config.php');
include('../config/init.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../dashboards/freelancer.php?error=" . urlencode("Please login first."));
    exit();
}

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
if ($order_id <= 0) {
    header("Location: ../dashboards/freelancer.php?error=" . urlencode("Invalid order ID."));
    exit();
}

// Get freelancer_id
$freelancer_q = mysqli_query($conn, "SELECT id FROM freelancer_profiles WHERE user_id = $user_id LIMIT 1");
$freelancer = mysqli_fetch_assoc($freelancer_q);
if (!$freelancer) {
    header("Location: ../dashboards/freelancer.php?error=" . urlencode("Not a freelancer."));
    exit();
}
$freelancer_id = $freelancer['id'];

// Validate order
$order_q = mysqli_query($conn, "
    SELECT id, freelancer_id, status 
    FROM orders 
    WHERE id = $order_id AND freelancer_id = $freelancer_id AND status = 'paid'
    LIMIT 1
");
$order = mysqli_fetch_assoc($order_q);

if (!$order) {
    header("Location: ../dashboards/freelancer.php?error=" . urlencode("Order not found, not paid, or access denied."));
    exit();
}

// Update to 'submitted'
$update_q = mysqli_query($conn, "
    UPDATE orders SET status = 'submitted' WHERE id = $order_id
");

if ($update_q) {
    header("Location: ../dashboards/freelancer.php?section=orders&submit_success=" . urlencode("Work submitted! Await client approval."));
} else {
    header("Location: ../dashboards/freelancer.php?error=" . urlencode("Failed to submit work."));
}
exit();
?>
</create_file>

<create_file>
<absolute_path>c:/xampp/htdocs/gigspace/process/release_payment.php</absolute_path>
<content><?php
session_start();
include('../config/db_config.php');
include('../config/init.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../dashboards/client.php?error=" . urlencode("Please login first."));
    exit();
}

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
if ($order_id <= 0) {
    header("Location: ../dashboards/client.php?error=" . urlencode("Invalid order ID."));
    exit();
}

// Validate client owns order and ready for release
$order_q = mysqli_query($conn, "
    SELECT id, client_id, status 
    FROM orders 
    WHERE id = $order_id AND client_id = $user_id AND status IN ('paid', 'submitted')
    LIMIT 1
");
$order = mysqli_fetch_assoc($order_q);

if (!$order) {
    header("Location: ../dashboards/client.php?error=" . urlencode("Order not found or not ready for release."));
    exit();
}

// Release payment → completed
$update_q = mysqli_query($conn, "
    UPDATE orders SET status = 'completed', completed_at = NOW() WHERE id = $order_id
");

if ($update_q) {
    header("Location: ../dashboards/client.php?section=orders&release_success=" . urlencode("Payment released! Freelancer has been paid. Thank you!"));
} else {
    header("Location: ../dashboards/client.php?error=" . urlencode("Failed to release payment."));
}
exit();
?>
</create_file>

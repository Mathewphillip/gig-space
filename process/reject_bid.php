<?php
session_start();
include('../config/db_config.php');
include('../config/init.php');
include('../auth/auth.php');

$user_id = $_SESSION['user_id'];
if (!$user_id) {
    header("Location: ../components/login.php");
    exit();
}

$bid_id = (int) ($_GET['bid_id'] ?? 0);
$project_id = (int) ($_GET['project_id'] ?? 0);

if ($bid_id <= 0 || $project_id <= 0) {
    header("Location: ../dashboards/client/bids.php?error=" . urlencode('Invalid bid/project'));
    exit();
}

$bid_q = mysqli_query($conn, "
    SELECT bids.*, projects.client_id
    FROM bids
    JOIN projects ON bids.project_id = projects.id
    WHERE bids.id = $bid_id AND bids.project_id = $project_id AND bids.status = 'pending'
    LIMIT 1
");

$bid = mysqli_fetch_assoc($bid_q);
if (!$bid) {
    header("Location: ../dashboards/client/bids.php?error=" . urlencode('Bid not found or not pending'));
    exit();
}

// Verify ownership
if ($bid['client_id'] != $user_id) {
    header("Location: ../dashboards/client/bids.php?error=" . urlencode('Unauthorized'));
    exit();
}

// Reject the bid
$update = mysqli_query($conn, "UPDATE bids SET status='rejected' WHERE id = $bid_id");
if ($update) {
    header("Location: ../dashboards/client/bids.php?success=" . urlencode('Bid rejected successfully'));
} else {
    header("Location: ../dashboards/client/bids.php?error=" . urlencode('Failed to reject bid'));
}
exit();
?>


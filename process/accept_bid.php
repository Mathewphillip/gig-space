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
    header("Location: ../dashboards/client/projects.php?error=Invalid bid/project");
    exit();
}
$bid_q = mysqli_query($conn, "
    SELECT bids.*, projects.client_id, projects.title AS project_title, projects.category_id
    FROM bids
    JOIN projects ON bids.project_id = projects.id
    WHERE bids.id = $bid_id AND bids.project_id = $project_id AND bids.status = 'pending'
    LIMIT 1
");
$bid = mysqli_fetch_assoc($bid_q);
if (!$bid) {
    header("Location: ../dashboards/client/projects.php?error=Bid not found or not pending");
    exit();
}
// Verify ownership
if ($bid['client_id'] != $user_id) {
    header("Location: ../dashboards/client/projects.php?error=Unauthorized");
    exit();
}
$freelancer_id = $bid['freelancer_id'];
$amount = $bid['amount'];
$project_title = mysqli_real_escape_string($conn, $bid['project_title']);
$requirements = mysqli_real_escape_string($conn, "Project: " . $bid['project_title'] . "\nBid Amount: $" . $amount . "\nDelivery: " . $bid['delivery_time'] . " days");
$category_id = $bid['category_id'] ?? 1;

// No gig creation - keep as project
// Create project-based order
mysqli_query($conn, "
    INSERT INTO orders (project_id, client_id, freelancer_id, requirements, total_price, status)
    VALUES ($project_id, $user_id, $freelancer_id, '$requirements', $amount, 'pending')
");

// Update bids and project
mysqli_query($conn, "UPDATE bids SET status='accepted' WHERE id=$bid_id");
mysqli_query($conn, "UPDATE bids SET status='rejected' WHERE project_id=$project_id AND id != $bid_id");
mysqli_query($conn, "UPDATE projects SET status='accepted' WHERE id=$project_id");

// Create conversation
mysqli_query($conn, "INSERT INTO conversations (order_id) VALUES (LAST_INSERT_ID())");

// Go back to the client dashboard and keep the UI stable.
header("Location: ../dashboards/dashboard.php");
exit();
?>



<?php
session_start();
include('../config/db_config.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../components/login.php");
    exit();
}

// Get freelancer profile id
$freelancer_q = mysqli_query($conn, "SELECT id FROM freelancer_profiles WHERE user_id = $user_id LIMIT 1");
$freelancer = mysqli_fetch_assoc($freelancer_q);
if (!$freelancer) {
    die("You are not registered as a freelancer.");
}
$freelancer_id = $freelancer['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_bid'])) {
    $project_id = (int) $_POST['project_id'];
    $amount = (float) $_POST['amount'];
    $proposal = mysqli_real_escape_string($conn, trim($_POST['proposal']));
    $delivery_time = (int) $_POST['delivery_time'];

    if ($project_id <= 0 || $amount <= 0 || empty($proposal) || $delivery_time <= 0) {
        header("Location: ../dashboards/dashboard.php?section=projects&error=" . urlencode("Fill all required fields."));
        exit();
    }

    // Check project exists and is open
    $project_q = mysqli_query($conn, "SELECT client_id, status FROM projects WHERE id = $project_id LIMIT 1");
    $project = mysqli_fetch_assoc($project_q);
    if (!$project || $project['status'] !== 'open') {
        header("Location: ../dashboards/dashboard.php?section=projects&error=" . urlencode("Project is no longer open for bidding."));
        exit();
    }

    // Prevent bidding on own project
    if ($project['client_id'] == $user_id) {
        header("Location: ../dashboards/dashboard.php?section=projects&error=" . urlencode("You cannot bid on your own project."));
        exit();
    }

    // Insert bid
    $insert = mysqli_query($conn, "INSERT INTO bids (project_id, freelancer_id, amount, proposal, delivery_time, status) VALUES ($project_id, $freelancer_id, $amount, '$proposal', $delivery_time, 'pending')");

    if (!$insert) {
        // Likely duplicate bid
        header("Location: ../dashboards/dashboard.php?section=projects&error=" . urlencode("You have already placed a bid on this project."));
        exit();
    }

    header("Location: ../dashboards/dashboard.php?section=projects&bid_success=1");
    exit();
}
header("Location: ../dashboards/dashboard.php?section=projects");
exit();


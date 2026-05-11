<?php
session_start();
include('../config/db_config.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../components/login.php");
    exit();
}

// Verify user is a client or both
$role_q = mysqli_query($conn, "SELECT role FROM users WHERE id = $user_id LIMIT 1");
$user = mysqli_fetch_assoc($role_q);
if (!in_array($user['role'], ['client', 'both'])) {
    die("Only clients can post projects.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_project'])) {
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $description = mysqli_real_escape_string($conn, trim($_POST['description']));
    $category_id = (int) $_POST['category_id'];
    $budget_min = (float) $_POST['budget_min'];
    $budget_max = (float) $_POST['budget_max'];
    $deadline = $_POST['deadline'] ? mysqli_real_escape_string($conn, $_POST['deadline']) : null;

    if (empty($title) || empty($description) || $category_id <= 0 || $budget_min <= 0 || $budget_max <= 0) {
        header("Location: ../dashboards/client.php?section=projects&error=" . urlencode("Fill all required fields correctly."));
        exit();
    }

    if ($budget_max < $budget_min) {
        header("Location: ../dashboards/client.php?section=projects&error=" . urlencode("Max budget must be greater than min budget."));
        exit();
    }

    $deadline_sql = $deadline ? "'$deadline'" : "NULL";

    mysqli_query($conn, "
        INSERT INTO projects (client_id, category_id, title, description, budget_min, budget_max, deadline, status)
        VALUES ($user_id, $category_id, '$title', '$description', $budget_min, $budget_max, $deadline_sql, 'open')
    ");

    header("Location: ../dashboards/dashboard.php");
    exit();
}
exit();


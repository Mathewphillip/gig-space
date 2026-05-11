<?php
session_start();
include('../config/db_config.php');
include('../config/init.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../dashboards/client.php?error=" . urlencode("Please login first."));
    exit();
}

// Validate inputs
$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, trim($_GET['status'])) : '';

if ($project_id <= 0 || empty($status)) {
    header("Location: ../dashboards/client/projects.php?error=" . urlencode("Invalid project or status."));
    exit();
}

// Verify user is a client
$user_query = mysqli_query($conn, "SELECT role FROM users WHERE id = $user_id LIMIT 1");
$user = mysqli_fetch_assoc($user_query);
if (!$user || !in_array($user['role'], ['client', 'both'])) {
    header("Location: ../dashboards/client/projects.php?error=" . urlencode("Access denied. Clients only."));
    exit();
}

// Check project exists and belongs to user, and status transition valid
$project_query = mysqli_query($conn, "
    SELECT client_id, status 
    FROM projects 
    WHERE id = $project_id AND client_id = $user_id 
    LIMIT 1
");
$project = mysqli_fetch_assoc($project_query);

if (!$project) {
    header("Location: ../dashboards/client/projects.php?error=" . urlencode("Project not found or access denied."));
    exit();
}

if ($project['status'] !== 'open') {
    header("Location: ../dashboards/client/projects.php?error=" . urlencode("Only open projects can be closed."));
    exit();
}

// Only allow 'closed' for now (matches UI link)
if ($status !== 'closed') {
    header("Location: ../dashboards/client/projects.php?error=" . urlencode("Invalid status."));
    exit();
}

// Update project status
$update_query = mysqli_query($conn, "UPDATE projects SET status = '$status' WHERE id = $project_id");
if ($update_query) {
    header("Location: ../dashboards/client/projects.php?success=" . urlencode("Project status updated to " . ucfirst($status) . "."));
} else {
    header("Location: ../dashboards/client/projects.php?error=" . urlencode("Failed to update project status."));
}
exit();
?>


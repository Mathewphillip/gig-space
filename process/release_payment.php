<?php
session_start();
include('../config/db_config.php');
include('../config/init.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../dashboards/client.php?error=" . urlencode("Please login first."));
    exit();
}

// Escrow removed: release_payment is no longer available.
header("Location: ../dashboards/client.php?section=orders&error=" . urlencode("Payment release is not available. Escrow has been removed."));
exit();



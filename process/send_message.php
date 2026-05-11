<?php
session_start();
include('../config/db_config.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$convo_id = isset($_POST['convo_id']) ? (int)$_POST['convo_id'] : 0;

$message = isset($_POST['message'])
    ? mysqli_real_escape_string($conn, trim($_POST['message']))
    : '';

if (!$convo_id || empty($message)) {
    echo json_encode(['error' => 'Missing data']);
    exit();
}

// Verify user is part of the conversation
$verify_query = "
    SELECT c.id
    FROM conversations c
    JOIN orders o ON c.order_id = o.id
    WHERE c.id = '$convo_id'
    AND (
        o.client_id = '$user_id'
        OR o.freelancer_id IN (
            SELECT fp.id
            FROM freelancer_profiles fp
            WHERE fp.user_id = '$user_id'
        )
    )
    LIMIT 1
";

$verify_result = mysqli_query($conn, $verify_query);

if (!$verify_result) {
    echo json_encode(['error' => 'Verification failed']);
    exit();
}

$verify = mysqli_fetch_assoc($verify_result);

if (!$verify) {
    echo json_encode(['error' => 'Access denied']);
    exit();
}

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Insert message
 $insert_query = "INSERT INTO messages(conversation_id, sender_id, message, message_type, is_read) VALUES('$convo_id', '$user_id', '$message', 'text', 0)";

    if (!mysqli_query($conn, $insert_query)) {
        throw new Exception(mysqli_error($conn));
    }

    $message_id = mysqli_insert_id($conn);

    // Update conversation
    $update_query = "
        UPDATE conversations
        SET updated_at = NOW()
        WHERE id = '$convo_id'
    ";

    if (!mysqli_query($conn, $update_query)) {
        throw new Exception(mysqli_error($conn));
    }

    // Commit transaction
    mysqli_commit($conn);

    echo json_encode([
        'success' => true,
        'message_id' => $message_id
    ]);

} catch (Exception $e) {

    mysqli_rollback($conn);

    error_log('Send message error: ' . $e->getMessage());

    echo json_encode([
        'error' => 'Failed to send message'
    ]);
}
?>
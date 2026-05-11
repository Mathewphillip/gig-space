<?php
session_start();
include('../config/db_config.php');

header('Content-Type: application/json');

if(!isset($_SESSION['user_id'])){
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Count unread messages in conversations this user participates in
// User is part of conversation if: client on the order OR freelancer profile belongs to them
$count_result = mysqli_query($conn, "
    SELECT COUNT(*) AS unread_count
    FROM messages
    JOIN conversations ON messages.conversation_id = conversations.id
    JOIN orders ON conversations.order_id = orders.id
    WHERE messages.sender_id != $user_id
      AND messages.is_read = 0
      AND (
          orders.client_id = $user_id
          OR orders.freelancer_id IN (
              SELECT id FROM freelancer_profiles WHERE user_id = $user_id
          )
      )
");

$count = mysqli_fetch_assoc($count_result);
echo json_encode(['unread_count' => (int)($count['unread_count'] ?? 0)]);

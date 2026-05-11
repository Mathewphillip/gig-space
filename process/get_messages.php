<?php
session_start();
include('../config/db_config.php');

header('Content-Type: application/json');

if(!isset($_SESSION['user_id'])){
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];
$convo_id = isset($_GET['convo_id']) ? (int)$_GET['convo_id'] : 0;
$after_id = isset($_GET['after_id']) ? (int)$_GET['after_id'] : 0;

if(!$convo_id){
    echo json_encode(['error' => 'No conversation ID']);
    exit();
}

// Verify user is part of this conversation
$verify = mysqli_query($conn, "
    SELECT conversations.id 
    FROM conversations
    JOIN orders ON conversations.order_id = orders.id
    WHERE conversations.id = $convo_id
    AND (orders.client_id = $user_id 
         OR orders.freelancer_id IN (
             SELECT id FROM freelancer_profiles WHERE user_id = $user_id
         ))
    LIMIT 1
");

if(mysqli_num_rows($verify) == 0){
    echo json_encode(['error' => 'Access denied']);
    exit();
}

// Build fetch query with optional after_id
$after_clause = $after_id ? "AND messages.id > $after_id" : "";
$messages = mysqli_query($conn, "
    SELECT messages.*, users.username, users.id AS sender_user_id
    FROM messages
    JOIN users ON messages.sender_id = users.id
    WHERE messages.conversation_id = $convo_id $after_clause
    ORDER BY messages.created_at ASC
");

$msg_list = [];
while($m = mysqli_fetch_assoc($messages)){
    $msg_list[] = [
        'id' => $m['id'],
        'sender_id' => $m['sender_id'],
        'sender_name' => $m['username'],
        'message' => $m['message'],
        'created_at' => $m['created_at'],
        'is_me' => ($m['sender_id'] == $user_id)
    ];
}

// Mark messages as read
mysqli_query($conn, "
    UPDATE messages 
    SET is_read = 1 
    WHERE conversation_id = $convo_id 
    AND sender_id != $user_id 
    AND is_read = 0
");

echo json_encode(['messages' => $msg_list]);

<?php
session_start();
require_once '../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['subscriber_email'])) {

    $email = mysqli_real_escape_string(
        $conn,
        trim($_POST['subscriber_email'])
    );

    $redirect = !empty($_POST['redirect'])
        ? $_POST['redirect']
        : '../index.php';

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['subscribe_status'] = 'error';
        $_SESSION['subscribe_message'] =
            'Please enter a valid email address.';

        header("Location: $redirect");
        exit();
    }

    // Check if email already exists
    $check_query = "
        SELECT id
        FROM subscribers
        WHERE email = '$email'
        LIMIT 1
    ";

    $check_result = mysqli_query($conn, $check_query);

    if (!$check_result) {

        $_SESSION['subscribe_status'] = 'error';
        $_SESSION['subscribe_message'] =
            'Database error occurred.';

        header("Location: $redirect");
        exit();
    }

    if (mysqli_num_rows($check_result) > 0) {

        $_SESSION['subscribe_status'] = 'info';
        $_SESSION['subscribe_message'] =
            'You are already subscribed!';

        header("Location: $redirect");
        exit();
    }

    // Insert new subscriber
    $insert_query = "
        INSERT INTO subscribers (email)
        VALUES ('$email')
    ";

    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {

        $_SESSION['subscribe_status'] = 'success';
        $_SESSION['subscribe_message'] =
            'Thank you for subscribing!';

    } else {

        $_SESSION['subscribe_status'] = 'error';
        $_SESSION['subscribe_message'] =
            'Something went wrong. Please try again.';
    }

    header("Location: $redirect");
    exit();
}
// If accessed directly without POST data
header("Location: ../index.php");
exit();
?>
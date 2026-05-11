<?php
session_start();
require_once '../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = isset($_POST['name'])
        ? mysqli_real_escape_string($conn, trim($_POST['name']))
        : '';

    $email = isset($_POST['email'])
        ? mysqli_real_escape_string($conn, trim($_POST['email']))
        : '';

    $message = isset($_POST['message'])
        ? mysqli_real_escape_string($conn, trim($_POST['message']))
        : '';

    $redirect = !empty($_POST['redirect'])
        ? $_POST['redirect']
        : '../contact_us.php';

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {

        $_SESSION['contact_status'] = 'error';
        $_SESSION['contact_message'] = 'Please fill in all required fields.';

        header("Location: $redirect");
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['contact_status'] = 'error';
        $_SESSION['contact_message'] = 'Please enter a valid email address.';

        header("Location: $redirect");
        exit();
    }

    // Validate message length
    if (strlen($message) < 10) {

        $_SESSION['contact_status'] = 'error';
        $_SESSION['contact_message'] = 'Your message must be at least 10 characters long.';

        header("Location: $redirect");
        exit();
    }

    // Insert into database
    $query = "
        INSERT INTO contact_messages
        (name, email, message)
        VALUES
        (
            '$name',
            '$email',
            '$message'
        )
    ";

    $result = mysqli_query($conn, $query);

    if ($result) {

        $_SESSION['contact_status'] = 'success';

        $_SESSION['contact_message'] =
            'Thank you for reaching out! We will get back to you soon.';

    } else {

        $_SESSION['contact_status'] = 'error';

        $_SESSION['contact_message'] =
            'Something went wrong. Please try again later.';
    }

    header("Location: $redirect");
    exit();
}

// If accessed directly without POST request
header("Location: ../contact_us.php");
exit();
?>
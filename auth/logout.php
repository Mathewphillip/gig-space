<?php
session_start();

// clear all session variables
session_unset();

// destroy the session completely
session_destroy();

// redirect to homepage or login
header("Location: ../index.php");
exit();
?>
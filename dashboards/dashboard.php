<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user | Dashboard</title>
</head>
<body>
<?php
    include('../auth/auth.php');
    include('../config/db_config.php');
    include('../assets/styling.php');
    include('dashboardHeader.php');
    include('dashboardstyle.php');

    $user_id = $_SESSION['user_id'];
    // fetching user details
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    $role = $user['role'];
    $username = $user['username'];
    ?>
    <main>
        <?php if($role == 'freelancer'): ?>
            <div class="freelancer-dashboard">
                <?php include('freelancer.php');?>
            </div>
        <?php elseif($role == 'client'):?>
            <div class="client-dashboard">
                <?php include('client.php');?>
            </div>
        <?php endif;?>
        
    </main>
</body>
</html>
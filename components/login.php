<?php
session_start();
include('../config/db_config.php');
$errors = array('email'=>'', 'password'=>'', 'account'=>'');
$email =$password = $account= '';
if(isset($_POST['login'])){
        // email
    if(empty($_POST['email'])){
        $errors['email'] = "<p style='color:red'>email is required</p>";
    }else{
        $email = trim(htmlspecialchars($_POST['email']));
    }

    // password
    if(empty($_POST['password'])){
        $errors['password'] = "<p style='color:red'>password is required</p>";
    }else{
        $password = $_POST['password'];
    }

    if(!array_filter($errors)){
        $email = mysqli_real_escape_string($conn, $email);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            // fetching only user as single array
            $user = mysqli_fetch_assoc($result);
            // checking password for user
            if(password_verify($password, $user['password'])){
                // checking activeness of user
                if($user['is_active'] == 1){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    // updating login status
                    $update = "UPDATE users SET last_login = NOW() WHERE id =" .$user['id'];
                    mysqli_query($conn, $update);

                    header("Location: ../index.php");
                    exit();
                } else {
                    $errors['account'] = "<p style='color:red'>Account is deactivated</p>";
                }
            }else{
                $errors['password'] = "<p style='color:red'>Incorrect password</p>";
            }
        } else {
            $errors['email'] = "<p style='color:red'>Email not found</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | login</title>
</head>
<body>
        <?php include('../assets/styling.php');?>
    <style>
    body { background: none !important; }
    main { 
        min-height: 100vh; 
        display: flex;
        align-items: center;
        justify-content: center;
        background:url('../images/lighttheme.png');
    }
    .signup-form {
        background: rgba(255,255,255,0.95) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .back { 
        position: absolute; 
        top: 20px; 
        left: 20px; 
        background: rgb(1, 83, 225); 
        color: white !important; 
        padding: 10px 20px; 
        border-radius: 15px; 
        z-index: 10;
        min-width: 150px;
    }
    </style>
    <main>
        <a href="../index.php" class="back" style="color:white !important;">home</a>
        <div class="form-container">
            <form class="signup-form" action="login.php" method="POST">
                <h2 class="log-title">login to <span class="gigspace-brand-heading"><span class="gig">Gig</span>Sp<span class="a">a</span>ce</span></h2>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                    <?php if($errors['email']) echo $errors['email']; ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label> <!-- And this one too! -->
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="form-button" name="login">login</button>
                <div class="form-footer">
                    <p>Don't  have an account? <a href="signup.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
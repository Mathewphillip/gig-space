<?php

$user_id = $_SESSION['user_id'];
// =========================
// FETCH USER
// =========================
$user_query = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

// =========================
// FETCH PROFILE
// =========================
$profile_query = "SELECT * FROM profiles WHERE user_id = $user_id LIMIT 1";
$profile_result = mysqli_query($conn, $profile_query);
$profile = mysqli_fetch_assoc($profile_result);

// ensure profile exists
if(!$profile){
    mysqli_query($conn, "INSERT INTO profiles (user_id) VALUES ($user_id)");
    $profile = [];
}

// =========================
// MESSAGES
// =========================
$success = "";
$error = "";

// =========================
// HANDLE UPDATE
// =========================
if(isset($_POST['update_settings'])){

    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));

    $full_name = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone_number']));
    $bio = mysqli_real_escape_string($conn, trim($_POST['bio']));
    $country = mysqli_real_escape_string($conn, trim($_POST['country']));

    if(empty($username) || empty($email)){
        $error = "Username and Email are required.";
    } else {

        // =========================
        // UPDATE USERS
        // =========================
        mysqli_query($conn, "
            UPDATE users 
            SET username='$username', email='$email'
            WHERE id=$user_id
        ");

        // =========================
        // UPDATE PROFILE
        // =========================
        mysqli_query($conn, "
            UPDATE profiles 
            SET 
                full_name='$full_name',
                phone_number='$phone',
                bio='$bio',
                country='$country'
            WHERE user_id=$user_id
        ");

        // =========================
        // HANDLE IMAGE UPLOAD (ONLY IF FILE IS SELECTED)
        // =========================
        if(!empty($_FILES['profile_image']['name']) && $_FILES['profile_image']['error'] == 0){
            $upload_dir = __DIR__ . "/../uploads/profile/";
            if(!file_exists($upload_dir)){
                mkdir($upload_dir, 0777, true);
            }
            $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','webp'];
            if(in_array($ext, $allowed) && $_FILES['profile_image']['size'] <= 2 * 1024 * 1024){
                $filename = time().'_'.uniqid().'.'.$ext;
                move_uploaded_file(
                    $_FILES['profile_image']['tmp_name'],
                    $upload_dir.$filename
                );

                mysqli_query($conn, "
                    UPDATE profiles 
                    SET profile_image='$filename'
                    WHERE user_id=$user_id
                ");
            } else {
                $error = "Invalid image or too large (max 2MB).";
            }
        }

        // Redirect to prevent form resubmission on refresh
        exit();
    }
}

// Check for success message from redirect
if(isset($_GET['success'])){
    $success = "Settings updated successfully!";
}

// Refresh user and profile data after potential update
$user_result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($user_result);

$profile_result = mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = $user_id");
$profile = mysqli_fetch_assoc($profile_result);

// =========================
// IMAGE PATH - FIXED
// =========================
$image_path = "default_image.jpg";
if(!empty($profile['profile_image'])){
    // Check if file exists in the uploads folder
    $full_image_path = __DIR__ . "/../uploads/profile/" . $profile['profile_image'];
    if(file_exists($full_image_path)){
        $image_path = "../dashboards/uploads/profile/" . $profile['profile_image'];
    } else {
        $image_path = "default_image.jpg";
    }
}
?>
<div class="panel settings-panel">
    <div class="panel-header">
        <h3>Settings</h3>
    </div>
    <?php if($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <!-- =========================
         PROFILE IMAGE
    ========================= -->
    <form method="POST" enctype="multipart/form-data" class="profile-image-form">
        <div class="profile-image-box">
            <img id="profilePreview" src="<?php echo $image_path; ?>">
            <label for="profileImageInput" class="image-upload-btn p-image-btn">
                upload your image
            </label>
            <input type="file" name="profile_image" id="profileImageInput" hidden accept="image/*">
        </div>

    <!-- =========================
         SETTINGS FORM
    ========================= -->
    <div class="settings-form">

        <!-- ACCOUNT INFO -->
        <h4>Account Information</h4>
        <div class="field-container">
            <div class="form-row">
            <label>Username</label>
            <input type="text" name="username" 
                value="<?php echo htmlspecialchars($user['username']); ?>">
        </div>
        <div class="form-row">
            <label>Email</label>
            <input type="email" name="email" 
                value="<?php echo htmlspecialchars($user['email']); ?>">
        </div>
        </div>
        <!-- PROFILE INFO -->
        <h4>Profile Information</h4>
        <div class="field-container">
            <div class="form-row">
            <label>Full Name</label>
            <input type="text" name="full_name"
                value="<?php echo htmlspecialchars($profile['full_name'] ?? ''); ?>">
        </div>
        <div class="form-row">
            <label>Phone Number</label>
            <input type="text" name="phone_number"
                value="<?php echo htmlspecialchars($profile['phone_number'] ?? ''); ?>">
        </div>
        </div>
        <div class="form-row">
            <label>Bio</label>
            <textarea name="bio"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
        </div>

        <div class="form-row">
            <label>Country</label>
            <input type="text" name="country"
                value="<?php echo htmlspecialchars($profile['country'] ?? ''); ?>">
        </div>
        <!-- SUBMIT -->
        <button type="submit" name="update_settings" class="btn primary">
            Save Changes
        </button>

    </div>
    </form>
</div>

<!-- =========================
     IMAGE PREVIEW SCRIPT
========================= -->
<script>
document.getElementById("profileImageInput").addEventListener("change", function(e){
    const file = e.target.files[0];

    if(file){
        // Validate file size
        if(file.size > 2 * 1024 * 1024){
            alert("File size must be less than 2MB");
            this.value = '';
            return;
        }
        
        const reader = new FileReader();

        reader.onload = function(event){
            document.getElementById("profilePreview").src = event.target.result;
        };

        reader.readAsDataURL(file);
    }
});
</script>
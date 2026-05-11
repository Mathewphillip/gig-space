<?php
include('config/init.php');
include('config/db_config.php');
if(isset($_SESSION['user_id'])){
    $header_user_id = $_SESSION['user_id'];
    // Fetch user profile image
    $header_profile_query = "SELECT profile_image FROM profiles WHERE user_id = $header_user_id LIMIT 1";
    $header_profile_result = mysqli_query($conn, $header_profile_query);
    $header_profile = mysqli_fetch_assoc($header_profile_result);
    // Set profile image path
    $header_image_path = "images/default_image.jpg"; 
    if($header_profile && !empty($header_profile['profile_image'])){
        $full_image_path = dirname(__DIR__) . "/dashboards/uploads/profile/" . $header_profile['profile_image'];
        if(file_exists($full_image_path)){
            $header_image_path = "dashboards/uploads/profile/" . $header_profile['profile_image'];
        }
    }
}
?>
<div class="header">
    <div class="header-container">
        <div class="logo">
            <img src="images/gigspace.png" alt="gigSpace logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.php" class="active">home</a></li>
                <li><a href="hire.php">hire a freelancer</a></li>
                <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['client'])): ?>
                <li><a href="freelancers.php">browse freelancers</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['freelancer'])): ?>
                <li><a href="projects.php">browse projects</a></li>
                <?php endif; ?>
                <li><a href="start.php">start freelancing</a></li>
                <li><a href="how-it-works.php">how it works</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="dashboards/dashboard.php">dashboard</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php if(isset($_SESSION['user_id'])): ?>
        <div class="header-account">
            <div class="user-info-header">
                <img src="<?php echo $header_image_path; ?>" alt="Profile" class="header-avatar">
                <div class="header-profile-text">
                    <small><?php echo htmlspecialchars($_SESSION['username']); ?></small> <br>
                    <small style="font-size:12px; color:gray !important;"><?php echo htmlspecialchars($_SESSION['role']); ?></small>
                </div>
            </div>
            <a href="auth/logout.php" style="color:white !important;">logout</a>
        </div>
        <?php else: ?>
        <div class="header-btn">
            <a href="components/login.php" style="color:white !important;">login</a>
        </div>
        <?php endif; ?>
        <button class="nav-toggle" aria-label="toggle navigation">
            <span class="hamburger"></span>
        </button>
    </div>
</div>

<style>
.header-account {
    display: flex;
    align-items: center;
    gap: 20px;
}

.user-info-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #6c5ce7;
}

.header-account small {
    font-size: 14px;
    font-weight: 500;
    color: #333;
}

.header-account a {
    padding: 8px 16px;
    background: #e74c3c;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s;
}

.header-account a:hover {
    background: #c0392b;
}

@media (max-width: 768px) {
    .header-avatar {
        width: 30px;
        height: 30px;
    }
    
    .user-info-header small {
        font-size: 12px;
    }
}
</style>
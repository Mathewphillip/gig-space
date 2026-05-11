<?php
include('config/init.php');
include('config/db_config.php');

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$user_id) {
    header("Location: index.php");
    exit();
}

// Fetch freelancer data
$q = "SELECT u.id AS user_id,u.username,u.email,u.role,p.full_name,p.profile_image,p.bio,p.country,fp.id AS freelancer_id,fp.title,fp.experience_level,fp.rating,fp.total_reviews,fp.completed_orders FROM users u JOIN freelancer_profiles fp ON u.id = fp.user_id LEFT JOIN profiles p ON u.id = p.user_id WHERE u.id = $user_id AND u.role IN ('freelancer', 'both') AND u.is_active = 1 LIMIT 1 ";
$res = mysqli_query($conn, $q);
$freelancer = mysqli_fetch_assoc($res);

if (!$freelancer) {
    $not_found = true;
} else {
    $freelancer_id = $freelancer['freelancer_id'];
    
    // Profile image
    $image_path = 'images/default_image.jpg';
    if (!empty($freelancer['profile_image'])) {
        $upload_path = __DIR__ . '/dashboards/uploads/profile/' . $freelancer['profile_image'];
        if (file_exists($upload_path)) {
            $image_path = 'dashboards/uploads/profile/' . $freelancer['profile_image'];
        }
    }

    // Skills
    $skills = [];
    $skills_q = mysqli_query($conn, "SELECT s.name FROM skills s JOIN freelancer_skills fs ON s.id = fs.skill_id WHERE fs.freelancer_id = $freelancer_id ORDER BY s.name ASC ");
    while ($s = mysqli_fetch_assoc($skills_q)) {
        $skills[] = $s['name'];
    }
    // Completed Orders count (status = 'completed')
    $completed_orders_count_res = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS completed_count " .
        "FROM orders " .
        "WHERE freelancer_id = " . (int)$freelancer_id . " AND status = 'completed'"
    );

    $completed_orders_count = 0;
    if ($completed_orders_count_res) {
        $row = mysqli_fetch_assoc($completed_orders_count_res);
        $completed_orders_count = (int)($row['completed_count'] ?? 0);
    }

    $gigs = mysqli_query($conn, " SELECT g.*, c.name AS category_name FROM gigs g LEFT JOIN categories c ON g.category_id = c.id WHERE g.freelancer_id = $freelancer_id AND g.status = 'active' ORDER BY g.created_at DESC ");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($freelancer['full_name'] ?? $freelancer['username'] ?? 'Freelancer'); ?> | gigSpace</title>
    <?php include('assets/styling.php'); ?>
    
</head>
<body>
    <?php include('templates/header.php'); ?>
    <main>
        <?php if (isset($not_found) && $not_found): ?>
            <div class="no-results" >
                <h2>Freelancer not found</h2>
                <p>The freelancer you are looking for does not exist or is no longer active.</p>
                <a href="index.php" class="profile-btn">Back to Home</a>
            </div>
        <?php else: ?>
        <div class="view-profile-page">
            <div class="profile-header">
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($freelancer['full_name'] ?? $freelancer['username']); ?>">
                </div>
                <div class="profile-info">
                    <h1 style="text-transform: capitalize;"><?php echo htmlspecialchars($freelancer['full_name'] ?? $freelancer['username']); ?></h1>
                    <h2 style="text-transform: capitalize;"><?php echo htmlspecialchars($freelancer['title'] ?? 'Freelancer'); ?></h2>
                    <p>
                        <i class="fas fa-user"></i> @<?php echo htmlspecialchars($freelancer['username']); ?>
                        <?php if ($freelancer['country']): ?>
                            &nbsp;|&nbsp; <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($freelancer['country']); ?>
                        <?php endif; ?>
                        <?php if ($freelancer['experience_level']): ?>
                            &nbsp;|&nbsp; <i class="fas fa-layer-group"></i> <?php echo ucfirst($freelancer['experience_level']); ?>
                        <?php endif; ?>
                    </p>
                    <?php if ($freelancer['rating'] > 0): ?>
                    <p>
                        <span class="star-rating"><?php echo str_repeat('★', round($freelancer['rating'])); ?></span>
                        <strong><?php echo number_format($freelancer['rating'], 1); ?></strong>
                        <span>(<?php echo $freelancer['total_reviews']; ?> reviews)</span>
                        &nbsp;|&nbsp;
                        <span><?php echo $freelancer['completed_orders']; ?> completed orders</span>
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-content">
                <!-- Main Column -->
                <div class="profile-main">
                    <?php if (!empty($freelancer['bio'])): ?>
                        <h3>About</h3>
                        <p><?php echo nl2br(htmlspecialchars($freelancer['bio'])); ?></p>
                    <?php endif; ?>

                    <h3 class="section-title">Active Gigs</h3>
                    <?php if (mysqli_num_rows($gigs) > 0): ?>
                        <div class="gigs-grid">
                            <?php while ($g = mysqli_fetch_assoc($gigs)): 
                                $img_q = mysqli_query($conn, "SELECT image_url FROM gig_images WHERE gig_id=" . (int)$g['id'] . " LIMIT 1");
                                $img = mysqli_fetch_assoc($img_q);
                                $gig_img = 'dashboards/freelancer/gig_default.png';
                                if ($img && $img['image_url']) {
                                    $gig_img = 'dashboards/uploads/' . $img['image_url'];
                                }
                                $short_desc = strlen($g['description']) > 120 ? substr($g['description'], 0, 120) . '...' : $g['description'];
                            ?>
                            <div class="gig-card">
                                <img src="<?php echo $gig_img; ?>" alt="<?php echo htmlspecialchars($g['title']); ?>">
                                <div class="gig-body">
                                    <div class="gig-header">
                                        <h4><?php echo htmlspecialchars($g['title']); ?></h4>
                                    </div>
                                    <p class="gig-description"><?php echo htmlspecialchars($short_desc); ?></p>
                                    <div class="gig-meta">
                                        <small><?php echo htmlspecialchars($g['category_name'] ?? 'General'); ?></small>
                                        <small>Delivery: <?php echo (int)$g['delivery_time']; ?> days</small>
                                    </div>
                                    <div class="gig-price">$<?php echo number_format($g['price'], 2); ?></div>
                                    <div class="gig-actions">
                                        <a href="order.php?gig_id=<?php echo (int)$g['id']; ?>" class="gig-btn success">Order Now</a>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>No active gigs at the moment.</p>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="profile-sidebar">
                    <h3>Skills</h3>
                    <?php if (count($skills) > 0): ?>
                        <ul class="skills-list">
                            <?php foreach ($skills as $skill): ?>
                                <li><?php echo htmlspecialchars($skill); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No skills listed.</p>
                    <?php endif; ?>

                    <h3 style="margin-top:30px;">Stats</h3>
                    <p><strong>Completed Orders:</strong> <?php echo (int)$completed_orders_count; ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>
    <?php include('templates/footer.php'); ?>
</body>
</html>


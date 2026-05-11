<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | home</title>
</head>
<body>
    <?php include('config/init.php'); ?>
    <?php include('config/db_config.php'); ?>
    <?php include('assets/styling.php'); ?>
    <?php include('templates/header.php');?>

    <?php
    // Fetch featured freelancers from database
    $freelancers_query = "
        SELECT 
            u.id AS user_id,
            p.full_name,
            p.profile_image,
            fp.title,
            fp.rating,
            fp.total_reviews
        FROM users u
        JOIN freelancer_profiles fp ON u.id = fp.user_id
        LEFT JOIN profiles p ON u.id = p.user_id
        WHERE u.role IN ('freelancer', 'both') 
          AND u.is_active = 1
        ORDER BY fp.rating DESC, fp.completed_orders DESC
        LIMIT 5
    ";
    $freelancers_result = mysqli_query($conn, $freelancers_query);
    $freelancers_count = ($freelancers_result) ? mysqli_num_rows($freelancers_result) : 0;
    ?>

     <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Find the perfect freelance services for your business online</h1>
               <div class="hero-buttons">
                    <a href="hire.php" style="color:white !important;">Hire freelancer</a>
                    <a href="start.php" class="bordered" style="color:white !important;">Earn While Freelancing</a>
               </div>
               </div>
            </div>
            <video src="images/background.MP4" autoplay muted loop class="background-video"></video>
        </section>

        <section class="categories">
            <h2>Popular Services</h2>
            <div class="category-container">
                <div class="category-card">
                    <img src="images/graphics.jpeg" alt="graphics" class="category-image">
                    <h3>Graphics & Design</h3>
                </div>
                <div class="category-card">
                    <img src="images/digital marketing.jpeg" alt="graphics" class="category-image">
                    <h3>Digital Marketing</h3>
                </div>
                <div class="category-card">
                     <img src="images/translation.jpeg" alt="graphics" class="category-image">
                    <h3>Writing & Translation</h3>
                </div>
                <div class="category-card">
                    <img src="images/web.jpeg" alt="programming" class="category-image">
                    <h3>Programming & Tech</h3>
                </div>
                  <div class="category-card">
                    <img src="images/figma.jpeg" alt="figma" class="category-image">
                    <h3>Figma Design</h3>
                </div>
        </section>
        <?php if($freelancers_count > 0): ?>
        <section class="featured-freelancers">
            <h2>Featured Freelancers</h2>
            <div class="freelancer-container">
                <?php while($freelancer = mysqli_fetch_assoc($freelancers_result)): ?>
                    <?php
                    // Determine profile image path
                    $image_path = 'images/default_image.jpg';
                    if(!empty($freelancer['profile_image'])){
                        $upload_path = __DIR__ . '/dashboards/uploads/profile/' . $freelancer['profile_image'];
                        if(file_exists($upload_path)){
                            $image_path = 'dashboards/uploads/profile/' . $freelancer['profile_image'];
                        }
                    }
                    ?>
                    <div class="freelancer-card">
                        <div class="freelancer-photo">
                            <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($freelancer['full_name'] ?? $freelancer['title']); ?>">
                        </div>
                        <h3 style="text-transform: capitalize; font-size:16px; "><?php echo htmlspecialchars($freelancer['full_name'] ?? 'Freelancer'); ?></h3>
                        <p style="text-transform: capitalize;"><?php echo htmlspecialchars($freelancer['title'] ?? 'Freelancer'); ?></p>
                        <?php if($freelancer['rating'] > 0): ?>
                            <div class="freelancer-rating">
                                <span class="stars"><?php echo str_repeat('★', round($freelancer['rating'])); ?></span>
                                <span class="rating-number"><?php echo number_format($freelancer['rating'], 1); ?></span>
                                <span class="reviews">(<?php echo $freelancer['total_reviews']; ?> reviews)</span>
                            </div>
                        <?php endif; ?>
                        <a href="view_freelancer.php?id=<?php echo (int)$freelancer['user_id']; ?>" class="profile-link">View Profile</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
    </main>
    <?php include('templates/footer.php');?>
</body>
</html>

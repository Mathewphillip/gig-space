<?php
$user_id = $_SESSION['user_id'];

$gigs = mysqli_query($conn, "
    SELECT 
        gigs.*,
        users.username AS freelancer_name,
        categories.name AS category_name
    FROM gigs
    JOIN freelancer_profiles ON gigs.freelancer_id = freelancer_profiles.id
    JOIN users ON freelancer_profiles.user_id = users.id
    JOIN categories ON gigs.category_id = categories.id
    WHERE gigs.status = 'active'
    ORDER BY gigs.created_at DESC
");
?>

<div class="panel">
    <div class="panel-header">
        <h3>Marketplace Gigs</h3>
    </div>

    <?php if(mysqli_num_rows($gigs) > 0): ?>
        <div class="gigs-grid">
            <?php while($g = mysqli_fetch_assoc($gigs)):
                $img_q = mysqli_query($conn, "SELECT image_url FROM gig_images WHERE gig_id=" . $g['id'] . " LIMIT 1");
                $img = mysqli_fetch_assoc($img_q);
                $image = "./freelancer/gig_default.png";
                if ($img && $img['image_url']) {
                    $image = "./uploads/" . $img['image_url'];
                }
                $short_desc = strlen($g['description']) > 120 ? substr($g['description'], 0, 120) . '...' : $g['description'];
            ?>
                <div class="gig-card">
                    <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($g['title']); ?>">
                    <div class="gig-body">
                        <div class="gig-header">
                            <h4><?php echo htmlspecialchars($g['title']); ?></h4>
                            <div class="gig-status status-active">Active</div>
                        </div>
                        <p class="gig-description"><?php echo htmlspecialchars($short_desc); ?></p>
                        <div class="gig-meta">
                            <small>By: <?php echo htmlspecialchars($g['freelancer_name']); ?></small>
                            <small><?php echo htmlspecialchars($g['category_name']); ?></small>
                        </div>
                        <div class="gig-meta">
                            <small>Delivery: <?php echo $g['delivery_time']; ?> days</small>
                            <small>Revisions: <?php echo $g['revisions']; ?></small>
                        </div>
                        <div class="gig-price">$<?php echo number_format($g['price'], 2); ?></div>
                        <div class="gig-actions">
                            <a href="../order.php?gig_id=<?php echo $g['id']; ?>" class="gig-btn success" style="text-decoration:none; text-align:center;">Order Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No gigs available at the moment. Check back later!</p>
    <?php endif; ?>
</div>


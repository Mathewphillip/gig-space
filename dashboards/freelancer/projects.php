<?php
$user_id = $_SESSION['user_id'];

// Get freelancer id
$freelancer_q = mysqli_query($conn, "SELECT id FROM freelancer_profiles WHERE user_id = $user_id LIMIT 1");
$freelancer = mysqli_fetch_assoc($freelancer_q);
$freelancer_id = $freelancer ? $freelancer['id'] : 0;

// Fetch all OPEN projects
$open_projects = mysqli_query($conn, "
    SELECT 
        projects.*,
        categories.name AS category_name,
        users.username AS client_username,
        profiles.full_name AS client_name,
        profiles.profile_image AS client_image
    FROM projects
    LEFT JOIN categories ON projects.category_id = categories.id
    JOIN users ON projects.client_id = users.id
    LEFT JOIN profiles ON users.id = profiles.user_id
    WHERE projects.status = 'open'
    ORDER BY projects.created_at DESC
");

// Fetch freelancer's bids
$my_bids = [];
if ($freelancer_id) {
    $bids_q = mysqli_query($conn, "
        SELECT 
            bids.*,
            projects.title AS project_title,
            projects.status AS project_status,
            projects.client_id
        FROM bids
        JOIN projects ON bids.project_id = projects.id
        WHERE bids.freelancer_id = $freelancer_id
        ORDER BY bids.created_at DESC
    ");
    while ($b = mysqli_fetch_assoc($bids_q)) {
        $my_bids[] = $b;
    }
}

// View single project details
$view_project_id = isset($_GET['view_project']) ? (int)$_GET['view_project'] : 0;
$view_project = null;
$already_bid = false;

if ($view_project_id > 0 && $freelancer_id) {
    $vp_q = mysqli_query($conn, "
        SELECT 
            projects.*,
            categories.name AS category_name,
            users.username AS client_username,
            profiles.full_name AS client_name,
            profiles.profile_image AS client_image
        FROM projects
        LEFT JOIN categories ON projects.category_id = categories.id
        JOIN users ON projects.client_id = users.id
        LEFT JOIN profiles ON users.id = profiles.user_id
        WHERE projects.id = $view_project_id AND projects.status = 'open'
        LIMIT 1
    ");
    $view_project = mysqli_fetch_assoc($vp_q);

    if ($view_project && $freelancer_id) {
        $check_bid = mysqli_query($conn, "SELECT id FROM bids WHERE project_id = $view_project_id AND freelancer_id = $freelancer_id LIMIT 1");
        $already_bid = mysqli_num_rows($check_bid) > 0;
    }
}
?>

<?php include('freelancerStyle.php'); ?>
<div class="projects-layout">
    <!-- LEFT: My Bids -->
    <div class="projects-left">
        <div class="freelancer-panel">
            <div class="panel-header">
                <h3>My Bids</h3>
                <a href="#" class="view-all">View All</a>
            </div>

            <?php if (isset($_GET['bid_success'])): ?>
                <p style="color: #059669; margin-bottom: 15px;"> Bid placed successfully!</p>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <p style="color: #ef4444; margin-bottom: 15px;"> <?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <!-- VIEW SINGLE PROJECT FOR BIDDING -->
            <?php if ($view_project): ?>
                <div class="project" style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                        <img src="<?php echo !empty($view_project['client_image']) ? 'uploads/profile/' . $view_project['client_image'] : 'default_image.jpg'; ?>"
                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #4f46e5;">
                        <div>
                            <h4><?php echo htmlspecialchars($view_project['title']); ?></h4>
                            <p style="font-size: 12px; color: #666;">Posted by <?php echo htmlspecialchars($view_project['client_name'] ?? $view_project['client_username']); ?> •
                                <?php echo htmlspecialchars($view_project['category_name'] ?? 'General'); ?></p>
                        </div>
                        <div style="margin-left: auto; text-align: right;">
                            <h3 style="color: #4f46e5;">$<?php echo($view_project['budget_min']); ?> - $<?php echo($view_project['budget_max']); ?></h3>
                            <?php if ($view_project['deadline']): ?>
                                <small>Deadline: <?php echo date('M d, Y', strtotime($view_project['deadline'])); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <p style="font-size: 14px; color: #444; line-height: 1.6; margin-bottom: 15px;"><?php echo nl2br(htmlspecialchars($view_project['description'])); ?></p>

                    <?php if ($already_bid): ?>
                        <div style="background: #dbeafe; padding: 12px; border-radius: 8px; color: #1e40af;">
                            You have already placed a bid on this project.
                        </div>
                    <?php elseif ($freelancer_id): ?>
                        <form method="POST" action="../process/place_bid.php" class="bid-form">
                            <h4 style="margin-bottom: 20px; color: #1e293b;">Place Your Bid</h4>
                            <div class="bid-price-row">
                                <div class="form-group">
                                    <label>Your Bid Amount</label>
                                    <div class="input-group">
                                        <span class="currency">$</span>
                                        <input type="number" name="amount" placeholder="0.00" step="0.01" min="1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Delivery Time</label>
                                    <div class="input-group">
                                        <input type="number" name="delivery_time" placeholder="7" min="1" required>
                                        <span class="unit">days</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Your Proposal</label>
                                <textarea name="proposal" placeholder="Tell the client why you're perfect for this project. Explain your approach, timeline, and what makes you stand out..." required rows="6"></textarea>
                                <small style="color: #6b7280;">Be specific about how you'll deliver results</small>
                            </div>
                            <input type="hidden" name="project_id" value="<?php echo $view_project['id']; ?>">
                            <button type="submit" name="place_bid" class="btn primary full bid-submit-btn">
                                <i class="fas fa-paper-plane"></i>
                                Submit Your Bid
                            </button>
                        </form>

                    <?php else: ?>
                        <p style="color: #ef4444;">You need to complete your freelancer profile to place bids.</p>
                    <?php endif; ?>
                    <a href="?section=projects" class="order-btn" style="display: inline-block; margin-top: 15px; text-decoration: none;">Back to Projects</a>
                </div>
            <?php endif; ?>
            <!-- MY BIDS SECTION -->
            <?php if (count($my_bids) > 0): ?>
                <h4 style="margin: 20px 0 15px;">My Bids</h4>
                <div class="orders-list" style="margin-bottom: 25px;">
                    <?php foreach ($my_bids as $b): ?>
                        <div class="order-card">
                            <div class="order-left">
                                <h4><?php echo htmlspecialchars($b['project_title']); ?></h4>
                                <p>$<?php echo($b['amount']); ?> <br> <?php echo $b['delivery_time']; ?> days</p>
                                <small>Bid placed  &nbsp; <?php echo date('M d, Y', strtotime($b['created_at'])); ?></small>
                            </div>
                            <div class="order-middle">
                                <span class="status <?php echo $b['status']; ?>">
                                    <?php echo ucfirst($b['status']); ?>
                                </span>
                            </div>
                            <div class="order-right">
                                <span class="status <?php echo $b['project_status']; ?>" style="font-size: 11px; width: max-content; margin-inline: 10px;">
                                    Project: <?php echo ucfirst($b['project_status']); ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <!-- RIGHT: Open Projects -->
    <div class="projects-right">
        <div class="freelancer-panel">
            <div class="panel-header">
                <h3>Open Projects</h3>
                <a href="" class="view-all">Refresh</a>
            </div>

            <?php if (mysqli_num_rows($open_projects) > 0): ?>
                <?php mysqli_data_seek($open_projects, 0);
                while ($p = mysqli_fetch_assoc($open_projects)): ?>
                    <div class="order-card">
                        <div class="order-left">
                            <h4><?php echo htmlspecialchars($p['title']); ?></h4>
                            <p><?php echo htmlspecialchars($p['category_name'] ?? 'General'); ?> <br> Posted by <?php echo htmlspecialchars($p['client_name'] ?? $p['client_username']); ?></p>
                            <small>Budget: $<?php echo number_format($p['budget_min'], 2); ?> - $<?php echo number_format($p['budget_max'], 2); ?></small>
                        </div>
                        <div class="order-middle">
                            <?php if ($p['deadline']): ?>
                                <small>Due: <?php echo date('M d', strtotime($p['deadline'])); ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="order-right">
                            <a href="?section=projects&view_project=<?php echo $p['id']; ?>" class="order-btn" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Bid Now</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <p>No open projects available right now. Check back later!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
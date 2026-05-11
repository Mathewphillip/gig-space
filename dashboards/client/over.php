<?php

// Ensure DB connection exists even if this widget is included without init.php
require_once('../config/db_config.php');
require_once('../config/init.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../../dashboards/client.php?error=" . urlencode("Please login first."));
    exit();
}

// profile
$profile_query = "
    SELECT users.username, users.email, users.role,
           profiles.full_name, profiles.profile_image
    FROM users
    LEFT JOIN profiles ON users.id = profiles.user_id
    WHERE users.id = $user_id
    LIMIT 1
";
$profile_result = mysqli_query($conn, $profile_query);
$profile = mysqli_fetch_assoc($profile_result);

// orders stats
$total_orders_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE client_id = $user_id");
$total_orders = mysqli_fetch_assoc($total_orders_q)['total'] ?? 0;

$active_orders_q = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM orders 
    WHERE client_id = $user_id 
    AND status IN ('pending','accepted','in_progress')
");
$active_orders = mysqli_fetch_assoc($active_orders_q)['total'] ?? 0;

$total_spent_q = mysqli_query($conn, "
    SELECT SUM(total_price) AS total 
    FROM orders 
    WHERE client_id = $user_id 
    AND status = 'completed'
");
$total_spent = mysqli_fetch_assoc($total_spent_q)['total'] ?? 0;

// projects stats
$total_projects_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM projects WHERE client_id = $user_id");
$total_projects = mysqli_fetch_assoc($total_projects_q)['total'] ?? 0;

$open_projects_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM projects WHERE client_id = $user_id AND status = 'open'");
$open_projects = mysqli_fetch_assoc($open_projects_q)['total'] ?? 0;

$total_bids_received_q = mysqli_query($conn, "
    SELECT COUNT(*) AS total FROM bids 
    JOIN projects ON bids.project_id = projects.id 
    WHERE projects.client_id = $user_id
");
$total_bids_received = mysqli_fetch_assoc($total_bids_received_q)['total'] ?? 0;

// recent orders
$recent_orders = mysqli_query($conn, "
    SELECT orders.*, gigs.title AS gig_title, users.username AS freelancer_name
    FROM orders
    JOIN gigs ON orders.gig_id = gigs.id
    JOIN freelancer_profiles ON orders.freelancer_id = freelancer_profiles.id
    JOIN users ON freelancer_profiles.user_id = users.id
    WHERE orders.client_id = $user_id
    ORDER BY orders.created_at DESC
    LIMIT 3
");

// recommended gigs
$recommended_gigs = mysqli_query($conn, "
    SELECT gigs.*, users.username AS freelancer_name, categories.name AS category_name
    FROM gigs
    JOIN freelancer_profiles ON gigs.freelancer_id = freelancer_profiles.id
    JOIN users ON freelancer_profiles.user_id = users.id
    JOIN categories ON gigs.category_id = categories.id
    WHERE gigs.status = 'active'
    ORDER BY gigs.created_at DESC
    LIMIT 3
");

$messages = mysqli_query($conn, "
    SELECT messages.*, users.username 
    FROM messages
    JOIN users ON messages.sender_id = users.id
    WHERE messages.conversation_id IN (
        SELECT conversations.id FROM conversations
        JOIN orders ON conversations.order_id = orders.id
        WHERE orders.client_id = $user_id
    )
    AND messages.sender_id != $user_id
    ORDER BY messages.created_at DESC
    LIMIT 2
");
?>
<div class="panel overview-panel">
    <div class="stats-grid">
        <div class="stat-card">
            <h4>Total Orders</h4>
            <h2><?php echo $total_orders; ?></h2>
        </div>
        <div class="stat-card">
            <h4>Active Orders</h4>
            <h2><?php echo $active_orders; ?></h2>
        </div>

        <div class="stat-card">
            <h4>Total Spent</h4>
            <h2>$<?php echo ($total_spent); ?></h2>
        </div>

        <div class="stat-card">
            <h4>My Projects</h4>
            <h2><?php echo $total_projects; ?></h2>
        </div>

        <div class="stat-card">
            <h4>Open Projects</h4>
            <h2><?php echo $open_projects; ?></h2>
        </div>

        <div class="stat-card">
            <h4>Bids Received</h4>
            <h2><?php echo $total_bids_received; ?></h2>
        </div>
    </div>

    <!-- content -->
    <div class="content-grid">
        <!-- LEFT SIDE -->
        <div>
            <!-- PROFILE CARD -->
            <div class="panel profile-card">
                <h3>My Profile</h3>
                <div class="profile-box">
                    <div class="profile-left">
                        <img src="<?php echo !empty($profile['profile_image'])
                                        ? '../dashboards/uploads/profile/' . $profile['profile_image']
                                        : './default_image.jpg'; ?>"
                            alt="Profile Image">
                    </div>
                    <div class="profile-right">
                        <p class="fullname"><?php echo $profile['full_name'] ?? $profile['username']; ?></p>
                        <p class="username">@<?php echo $profile['username']; ?></p>
                        <p class="email"><?php echo $profile['email']; ?></p>
                        <small class="role-badge client">
                            <?php echo ucfirst($profile['role']); ?>
                        </small>
                    </div>
                </div>
            </div>

            <!-- RECENT ORDERS -->
            <div class="panel orders-panel">
                <h3>My Orders</h3>

                <?php if (mysqli_num_rows($recent_orders) > 0): ?>
                    <?php while ($order = mysqli_fetch_assoc($recent_orders)): ?>
                        <div class="order-card">
                            <div class="order-left">
                                <h4><?php echo htmlspecialchars($order['gig_title']); ?></h4>
                                <p>Freelancer: <?php echo htmlspecialchars($order['freelancer_name']); ?></p>
                                <small>$<?php echo $order['total_price']; ?> • Ordered <?php echo date('M d', strtotime($order['created_at'])); ?></small>
                            </div>
                            <div class="order-middle">
                                <span class="status <?php echo $order['status']; ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $order['status'])); ?>
                                </span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>You have no orders yet.</p>
                <?php endif; ?>
            </div>

            <!-- RECOMMENDED GIGS -->
            <div class="panel">
                <h3>Recommended Gigs</h3>
                <?php if (mysqli_num_rows($recommended_gigs) > 0): ?>
                    <?php while ($gig = mysqli_fetch_assoc($recommended_gigs)): ?>
                        <div class="gig">
                            <span><?php echo htmlspecialchars($gig['title']); ?> — by <?php echo htmlspecialchars($gig['freelancer_name']); ?></span>
                            <span>$<?php echo number_format($gig['price'], 2); ?></span>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No gigs available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div>
            <!-- QUICK ACTIONS -->
            <div class="actions">
                <button class="btn" onclick="document.querySelector('[data-target=\'gigs\']').click();">Browse Gigs</button>
                <button class="btn" onclick="document.querySelector('[data-target=\'projects\']').click();">My Projects</button>
                <button class="btn" onclick="document.querySelector('[data-target=\'orders\']').click();">My Orders</button>
                <button class="btn" onclick="document.querySelector('[data-target=\'messages\']').click();">Messages</button>
            </div>
        </div>

        <!-- ACTIVITY -->
        <div class="panel">
            <h3>Activity</h3>
            <div class="activity">✔ Welcome to your client dashboard</div>
            <div class="activity">✔ Browse gigs and place orders</div>
            <div class="activity">✔ Track your order progress</div>
            <div class="activity">✔ Message freelancers directly</div>
        </div>

        <!-- MESSAGES -->
        <div class="panel">
            <h3>Messages</h3>
            <?php if (mysqli_num_rows($messages) > 0): ?>
                <?php while ($msg = mysqli_fetch_assoc($messages)): ?>
                    <div class="message">
                        <?php echo htmlspecialchars($msg['username']); ?>:
                        <?php echo htmlspecialchars($msg['message']); ?>
                        <br><small><?php echo $msg['created_at']; ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No messages yet.</p>
            <?php endif; ?>
        </div>

    </div>

</div>
</div>
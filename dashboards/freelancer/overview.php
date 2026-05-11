<?php

$user_id = $_SESSION['user_id'];

/* =========================
   GET FREELANCER ID
========================= */
$freelancer_query = "SELECT id FROM freelancer_profiles WHERE user_id = $user_id LIMIT 1";
$freelancer_result = mysqli_query($conn, $freelancer_query);
$freelancer = mysqli_fetch_assoc($freelancer_result);

$freelancer_id = $freelancer['id'] ?? null;

/* If not freelancer */
if(!$freelancer_id){
    echo "<p>You are not registered as a freelancer.</p>";
    return;
}
// getting profile details
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

/* =========================
   STATS
========================= */

// Total Gigs
$gigs_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM gigs WHERE freelancer_id = $freelancer_id");
$total_gigs = mysqli_fetch_assoc($gigs_q)['total'] ?? 0;

// Active Orders
$active_q = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM orders 
    WHERE freelancer_id = $freelancer_id 
    AND status IN ('pending','accepted','in_progress')
");
$active_orders = mysqli_fetch_assoc($active_q)['total'] ?? 0;

// Completed Orders
$completed_q = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM orders 
    WHERE freelancer_id = $freelancer_id 
    AND status = 'completed'
");
$completed_orders = mysqli_fetch_assoc($completed_q)['total'] ?? 0;

// Earnings
$earnings_q = mysqli_query($conn, "
    SELECT SUM(total_price) AS total 
    FROM orders 
    WHERE freelancer_id = $freelancer_id 
    AND status = 'completed'
");
$earnings = mysqli_fetch_assoc($earnings_q)['total'] ?? 0;

/* =========================
   BIDDING STATS
========================= */
$bids_placed_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bids WHERE freelancer_id = $freelancer_id");
$bids_placed = mysqli_fetch_assoc($bids_placed_q)['total'] ?? 0;

$bids_accepted_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bids WHERE freelancer_id = $freelancer_id AND status = 'accepted'");
$bids_accepted = mysqli_fetch_assoc($bids_accepted_q)['total'] ?? 0;

$active_bids_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bids WHERE freelancer_id = $freelancer_id AND status = 'pending'");
$active_bids = mysqli_fetch_assoc($active_bids_q)['total'] ?? 0;

/* =========================
   ACTIVE GIGS
========================= */
$active_gigs = mysqli_query($conn, "
    SELECT * FROM gigs 
    WHERE freelancer_id = $freelancer_id 
    AND status = 'active'
    ORDER BY created_at DESC
    LIMIT 3
");

/* =========================
   RECENT ORDERS
========================= */
$recent_orders = mysqli_query($conn, "
    SELECT orders.*, users.username 
    FROM orders
    JOIN users ON orders.client_id = users.id
    WHERE orders.freelancer_id = $freelancer_id
    ORDER BY orders.created_at DESC
    LIMIT 3
");

/* =========================
   RECENT MESSAGES
========================= */
$messages = mysqli_query($conn, "
    SELECT messages.*, users.username 
    FROM messages
    JOIN users ON messages.sender_id = users.id
    WHERE messages.sender_id != $user_id
    ORDER BY messages.created_at DESC
    LIMIT 2
");
?>

<!-- =========================
     STATS SECTION
========================= -->
<div class="stats-grid">

    <div class="stat-card">
        <h4>Total Gigs</h4>
        <h2><?php echo $total_gigs; ?></h2>
    </div>

    <div class="stat-card">
        <h4>Active Orders</h4>
        <h2><?php echo $active_orders; ?></h2>
    </div>

    <div class="stat-card">
        <h4>Completed Orders</h4>
        <h2><?php echo $completed_orders; ?></h2>
    </div>

    <div class="stat-card">
        <h4>Earnings</h4>
        <h2>$<?php echo number_format($earnings, 2); ?></h2>
    </div>

    <div class="stat-card">
        <h4>Bids Placed</h4>
        <h2><?php echo $bids_placed; ?></h2>
    </div>

    <div class="stat-card">
        <h4>Active Bids</h4>
        <h2><?php echo $active_bids; ?></h2>
    </div>

    <div class="stat-card">
        <h4>Bids Won</h4>
        <h2><?php echo $bids_accepted; ?></h2>
    </div>

</div>

<!-- =========================
     MAIN GRID
========================= -->
<div class="content-grid">

    <!-- LEFT SIDE -->
    <div>
        <div class="panel profile-card">

    <h3>My Profile</h3>

    <div class="profile-box">

        <!-- LEFT: IMAGE -->
        <div class="profile-left">
            <img src="<?php echo !empty($profile['profile_image']) 
                ? '../dashboards/uploads/profile/' . $profile['profile_image']
                : './default_image.jpg'; ?> "
                alt="Profile Image">
        </div>

        <!-- RIGHT: INFO -->
        <div class="profile-right">

            <p class="fullname"><?php echo $profile['full_name'] ?? $profile['username']; ?></p>
            <p class="username">@<?php echo $profile['username']; ?></p>
            <p class="email"><?php echo $profile['email']; ?></p>
            <small class="role-badge">
                <?php echo ucfirst($profile['role']); ?>
            </small>
        </div>

    </div>

</div>
        <!-- ACTIVE GIGS -->
        <div class="panel">
            <h3>Active Gigs</h3>

            <?php if(mysqli_num_rows($active_gigs) > 0): ?>
                <?php while($gig = mysqli_fetch_assoc($active_gigs)): ?>
                    <div class="gig">
                        <span><?php echo htmlspecialchars($gig['title']); ?></span>
                        <span><?php echo ucfirst($gig['status']); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No active gigs yet.</p>
            <?php endif; ?>

        </div>

        <!-- RECENT ORDERS -->
        <div class="panel">
            <h3>Recent Orders</h3>

            <?php if(mysqli_num_rows($recent_orders) > 0): ?>
                <?php while($order = mysqli_fetch_assoc($recent_orders)): ?>
                    <div class="gig">
                        <span>Client: <?php echo htmlspecialchars($order['username']); ?></span>
                        <span><?php echo ucfirst($order['status']); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No orders yet.</p>
            <?php endif; ?>

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div>

        <!-- ACTIVITY FEED (STATIC FOR NOW) -->
        <div class="panel">
            <h3>Activity</h3>

            <div class="activity">✔ New order received</div>
            <div class="activity">✔ Gig approved</div>
            <div class="activity">✔ Payment received</div>
            <div class="activity">✔ New message from client</div>

        </div>

        <!-- MESSAGES -->
        <div class="panel">
            <h3>Messages</h3>

            <?php if(mysqli_num_rows($messages) > 0): ?>
                <?php while($msg = mysqli_fetch_assoc($messages)): ?>
                    <div class="message">
                        <?php echo $msg['username']; ?>:
                        <?php echo htmlspecialchars($msg['message']); ?>
                        <br>
                        <small><?php echo $msg['created_at']; ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No messages yet.</p>
            <?php endif; ?>

        </div>

        <!-- EARNINGS BOX -->
        <div class="panel earnings">
            <h3>Total Earnings</h3>
            <h2>$<?php echo number_format($earnings, 2); ?></h2>
            <p>Based on completed orders</p>
        </div>

    </div>

</div>
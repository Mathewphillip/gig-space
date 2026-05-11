<?php
require_once('../../config/db_config.php');
require_once('../../config/init.php');

$user_id = $_SESSION['user_id'];


// Client stats - no freelancer_id needed
/* =========================
   CALCULATIONS
========================= */

// total spent (completed)
$total_query = "
    SELECT SUM(total_price) AS total 
    FROM orders 
    WHERE client_id = $user_id 
    AND status = 'completed'
";
$total_result = mysqli_query($conn, $total_query);
$total_spent = (float) (mysqli_fetch_assoc($total_result)['total'] ?? 0);

// this month spent
$month_query = "
    SELECT SUM(total_price) AS total 
    FROM orders 
    WHERE client_id = $user_id 
    AND status IN ('paid', 'completed')
    AND MONTH(paid_at) = MONTH(CURRENT_DATE())
    AND YEAR(paid_at) = YEAR(CURRENT_DATE())
";
$month_result = mysqli_query($conn, $month_query);
$month_spent = (float) (mysqli_fetch_assoc($month_result)['total'] ?? 0);

// recent orders
$recent_query = "
    SELECT orders.*, gigs.title AS gig_title, users.username AS freelancer_name
    FROM orders
    JOIN gigs ON orders.gig_id = gigs.id
    JOIN freelancer_profiles ON orders.freelancer_id = freelancer_profiles.id
    JOIN users ON freelancer_profiles.user_id = users.id
    WHERE orders.client_id = $user_id
    ORDER BY orders.created_at DESC
    LIMIT 5
";
$recent_result = mysqli_query($conn, $recent_query);
?>

<div class="panel payments-panel">

    <!-- HEADER -->
    <div class="panel-header">
        <h3>Payments</h3>
    </div>

    <!-- STATS -->
    <div class="earnings-stats">

        <div class="earning-card">
            <h4>Total Spent</h4>
            <h2>$<?php echo number_format($total_spent, 2); ?></h2>
            <p>All time payments</p>
        </div>

        <div class="earning-card">
            <h4>This Month</h4>
            <h2>$<?php echo number_format($month_spent, 2); ?></h2>
            <p>Recent spending</p>
        </div>

    </div>

    <!-- RECENT -->
    <div class="transactions">
        <h3>Recent Orders</h3>

        <?php if (mysqli_num_rows($recent_result) > 0): ?>

            <?php while ($row = mysqli_fetch_assoc($recent_result)): ?>

                <div class="transaction">

                    <div>
                        <strong><?php echo htmlspecialchars($row['gig_title']); ?></strong>
                        <p>Freelancer: <?php echo htmlspecialchars($row['freelancer_name']); ?></p>
                        <p>Status: <?php echo ucfirst(str_replace('_', ' ', $row['status'])); ?></p>
                    </div>

                    <div>
                        <strong>$<?php echo number_format($row['total_price'], 2); ?></strong>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <p>No orders yet. <a href="#" onclick="document.querySelector('[data-target=" gigs"]').click();">Browse gigs</a></p>

        <?php endif; ?>
    </div>

</div>




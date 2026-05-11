<?php
$user_id = $_SESSION['user_id'];

// get freelancer id
$freelancer_query = "SELECT id FROM freelancer_profiles WHERE user_id = $user_id LIMIT 1";
$freelancer_result = mysqli_query($conn, $freelancer_query);
$freelancer = mysqli_fetch_assoc($freelancer_result);

if(!$freelancer){
    echo "<p>You are not registered as a freelancer.</p>";
    return;
}

$freelancer_id = $freelancer['id'];

/* =========================
   CALCULATIONS
========================= */

// total earnings (completed only)
$total_query = "
    SELECT SUM(total_price) AS total 
    FROM orders 
    WHERE freelancer_id = $freelancer_id 
    AND status = 'completed'
";
$total_result = mysqli_query($conn, $total_query);
$total = mysqli_fetch_assoc($total_result)['total'] ?? 0;

// this month earnings
$month_query = "
    SELECT SUM(total_price) AS total 
    FROM orders 
    WHERE freelancer_id = $freelancer_id 
    AND status = 'completed'
    AND MONTH(completed_at) = MONTH(CURRENT_DATE())
    AND YEAR(completed_at) = YEAR(CURRENT_DATE())
";
$month_result = mysqli_query($conn, $month_query);
$month_total = mysqli_fetch_assoc($month_result)['total'] ?? 0;

// active revenue (not yet completed)
$active_query = "
    SELECT SUM(total_price) AS total 
    FROM orders 
    WHERE freelancer_id = $freelancer_id 
    AND status IN ('pending','accepted','in_progress','delivered')
";
$active_result = mysqli_query($conn, $active_query);
$active_total = mysqli_fetch_assoc($active_result)['total'] ?? 0;

// recent transactions
$recent_query = "
    SELECT orders.*, gigs.title 
    FROM orders
    JOIN gigs ON orders.gig_id = gigs.id
    WHERE orders.freelancer_id = $freelancer_id
    ORDER BY orders.created_at DESC
    LIMIT 5
";
$recent_result = mysqli_query($conn, $recent_query);
?>

<div class="panel earnings-panel">

    <!-- HEADER -->
    <div class="panel-header">
        <h3>Earnings</h3>
    </div>

    <!-- STATS -->
    <div class="earnings-stats">

        <div class="earning-card">
            <h4>Total Earnings</h4>
            <h2>$<?php echo number_format($total, 2); ?></h2>
        </div>

        <div class="earning-card">
            <h4>This Month</h4>
            <h2>$<?php echo number_format($month_total, 2); ?></h2>
        </div>

        <div class="earning-card">
            <h4>In Progress</h4>
            <h2>$<?php echo number_format($active_total, 2); ?></h2>
        </div>

    </div>

    <!-- RECENT -->
    <div class="transactions">
        <h3>Recent Transactions</h3>

        <?php if(mysqli_num_rows($recent_result) > 0): ?>

            <?php while($row = mysqli_fetch_assoc($recent_result)): ?>

                <div class="transaction">

                    <div>
                        <strong><?php echo htmlspecialchars($row['title']); ?></strong>
                        <p>Status: <?php echo ucfirst(str_replace('_',' ', $row['status'])); ?></p>
                    </div>

                    <div>
                        <strong>$<?php echo number_format($row['total_price'],2); ?></strong>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <p>No transactions yet.</p>

        <?php endif; ?>
    </div>

</div>
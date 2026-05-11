<?php
require_once('../config/db_config.php');
require_once('../config/init.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../../dashboards/client.php?error=" . urlencode("Please login first."));
    exit();
}


// =========================
// FETCH CLIENT ORDERS
// =========================
$orders = mysqli_query($conn, "
    SELECT 
        orders.*,
        gigs.title AS gig_title,
        users.username AS freelancer_name
    FROM orders
    JOIN gigs ON orders.gig_id = gigs.id
    JOIN freelancer_profiles ON orders.freelancer_id = freelancer_profiles.id
    JOIN users ON freelancer_profiles.user_id = users.id
    WHERE orders.client_id = $user_id
    ORDER BY orders.created_at DESC
");
?>

<div class="panel orders-panel">
    <div class="panel-header">
        <h3>My Orders</h3>
    </div>

    <?php if(isset($_GET['order_success'])): ?>
        <p style="color: #059669; margin-bottom: 15px;">Order placed successfully!</p>
    <?php endif; ?>

    <div class="orders-list">
        <?php if(mysqli_num_rows($orders) > 0): ?>
            <?php while($order = mysqli_fetch_assoc($orders)): ?>
                <div class="order-card">
                    <div class="order-left">
                        <h4><?php echo htmlspecialchars($order['gig_title']); ?></h4>
                        <p>Freelancer: <?php echo htmlspecialchars($order['freelancer_name']); ?></p>
                        <small>$<?php echo number_format($order['total_price'], 2); ?> • Ordered <?php echo date('M d, Y', strtotime($order['created_at'])); ?></small>
                    </div>
                    <div class="order-middle">
                        <span class="status <?php echo $order['status']; ?>">
                            <?php echo ucfirst(str_replace('_', ' ', $order['status'])); ?>
                        </span>
                    </div>
                    <div class="order-right">
                        <?php if($order['status'] == 'pending'): ?>
                            <a href="../process/pay_order.php?order_id=<?php echo $order['id']; ?>" class="order-btn" style="background: #10b981;">Pay Now</a>
                        <?php endif; ?>

                        <?php
                        $convo_q = mysqli_query($conn, "SELECT id FROM conversations WHERE order_id = " . $order['id'] . " LIMIT 1");
                        $convo = mysqli_fetch_assoc($convo_q);
                        if($convo):
                        ?>
                            <a href="?section=messages" onclick="localStorage.setItem('open_convo', <?php echo $convo['id']; ?>); localStorage.setItem('open_title', '<?php echo htmlspecialchars($order['gig_title'], ENT_QUOTES); ?>');" class="order-btn" style="text-decoration:none; color:white !important; display:inline-flex; align-items:center; justify-content:center;">Message</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>You have no orders yet. <a href="#" onclick="document.querySelector('[data-target=\'gigs\']').click();" style="color: red !important;">Browse gigs</a> to place your first order!</p>
            </div>
        <?php endif; ?>
    </div>
</div>


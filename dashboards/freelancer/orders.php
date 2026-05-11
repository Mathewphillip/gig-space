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
// fetch orders
$orders_query = "
    SELECT 
        orders.*, 
        users.username AS client_name,
        gigs.title AS gig_title
    FROM orders
    JOIN users ON orders.client_id = users.id
    JOIN gigs ON orders.gig_id = gigs.id
    WHERE orders.freelancer_id = $freelancer_id
    ORDER BY orders.created_at DESC
";

$orders_result = mysqli_query($conn, $orders_query);
?>

<div class="panel orders-panel">
    <div class="panel-header">
        <h3>My Orders</h3>
    </div>
    <div class="orders-list">
        <?php if(mysqli_num_rows($orders_result) > 0): ?>
            <?php while($order = mysqli_fetch_assoc($orders_result)): ?>
                <div class="order-card">
                    <div class="order-left">
                        <h4><?php echo htmlspecialchars($order['gig_title']); ?></h4>
                        <p>Client: <?php echo htmlspecialchars($order['client_name']); ?></p>
                        <small>$<?php echo $order['total_price']; ?></small>
                    </div>
                    <div class="order-middle">
                        <span class="status <?php echo $order['status']; ?>">
                            <?php echo ucfirst(str_replace('_', ' ', $order['status'])); ?>
                        </span>
                    </div>
                    <div class="order-right">
                        <?php
                        $convo_q = mysqli_query($conn, "SELECT id FROM conversations WHERE order_id = " . $order['id'] . " LIMIT 1");
                        $convo = mysqli_fetch_assoc($convo_q);
                        if($convo):
                        ?>
                            <a href="?section=messages" onclick="localStorage.setItem('open_convo', <?php echo $convo['id']; ?>); localStorage.setItem('open_title', '<?php echo htmlspecialchars($order['gig_title'], ENT_QUOTES); ?>');" class="order-btn" style="text-decoration:none; color:inherit; display:inline-flex; align-items:center; justify-content:center;">Message</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>

        <?php else: ?>
            <div class="empty-state">
                <p>You have no orders yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>


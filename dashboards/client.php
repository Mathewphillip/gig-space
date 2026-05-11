<?php
include('../config/init.php');
include('../config/db_config.php');
include('../auth/auth.php'); 

$user_id = $_SESSION['user_id'];
$unread_q = mysqli_query($conn, "
    SELECT COUNT(*) AS unread_count
    FROM messages
    JOIN conversations ON messages.conversation_id = conversations.id
    JOIN orders ON conversations.order_id = orders.id
    WHERE messages.sender_id != $user_id
      AND messages.is_read = 0
      AND orders.client_id = $user_id
");
$unread = mysqli_fetch_assoc($unread_q);
$unread_count = (int)($unread['unread_count'] ?? 0);

?>
<div class="dashboard-container">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>gigSpace</h2>
        <ul>
            <li data-target="overview" class="active">Overview</li>
            <li data-target="gigs">Browse Gigs</li>
            <li data-target="projects">My Projects</li>
            <li data-target="orders">My Orders</li>
            <li data-target="messages">Messages <?php if($unread_count > 0): ?><span class="msg-badge"><?php echo $unread_count; ?></span><?php endif; ?></li>
            <li data-target="profile">Profile Settings</li>
            <li><a style="color:#ff0000;" href="../auth/logout.php">Logout</a></li>
        </ul>
    </div>
    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="dashboard-topbar">
            <div class="topbar">
                <h1>Client Dashboard</h1>
                <div class="user-box">
                    <p style="text-transform: capitalize;">Welcome <?php echo $_SESSION['username']; ?></p>
                </div>
            </div>
        </div>
        <!-- TOP -->
        <div id="overview" class="section active">
            <?php include('client/overview.php'); ?>
        </div>

        <div id="gigs" class="section">
            <?php include('client/gigs.php'); ?>
        </div>

        <div id="projects" class="section">
            <?php include('client/projects.php'); ?>
        </div>
        <div id="orders" class="section">
            <?php include('client/orders.php'); ?>
        </div>
        <div id="messages" class="section">
            <?php include('client/messages.php'); ?>
        </div>
        <div id="profile" class="section">
            <?php include('client/profile.php'); ?>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.sidebar li[data-target]');
    const sections = document.querySelectorAll('.section');
    
    function activateSection(targetId) {
        // Remove active from all
        menuItems.forEach(i => i.classList.remove('active'));
        sections.forEach(sec => sec.classList.remove('active'));
        
        // Add active to target
        const targetItem = document.querySelector(`.sidebar li[data-target=\"${targetId}\"]`);
        if (targetItem) targetItem.classList.add('active');
        
        const targetSec = document.getElementById(targetId);
        if (targetSec) targetSec.classList.add('active');
    }
    
    // Add click listeners
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            activateSection(item.dataset.target);
        });
    });
    
    // URL param
    const urlParams = new URLSearchParams(window.location.search);
    const sectionParam = urlParams.get('section');
    if (sectionParam) {
        activateSection(sectionParam);
    }
});
</script>

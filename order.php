<?php
session_start();
include('config/db_config.php');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: components/login.php");
    exit();
}
$gig_id = isset($_GET['gig_id']) ? (int)$_GET['gig_id'] : 0;
if (!$gig_id) {
    die("No gig selected");
}

// Fetch gig with freelancer info
$gig_q = mysqli_query($conn, "
    SELECT gigs.*, users.username AS freelancer_name, categories.name AS category_name
    FROM gigs
    JOIN freelancer_profiles ON gigs.freelancer_id = freelancer_profiles.id
    JOIN users ON freelancer_profiles.user_id = users.id
    JOIN categories ON gigs.category_id = categories.id
    WHERE gigs.id = $gig_id AND gigs.status = 'active'
    LIMIT 1
");
$gig = mysqli_fetch_assoc($gig_q);

if (!$gig) {
    die("Gig not found or inactive");
}

$img_q = mysqli_query($conn, "SELECT image_url FROM gig_images WHERE gig_id = $gig_id LIMIT 1");
$img = mysqli_fetch_assoc($img_q);
$image = './dashboards/freelancer/gig_default.png';
if ($img && $img['image_url']) {
    $image = './dashboards/uploads/' . $img['image_url'];
}

$error = '';

if (isset($_POST['place_order'])) {
    $requirements = mysqli_real_escape_string($conn, trim($_POST['requirements']));
    $freelancer_id = $gig['freelancer_id'];
    $price = $gig['price'];

    if (empty($requirements)) {
        $error = "Please describe your requirements";
    } else {
        // Insert order
        mysqli_query($conn, "
            INSERT INTO orders (gig_id, client_id, freelancer_id, requirements, total_price, status)
            VALUES ($gig_id, $user_id, $freelancer_id, '$requirements', $price, 'pending')
        ");
        $order_id = mysqli_insert_id($conn);

        // Create conversation
        mysqli_query($conn, "INSERT INTO conversations (order_id) VALUES ($order_id)");
        $convo_id = mysqli_insert_id($conn);

        // Insert initial message (requirements)
        $safe_requirements = mysqli_real_escape_string($conn, trim($_POST['requirements']));
        mysqli_query($conn, "
            INSERT INTO messages (conversation_id, sender_id, message)
            VALUES ($convo_id, $user_id, '$safe_requirements')
        ");

        header("Location: dashboards/dashboard.php?section=orders&order_success=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order: <?php echo htmlspecialchars($gig['title']); ?></title>
    <link rel="stylesheet" href="./assets/styling.php">
    <style>
        .order-page {
            margin: 40px auto;
            padding: 0 20px;
            background: url('images/lighttheme.png');
            background-position: center;
        }
        .gig-summary {
            display: flex;
            gap: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .gig-summary img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .gig-info h2 {
            margin-bottom: 10px;
        }
        .gig-info p {
            color: #555;
            margin-bottom: 5px;
        }
        .gig-info .price {
            font-size: 20px;
            color: #4f46e5;
            font-weight: bold;
        }
        .order-form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .order-form h3 {
            margin-bottom: 15px;
        }
        .order-form textarea {
            width: 100%;
            min-height: 150px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            resize: vertical;
            margin-bottom: 15px;
        }
        .order-form button {
            padding: 12px 24px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        .order-form button:hover {
            background: #3730a3;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<?php include('templates/header.php'); ?>
<?php include('assets/styling.php');?>
<div class="order-page">
    <h1>Place Order</h1>
    <div class="gig-summary">
        <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($gig['title']); ?>">
        <div class="gig-info">
            <h2><?php echo htmlspecialchars($gig['title']); ?></h2>
            <p>Freelancer: <?php echo htmlspecialchars($gig['freelancer_name']); ?></p>
            <p>Category: <?php echo htmlspecialchars($gig['category_name']); ?></p>
            <p>Delivery: <?php echo $gig['delivery_time']; ?> days • Revisions: <?php echo $gig['revisions']; ?></p>
            <div class="price">$<?php echo number_format($gig['price'], 2); ?></div>
        </div>
    </div>

    <!-- ORDER FORM -->
    <div class="order-form">
        <h3>Describe your requirements</h3>
        <?php if($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
        <form method="POST">
            <textarea name="requirements" placeholder="Tell the freelancer what you need..." required></textarea>
            <button type="submit" name="place_order">Place Order ($<?php echo number_format($gig['price'], 2); ?>)</button>
        </form>
    </div>

</div>

</body>
</html>


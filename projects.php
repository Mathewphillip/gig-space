<?php
include('config/init.php');
include('config/db_config.php');

// Role-based access: only freelancers (and 'both') can browse projects
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['freelancer', 'both'])) {
    header("Location: index.php?error=" . urlencode("Access denied. Only freelancers can browse projects."));
    exit();
}

// Fetch all open projects
$projects_q = mysqli_query($conn, "
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | Browse Projects</title>
    <?php include('assets/styling.php'); ?>
    <style>
        .projects-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .projects-page h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .projects-page p.subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        .project-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .project-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }
        .project-header img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #4f46e5;
        }
        .project-header h3 {
            font-size: 1.1rem;
            margin-bottom: 2px;
        }
        .project-header small {
            color: #888;
            font-size: 12px;
        }
        .project-body p {
            color: #555;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        .project-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .project-meta .budget {
            font-size: 1.2rem;
            font-weight: bold;
            color: #4f46e5;
        }
        .project-meta .category-tag {
            background: #eef5ff;
            color: #0d7aff;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        .project-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .project-footer small {
            color: #888;
            font-size: 12px;
        }
        .bid-btn {
            padding: 8px 16px;
            background: #4f46e5;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }
        .bid-btn:hover {
            background: #3730a3;
        }
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <?php include('templates/header.php'); ?>
    <main>
        <div class="projects-page">
            <h1>Browse Open Projects</h1>
            <p class="subtitle">Find projects posted by clients and submit your proposals.</p>

            <?php if (mysqli_num_rows($projects_q) > 0): ?>
                <div class="projects-grid">
                    <?php while ($p = mysqli_fetch_assoc($projects_q)): ?>
                        <div class="project-card">
                            <div class="project-header">
                                <img src="<?php echo !empty($p['client_image']) ? 'dashboards/uploads/profile/' . $p['client_image'] : 'images/default_image.jpg'; ?>" alt="<?php echo htmlspecialchars($p['client_name'] ?? $p['client_username']); ?>">
                                <div>
                                    <h3><?php echo htmlspecialchars($p['title']); ?></h3>
                                    <small>by <?php echo htmlspecialchars($p['client_name'] ?? $p['client_username']); ?> • <?php echo date('M d, Y', strtotime($p['created_at'])); ?></small>
                                </div>
                            </div>
                            <div class="project-body">
                                <p><?php echo nl2br(htmlspecialchars(substr($p['description'], 0, 200))) . (strlen($p['description']) > 200 ? '...' : ''); ?></p>
                            </div>
                            <div class="project-meta">
                                <span class="budget">$<?php echo number_format($p['budget_min'], 2); ?> - $<?php echo number_format($p['budget_max'], 2); ?></span>
                                <span class="category-tag"><?php echo htmlspecialchars($p['category_name'] ?? 'General'); ?></span>
                            </div>
                            <div class="project-footer">
                                <?php if ($p['deadline']): ?>
                                    <small>Deadline: <?php echo date('M d, Y', strtotime($p['deadline'])); ?></small>
                                <?php else: ?>
                                    <small>No deadline set</small>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <a href="dashboards/dashboard.php?section=projects&view_project=<?php echo $p['id']; ?>" class="bid-btn" style="color:white !important;">Bid Now</a>
                                <?php else: ?>
                                    <a href="components/login.php" class="bid-btn">Login to Bid</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <h2>No open projects yet</h2>
                    <p>Check back later for new opportunities!</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <?php include('templates/footer.php'); ?>
</body>
</html>

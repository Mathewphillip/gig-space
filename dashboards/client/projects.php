<?php


if (!isset($conn) || !($conn instanceof mysqli)) {
    die('Database connection not initialized.');
}



$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: ../components/login.php");
    exit();
}

// Fetch client's projects
$projects_query = mysqli_query($conn, "
    SELECT * FROM projects 
    WHERE client_id = $user_id 
    ORDER BY created_at DESC
");


$projects = [];
while ($p = mysqli_fetch_assoc($projects_query)) {
    // Fetch bids for this project (only pending for now)
    $bids_query = mysqli_query($conn, "
        SELECT bids.*, 
               freelancer_profiles.user_id as freelancer_user_id,
               users.username as freelancer_username
        FROM bids 
        JOIN freelancer_profiles ON bids.freelancer_id = freelancer_profiles.id
        JOIN users ON freelancer_profiles.user_id = users.id
        WHERE bids.project_id = {$p['id']} AND bids.status = 'pending'
        ORDER BY bids.amount ASC
    ");
    $p['bids'] = [];
    while ($b = mysqli_fetch_assoc($bids_query)) {
        $p['bids'][] = $b;
    }
    $projects[] = $p;
}
?>

<?php include('clientStyle.php'); ?>
<div class="projects-layout">
    <!-- LEFT: Projects Viewing Section -->
    <div class="projects-left">
        <div class="panel">
            <div class="panel-header">
                <h3>My Projects & Bids</h3>
                <p style="color: #666; font-size: 14px;">Manage your projects and bids (<?php echo count($projects); ?> total)</p>
            </div>

            <?php if (empty($projects)): ?>
                <div class="projects-placeholder">
                    <div style="text-align: center; color: #9ca3af; padding: 40px;">
                        <h4>No projects yet</h4>
                        <p>Create your first project to get bids from freelancers</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="projects-list">
                    <?php foreach ($projects as $project): ?>
                        <div class="project-card">
                            <div class="project-header">
                                <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                                <span class="status <?php echo $project['status']; ?>">
                                    <?php echo ucfirst($project['status']); ?>
                                </span>
                            </div>
                            <div class="project-details">
                                <p><strong>Budget:</strong> $<?php echo ($project['budget_min']); ?> - $<?php echo ($project['budget_max']); ?></p>
                                <?php if ($project['deadline']): ?>
                                    <p><strong>Deadline:</strong> <?php echo date('M d, Y', strtotime($project['deadline'])); ?></p>
                                <?php endif; ?>
                                <p><?php echo nl2br(htmlspecialchars(substr($project['description'], 0, 100))); ?>...</p>
                            </div>
                            <div class="project-bids">
                                <p>Bids (<?php echo count($project['bids']); ?>)</p>
                                <?php if (!empty($project['bids'])): ?>
                                    <div class="bids-list">
                                        <?php foreach (array_slice($project['bids'], 0, 3) as $bid): ?>
                                            <div class="bid-item">
                                                <span><?php echo htmlspecialchars($bid['freelancer_username']); ?></span>
                                                <strong>$<?php echo($bid['amount']); ?></strong>
                                                (<?php echo $bid['delivery_time']; ?> days)
                                                <a href="../process/accept_bid.php?bid_id=<?php echo $bid['id']; ?>&project_id=<?php echo $project['id']; ?>"
                                                    class="btn small accept-btn" style="font-size:12px; padding:4px 8px; margin-left:auto;">Accept</a>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php if (count($project['bids']) > 3): ?>
                                            <span>+<?php echo count($project['bids']) - 3; ?> more</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="project-actions">
                                <?php if ($project['status'] == 'open'): ?>
                                    <a href="client/view_bids.php?project_id=<?php echo $project['id']; ?>" class="btn small">View All Bids</a>
                                <?php endif; ?>

                                <?php if (count($project['bids']) > 0 && $project['status'] == 'open'): ?>
                                    <a href="../process/update_project_status.php?project_id=<?php echo $project['id']; ?>&status=closed"
                                        class="btn small secondary" onclick="return confirm('Close project?')">Close Project</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

  
    <div class="projects-right">
        <div class="panel">
            <div class="project-form-header">
                <h3>Post New Project</h3>
                <p style="color: #666; font-size:14px;font-weight: 400;">Get bids from skilled freelancers</p>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="success-msg">Project posted successfully!</div>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <div class="error-msg"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

            <form method="POST" action="../process/create_project.php" class="project-form">
                <div class="form-group">
                    <input type="text" name="title" placeholder="Project title (e.g. Build e-commerce website)" required>
                </div>
                <div class="form-row">
                    <select name="category_id" required>
                        <option value="">Select category</option>
                        <?php
                        $categories = mysqli_query($conn, 'SELECT * FROM categories ORDER BY name ASC');
                        while ($c = mysqli_fetch_assoc($categories)):
                        ?>
                            <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <input type="number" name="budget_min" placeholder="Min budget ($)" step="0.01" min="1" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="budget_max" placeholder="Max budget ($)" step="0.01" min="1" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="date" name="deadline">
                </div>
                <div class="form-group">
                    <textarea name="description" placeholder="Describe your project requirements, timeline, deliverables..." required rows="5"></textarea>
                </div>
                <button type="submit" name="create_project" class="btn primary full project-submit-btn">
                    Post Project & Get Bids
                </button>
            </form>
        </div>
    </div>
</div>

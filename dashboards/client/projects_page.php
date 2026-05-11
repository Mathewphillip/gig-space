<?php
include('../../config/init.php');
include('../../config/db_config.php');
include('../../auth/auth.php');

$user_id = $_SESSION['user_id'];
// Fetch categories for form
$categories = mysqli_query($conn, 'SELECT * FROM categories ORDER BY name ASC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Project | Client Dashboard - gigSpace</title>
    <?php include('../../assets/styling.php'); ?>
    <?php include('../dashboardstyle.php'); ?>
    <?php include('clientStyle.php');?>
</head>
<body style="background:url('../../images/lighttheme.png') !important;">
    <div class="post-project-container" >
        <div class="page-header">
            <h1>Post a New Project</h1>
            <p>Create a project to attract skilled freelancers</p>
        </div>

        <div class="page-nav">
            <a href="../../index.php" >Home</a>
            <a href="../dashboard.php" >View My Projects</a>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="success-msg"> Project posted successfully! Check your projects dashboard.</div>
        <?php endif; ?>
        <?php if(isset($_GET['error'])): ?>
            <div class="error-msg"> <?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <div class="gig-form">
            <form method="POST" action="../../process/create_project.php">
                <h4>Tell us about your project</h4>
                <input type="text" name="title" placeholder="Project Title (e.g. Build responsive website)" required>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php while ($c = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
                    <?php endwhile; ?>
                </select>
                <div class="form-grid">
                    <input type="number" name="budget_min" placeholder="Min Budget ($)"  min="1" required>
                    <input type="number" name="budget_max" placeholder="Max Budget ($)"  min="1" required>
                </div>
                <input type="date" name="deadline">
                <textarea name="description" placeholder="Describe your project in detail... requirements, timeline, expectations." required rows="6"></textarea>
                <button type="submit" name="create_project" class="btn primary full">Post Project & Get Bids</button>
            </form>
        </div>
    </div>
</body>

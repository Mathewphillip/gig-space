<?php
include('config/init.php');
include('config/db_config.php');




$freelancers_query = "
    SELECT
        u.id AS user_id,
        u.username,

        p.full_name,
        p.profile_image,
        p.country,

        fp.title,
        fp.experience_level,
        fp.rating,
        fp.completed_orders

    FROM users u

    INNER JOIN freelancer_profiles fp
        ON u.id = fp.user_id

    LEFT JOIN profiles p
        ON u.id = p.user_id

    WHERE u.role = 'freelancer'
    AND u.is_active = 1
    ORDER BY fp.completed_orders DESC
";

$freelancers_q = mysqli_query($conn, $freelancers_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | Browse Freelancers</title>
    <?php include('assets/styling.php'); ?>
</head>
<body>
    <style>
        body {
            background: #f4f6fb;
        }

        .freelancers-page {
            width: 95%;
            max-width: 1400px;
            margin: 40px auto;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 36px;
            color: #111827;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 15px;
        }

        .search-section {
            border-radius: 18px;
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            gap: 15px;
        }

        .search-input-wrapper {
            flex: 1;
            position: relative;
        }

        .search-input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .search-input {
            width: 100%;
            height: 55px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            padding: 0 18px 0 48px;
            outline: none;
            font-size: 15px;
        }

        .search-input:focus {
            border-color: #2563eb;
        }

        .search-btn {
            border: none;
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .search-btn:hover {
            background: #1d4ed8;
        }

        .freelancers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }

        .freelancer-card {
            width: 315px;
            height: 380px;
            background: white;
            border-radius: 22px;
            border: 1px solid #e5e7eb;
            padding: 25px;
            transition: 0.3s ease;
        }

        .freelancer-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        .freelancer-top {
            text-align: center;
        }

        .freelancer-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #eff6ff;
            margin: 10px;
        }

        .freelancer-name {
            font-size: 21px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }

        .freelancer-username {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;

        }

        .freelancer-country {
            color: #9ca3af;
            font-size: 14px;
        }

        .freelancer-title {
            color: #2563eb;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .freelancer-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f9fafb;
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 22px;
        }

        .stat-box {
            text-align: center;
            flex: 1;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #111827;
        }


        .freelancer-footer {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .experience-tag {
            background: #eef2ff;
            color: #4338ca;
            padding: 10px;
            border-radius: 30px;
            font-size: 14px;
        }

        .profile-link {
            background: #1d4ed8;
            color: white !important;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .profile-link:hover {
            background: black;
        }

        .no-results {
            background: white;
            border-radius: 20px;
            padding: 70px 20px;
            text-align: center;
        }

        .no-results h2 {
            margin-bottom: 10px;
            color: #111827;
        }

        .no-results p {
            color: #6b7280;
        }

        @media(max-width: 768px) {

            .search-form {
                flex-direction: column;
            }

            .search-btn {
                height: 52px;
            }

            .freelancers-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <?php include('templates/header.php'); ?>
    <main>
        <div class="freelancers-page">
            <div class="page-header">
                <h1>Browse Freelancers</h1>
                <p>
                    Find talented professionals ready to work on your project.
                </p>
            </div>
            <!-- Search -->
            <div class="search-section">
                <div class="search-form">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search"></i>
                        <input
                            type="text"
                            id="liveSearch"
                            class="search-input"
                            placeholder="Search freelancers...">
                    </div>
                </div>
            </div>

            <?php if ($freelancers_q && mysqli_num_rows($freelancers_q) > 0): ?>

                <div class="freelancers-grid">
                    <?php while ($f = mysqli_fetch_assoc($freelancers_q)): ?>
                        <?php
                        $name = $f['full_name'] ?: $f['username'];
                        $image_path = 'images/default_image.jpg';

                        if (!empty($f['profile_image'])) {

                            $upload_path = __DIR__ . '/dashboards/uploads/profile/' . $f['profile_image'];

                            if (file_exists($upload_path)) {
                                $image_path = 'dashboards/uploads/profile/' . $f['profile_image'];
                            }
                        }
                        ?>

                        <div class="freelancer-card">
                            <div class="freelancer-top">
                                <img
                                    src="<?php echo htmlspecialchars($image_path); ?>"
                                    alt="<?php echo htmlspecialchars($name); ?>"
                                    class="freelancer-avatar">
                                <div class="freelancer-name">
                                    <?php echo htmlspecialchars($name); ?>
                                </div>
                                <div class="freelancer-username">
                                    @<?php echo htmlspecialchars($f['username']); ?>
                                    <?php if (!empty($f['country'])): ?>

                                        <div class="freelancer-country">
                                            <?php echo "| ", htmlspecialchars($f['country']); ?>
                                        </div>

                                    <?php endif; ?>
                                </div>

                                <div class="freelancer-title">
                                    <?php echo htmlspecialchars($f['title'] ?: 'Freelancer'); ?>
                                </div>

                            </div>
                            <span class="experience-tag">
                                <?php
                                echo !empty($f['experience_level'])
                                    ? ucfirst(htmlspecialchars($f['experience_level']))
                                    : 'Expert';
                                ?>
                            </span>
                            <div class="freelancer-footer">
                                <a
                                    href="view_freelancer.php?id=<?php echo (int)$f['user_id']; ?>"
                                    class="profile-link">

                                    View Profile

                                </a>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>

                <div class="no-results">

                    <h2>No freelancers found</h2>

                    <p>
                        Try searching with different keywords.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </main>
    <script>
        const searchInput = document.getElementById('liveSearch');

        searchInput.addEventListener('keyup', function() {

            const searchValue = this.value.toLowerCase();

            const freelancerCards = document.querySelectorAll('.freelancer-card');

            freelancerCards.forEach(card => {

                const cardText = card.innerText.toLowerCase();

                if (cardText.includes(searchValue)) {

                    card.style.display = 'block';

                } else {

                    card.style.display = 'none';

                }

            });

        });
    </script>

    <?php include('templates/footer.php'); ?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | how it works</title>
</head>
<body>
    <?php include('./config/init.php'); ?>
    <?php include('assets/styling.php'); ?>
    <?php include('templates/header.php'); ?>
    <main class="how-it-works-main">
        <section class="page-hero how-it-works-page" style="height: 80vh;">
            <div class="page-hero-content how">
                <h1>Simple, Clear, and Effective</h1>
                <p>Discover the streamlined process for both clients and freelancers on gigSpace.</p>
            </div>
        </section>
        <section class="process-section enhanced">
            <div class="process-column">
                <h2 class="process-title">For Clients</h2>
                <div class="process-step">
                    <div class="process-step-number">1</div>
                    <h4><i class="fas fa-file-alt"></i> Post Your Project</h4>
                    <div class="process-step-details">
                        Describe requirements, set budget &amp; deadline. Get bids from freelancers instantly - completely free!
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-step-number">2</div>
                    <h4><i class="fas fa-search-dollar"></i> Review &amp; Compare Bids</h4>
                    <div class="process-step-details">
                        Browse proposals, check freelancer profiles, ratings, portfolios, and past work. Compare prices &amp; timelines.
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-step-number">3</div>
                    <h4><i class="fas fa-handshake"></i> Hire &amp; Escrow Secure</h4>
                    <div class="process-step-details">
                        Select winner, payment held in escrow. Start work with milestone releases and integrated messaging.
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-step-number">4</div>
                    <h4><i class="fas fa-check-circle"></i> Approve &amp; Release Payment</h4>
                    <div class="process-step-details">
                        Review delivery, leave feedback &amp; rating. Release funds only when 100% satisfied. Dispute protection included.
                    </div>
                </div>
            </div>
            <div class="process-column">
                <h2 class="process-title">For Freelancers</h2>
                <div class="process-step">
                    <div class="process-step-number">1</div>
                    <h4><i class="fas fa-user-edit"></i> Build Profile &amp; Gigs</h4>
                    <div class="process-step-details">
                        Showcase skills, portfolio, create pre-packaged gigs. Set your rates and availability.
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-step-number">2</div>
                    <h4><i class="fas fa-bullseye"></i> Bid on Projects or Sell Gigs</h4>
                    <div class="process-step-details">
                        Browse open projects, submit custom bids OR clients buy your ready gigs directly. Skill matching helps!
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-step-number">3</div>
                    <h4><i class="fas fa-tasks"></i> Complete &amp; Deliver Work</h4>
                    <div class="process-step-details">
                        Communicate via secure messaging, submit work through platform. Track milestones and revisions.
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-step-number">4</div>
                    <h4><i class="fas fa-star"></i> Get Paid &amp; Build Rating</h4>
                    <div class="process-step-details">
                        Client approves → Funds released instantly. Build 5-star ratings, unlock higher earnings &amp; priority.
                    </div>
                </div>
            </div>
        </section>
        <?php
        // Fetch stats from database
        $totalUsers = 0;
        $totalClients = 0;
        $totalFreelancers = 0;
        $totalGigs = 0;
        $totalProjects = 0;

        // Total active users
        $query = "SELECT COUNT(*) AS total FROM users WHERE is_active = 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalUsers = $row['total'];
        }

        // Total clients (role client or both)
        $query = "SELECT COUNT(*) AS total FROM users 
          WHERE role IN ('client', 'both') 
          AND is_active = 1";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalClients = $row['total'];
        }

        // Total freelancers (profiles linked to active users)
        $query = "SELECT COUNT(*) AS total 
          FROM freelancer_profiles fp
          JOIN users u ON fp.user_id = u.id
          WHERE u.is_active = 1";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalFreelancers = $row['total'];
        }

        // Total active gigs
        $query = "SELECT COUNT(*) AS total 
          FROM gigs 
          WHERE status = 'active'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalGigs = $row['total'];
        }

        // Total open projects
        $query = "SELECT COUNT(*) AS total 
          FROM projects 
          WHERE status = 'open'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalProjects = $row['total'];
        }
        ?>

        <section class="stats-section" style="background-color: white; min-height: 400px;">
            <div class="stats-container">
                <div class="stats-card">
                    <i class="fas fa-users stats-icon"></i>
                    <div class="stats-number"><?php echo number_format($totalUsers); ?></div>
                    <div class="stats-label">Active Users</div>
                </div>
                <div class="stats-card">
                    <i class="fas fa-briefcase stats-icon"></i>
                    <div class="stats-number"><?php echo number_format($totalClients); ?></div>
                    <div class="stats-label">Clients</div>
                </div>
                <div class="stats-card">
                    <i class="fas fa-user-tie stats-icon"></i>
                    <div class="stats-number"><?php echo number_format($totalFreelancers); ?></div>
                    <div class="stats-label">Freelancers</div>
                </div>
                <div class="stats-card">
                    <i class="fas fa-bolt stats-icon"></i>
                    <div class="stats-number"><?php echo number_format($totalGigs); ?></div>
                    <div class="stats-label">Live Gigs</div>
                </div>
                <div class="stats-card">
                    <i class="fas fa-project-diagram stats-icon"></i>
                    <div class="stats-number"><?php echo number_format($totalProjects); ?></div>
                    <div class="stats-label">Open Projects</div>
                </div>
            </div>
        </section>
    </main>
    <?php include('templates/footer.php'); ?>
</body>

</html>
    <footer class="footer">
        <div class="footer-top">
            <div class="footer-grid">
                <!-- Brand -->
                <div class="footer-col footer-brand">
                    <img src="images/gigspace.png" alt="gigSpace logo" class="footer-logo">
                    <p>Find the perfect freelance services for your business or start earning today.</p>
                    <div class="footer-socials">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="hire.php">Hire a Freelancer</a></li>
                        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['freelancer', 'both'])): ?>
                        <li><a href="projects.php">Browse Projects</a></li>
                        <?php endif; ?>
                        <li><a href="start.php">Start Freelancing</a></li>
                        <li><a href="how-it-works.php">How It Works</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-col">
                    <h4>Popular Services</h4>
                    <ul>
                        <li><a href="hire.php">Graphics & Design</a></li>
                        <li><a href="hire.php">Digital Marketing</a></li>
                        <li><a href="hire.php">Writing & Translation</a></li>
                        <li><a href="hire.php">Programming & Tech</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="contact_us.php">Help & Support</a></li>
                        <li><a href="dashboards/dashboard.php">Dashboard</a></li>
                    </ul>
                </div>

                <!-- Newsletter / Subscribe -->
                <div class="footer-col footer-subscribe">
                    <h4>Stay Updated</h4>
                    <p>Subscribe to get the latest gigs, projects, and freelance tips delivered to your inbox.</p>
                    <?php
                    $sub_count_query = "SELECT COUNT(*) AS total FROM subscribers";
                    $sub_count_result = mysqli_query($conn, $sub_count_query);
                    $sub_count = ($sub_count_result) ? mysqli_fetch_assoc($sub_count_result)['total'] : 0;
                    ?>
                    <?php if ($sub_count > 0): ?>
                        <p class="subscriber-count"><i class="fas fa-users"></i> <?php echo number_format($sub_count); ?> subscriber<?php echo ($sub_count > 1) ? 's' : ''; ?> and counting</p>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['subscribe_status'])): ?>
                        <div class="subscribe-alert subscribe-<?php echo $_SESSION['subscribe_status']; ?>">
                            <?php echo htmlspecialchars($_SESSION['subscribe_message']); ?>
                        </div>
                        <?php unset($_SESSION['subscribe_status'], $_SESSION['subscribe_message']); ?>
                    <?php endif; ?>
                    <form action="process/subscribe.php" method="POST" class="subscribe-form">
                        <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                        <input type="email" name="subscriber_email" placeholder="Enter your email" required aria-label="Email address">
                        <button type="submit" class="subscribe-btn">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <p>&copy; <?php echo date('Y'); ?> gigSpace. All rights reserved.</p>
                <div class="footer-legal">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

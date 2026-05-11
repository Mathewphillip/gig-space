<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | contact us</title>
</head>
<body>
<?php include('config/init.php'); ?>
<?php include('assets/styling.php');?>
<?php include('templates/header.php');?>
 <main>
        <section class="page-hero">
            <div class="page-hero-content">
                <h1>Help & Support</h1>
                <p>We're here to help. Find answers to common questions or send us a message directly.</p>
            </div>
        </section>

        <section class="support-section">
            <div class="support-column faq-column">
                <h3>Frequently Asked Questions</h3>
                <div class="faq-item">
                    <h4><i class="fas fa-plus-circle"></i> How do I post a job?</h4>
                    <p>Navigate to the "Hire a Freelancer" page and click the "Post a Project" button to get started.</p>
                </div>
                <div class="faq-item">
                    <h4><i class="fas fa-lock"></i> Is my payment secure?</h4>
                    <p>Yes! All payments are held in escrow and are only released to the freelancer once you approve the work.</p>
                </div>
                <div class="faq-item">
                    <h4><i class="fas fa-dollar-sign"></i> How do I withdraw my earnings?</h4>
                    <p>As a freelancer, you can withdraw your earnings from your dashboard via several payment methods.</p>
                </div>
            </div>
            <div class="support-column contact-form-column">
                <h3>Send Us a Message</h3>
                <?php if (isset($_SESSION['contact_status'])): ?>
                    <div class="contact-alert contact-<?php echo $_SESSION['contact_status']; ?>">
                        <?php echo htmlspecialchars($_SESSION['contact_message']); ?>
                    </div>
                    <?php unset($_SESSION['contact_status'], $_SESSION['contact_message']); ?>
                <?php endif; ?>
                <form action="process/contact_form.php" method="POST" class="contact-form">
                    <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                    <div class="form-group">
                        <label for="contact-name"><i class="fas fa-user"></i> Name</label>
                        <input type="text" id="contact-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="contact-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message"><i class="fas fa-comment-dots"></i> Message</label>
                        <textarea id="message" name="message" rows="5" required minlength="10"></textarea>
                    </div>
                    <button type="submit" class="form-button">Send Message</button>
                </form>
            </div>
        </section>

        <section class="team-section">
            <h2>Meet Our Team</h2>
            <div class="freelancer-container">
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/benjamin.jpg" alt="magumba benjamin samuel">
                    </div>
                    <h3>Magumba Benjamin Samuel</h3>
                    <p>2400723155</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/joshua.jpg" alt="joshua joram">
                    </div>
                    <h3>Kyewalabye Joshua Joram</h3>
                    <p>2400700611</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/mathew.jpg" alt="mathew beast">
                    </div>
                    <h3>Matovu Mathew Phillip</h3>
                    <p>2400716689</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/vale.jpg" alt="natukunda valentine">
                    </div>
                    <h3>Natukunda Anita Valentine</h3>
                    <p>2400709944</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/glosh.jpg" alt="Aol Gloria">
                    </div>
                    <h3>Gloria Aol</h3>
                    <p>2400703540</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/eric.jpg" alt="magala eric">
                    </div>
                    <h3>Magala Eric</h3>
                    <p>2400700659</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/jojo.jpg" alt="joan musakira">
                    </div>
                    <h3>Mutesi Joanita Musakira</h3>
                    <p>2400707502</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/adrona.jpg" alt="kushaba adrona">
                    </div>
                    <h3>Kushaba Adrona</h3>
                    <p>2400700594</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/sharif.jpg" alt="sharif kasozi">
                    </div>
                    <h3>Kasozi Sharif</h3>
                    <p>2400715620</p>
                </div>
                <div class="team-card">
                    <div class="freelancer-photo">
                        <img src="images/fancy.jpg" alt="fancy pamella">
                    </div>
                    <h3>Nakabuye Pamella Fancy</h3>
                    <p>2400708188</p>
                </div>
            </div>
        </section>
</main>
<?php include('templates/footer.php');?>
</body>
</html>
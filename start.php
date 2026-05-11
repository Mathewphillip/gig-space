<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | start</title>
</head>
<body>
    <?php include('./config/init.php');?>
    <?php include('assets/styling.php');?>
    <?php include('templates/header.php');?>
    <main class="hire-main" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/darktheme.png') center/cover fixed;">
        <section class="page-hero" style="height: 80vh;">
            <div class="page-hero-content">
                <h1>Work Your Way on <span class="gigspace-brand-heading"style="color: white !important;"><span class="gig">Gig</span>Sp<span class="a">a</span>ce</span></h1>
                <p>Join our community of top freelancers and find high-quality work from trusted clients.</p>
                <a href="components/signup-freelancer.php" class="cta-button">Start Free Lancing</a>
            </div>
        </section>
        <section class="how-it-works">
            <h2>How to Get Started</h2>
            <div class="steps-container">
                <div class="step-card">
                    <h3><i class="fas fa-user-edit"></i> 1. Create Your Profile</h3>
                    <p>Showcase your skills, experience, and portfolio to attract clients. A great profile is your key to success.</p>
                </div>
                <div class="step-card">
                    <h3><i class="fas fa-briefcase"></i> 2. Find Opportunities</h3>
                    <p>Browse projects posted by clients or create pre-packaged gigs that clients can purchase directly.</p>
                </div>
                <div class="step-card">
                    <h3><i class="fas fa-hand-holding-usd"></i> 3. Get Paid Securely</h3>
                    <p>Use our platform to communicate, deliver work, and get paid securely for every project you complete.</p>
                </div>
            </div>
        </section>

        <section class="benefits-section">
            <h2>Why Freelance with Us?</h2>
            <div class="benefits-container">
                <div class="benefit-card">
                    <div class="benefit-icon icon-blue">
                        <i class="fas fa-clock"></i> 
                    </div>
                    <h3>Work Flexibly</h3>
                    <p>Choose your own hours and work from anywhere in the world.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon icon-purple">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Quality Clients</h3>
                    <p>Connect with established businesses and innovative startups.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon icon-green">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Guaranteed Payments</h3>
                    <p>Our secure payment system ensures you get paid for your hard work.</p>
                </div>
            </div>
        </section>

        <section class="testimonials">
            <h2>Success Stories</h2>
            <div class="testimonial-container">
                <div class="testimonial-card">
                    <p class="quote">"Joining gigSpace was a game-changer for my freelance career. I've found amazing clients and have a steady stream of interesting projects."</p>
                    <p class="author">- Kasozi Sharif., Web Developer</p>
                </div>
                <div class="testimonial-card">
                    <p class="quote">"The platform is so easy to use. I created my profile and landed my first gig within a week. Highly recommended!"</p>
                    <p class="author">- Mutesi Joan., Graphic Designer</p>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <h2>Ready to Start Earning on <span class="gigspace-brand-heading"><span class="gig">Gig</span>Sp<span class="a">a</span>ce</span>?</h2>
            <a href="components/signup-freelancer.php" class="cta-button">Join Today</a>
        </section>
    </main>
    <?php include('templates/footer.php');?>
</body>
</html>
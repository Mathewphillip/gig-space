<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gigSpace | Hire freelancer</title>
</head>
<body>
    <?php include('./config/init.php');?>
    <?php include('assets/styling.php');?>
    <?php include('templates/header.php');?>
<main class="hire-main" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.5)), url('images/darktheme.png') center/cover fixed;">
        <section class="page-hero" style="height:80vh;">
            <div class="page-hero-content">
                <h1>Find the Right Freelancer, Right Away</h1>
                <p>Access a global network of skilled professionals to help you get more done.</p>
                <?php if(isset($_SESSION['user_id']) && ($_SESSION['role']==='client')):?>
                    <a href="dashboards/client/projects_page.php" class="cta-button">Post a project</a>
                <?php endif ?>
            </div>
        </section>
        <section class="how-it-works">
            <h2>How to Hire on <span class="gigspace-brand-heading" style="color: white !important;"><span class="gig">Gig</span>Sp<span class="a">a</span>ce</span></h2>
            <div class="steps-container">
                <div class="step-card">
                    <h3><i class="fas fa-bullhorn"></i> 1. Post Your Project</h3>
                    <p>Tell us what you need. The more details you provide, the more relevant proposals you'll receive.</p>
                </div>
                <div class="step-card">
                    <h3><i class="fas fa-users"></i> 2. Hire the Best Fit</h3>
                    <p>Review proposals, browse freelancer profiles, and interview your top candidates to make the right choice.</p>
                </div>
                <div class="step-card">
                    <h3><i class="fas fa-credit-card"></i> 3. Pay Securely</h3>
                    <p>Pay for work through our secure system. You only release payment when the work is approved.</p>
                </div>
            </div>
        </section>
        <section class="benefits-section">
            <h2>Why Hire on <span class="gigspace-brand-heading"><span class="gig">Gig</span>Sp<span class="a">a</span>ce</span>?</h2>
            <div class="benefits-container">
                <div class="benefit-card">
                    <div class="benefit-icon icon-blue">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Access Global Talent</h3>
                    <p>Find experts from around the world for any skill you need.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon icon-green">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure Payments</h3>
                    <p>Pay with confidence. Your funds are held in escrow until you approve the work.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon icon-purple">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our support team is here to help you at any stage of your project.</p>
                </div>
            </div>
        </section>
        <section class="testimonials">
            <h2>What Our Clients Say</h2>
            <div class="testimonial-container">
                <div class="testimonial-card">
                    <p class="quote">"gigSpace made it incredibly easy to find a skilled developer for my startup. The process was seamless and the result was fantastic!"</p>
                    <p class="author">- Aol Gloria., CEO of TechCorp</p>
                </div>
                <div class="testimonial-card">
                    <p class="quote">"I needed a logo designed quickly and on budget. I found the perfect designer on gigSpace and couldn't be happier with the final product."</p>
                    <p class="author">-Kushaba Adrona., Small Business Owner</p>
                </div>
            </div>
        </section>
    </main>
    <?php include('templates/footer.php');?>
</body>
</html>
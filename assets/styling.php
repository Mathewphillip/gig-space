<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
    }

    a {
        text-decoration: none;
        color: inherit !important;

    }

    li {
        list-style: none;
    }

    img {
        position: relative;
        width: 100%;
    }

    body {
        background-color: #F8F9FA;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex-grow: 1;
        padding-top: 70px;
        /* Account for fixed header */
    }

    ::-webkit-scrollbar {
        width: 8px;
        background-color: #000000bf;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #003fb3ff;
        max-height: 150px;
        border-radius: 8px;
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 70px;
        background-color: #ffffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        z-index: 1000;
        backdrop-filter: blur(2px);
    }

    .header-container {
        position: relative;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        align-items: center;
        padding: 20px;
    }

    .header-btn {
        background: #0056b3;
        padding: 8px 20px;
        color: white !important;
        border-radius: 5px;
        text-transform: uppercase;
        font-size: 14px;
    }

    .header-account {
        display: flex;
        gap: 25px;
    }

    .header-account small,
    a {
        padding: 5px 15px;
        border-radius: 3px;
        color: #0c41ffff !important;
    }

    .header-account small {
        text-transform: capitalize;
    }

    .header-account a {
        background-color: red;
    }

    .logo {
        position: relative;
        width: 150px;
    }

    nav {
        align-items: center;
    }

    nav ul {
        position: relative;
        display: flex;
        justify-content: space-evenly;
    }

    nav ul li {
        margin-right: 15px;
        color: black !important;
    }

    nav ul li a {
        border-right: 1px solid #eee;
        padding: 5px 20px;
        text-transform: capitalize;
        font-weight: 600;
    }

    nav a:hover {
        color: #0d7aff !important;
    }

    .active {
        color: #007BFF !important;
        font-weight: 700;
    }

    /* Hero Section */
    .hero {
        position: relative;
        height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        text-align: center;
        overflow: hidden;
    }

    .background-video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100vh;
        object-fit: cover;
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    .hero-content {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        gap: 50px;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background: linear-gradient(to top right, #000000ef, #000000db, #000000c5);
        z-index: 2;
    }

    .hero-content h1 {
        max-width: 60%;
        font-size: 3.5rem;
        font-weight: 700;
    }

    .hero-buttons {
        display: flex;
        gap: 25px;
    }

    .hero-buttons a {
        padding: 15px 25px;
        border: none;
        background: #007BFF;
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 5px;

        &.bordered {
            border: 2px solid white;
            background: none;
        }
    }


    /* Categories Section */
    .categories {
        padding: 50px 20px;
        text-align: center;
        background: #0990f0;
    }

    .categories h2 {
        font-size: 2rem;
        margin-bottom: 40px;
        color: #ffffff;
    }

    .category-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .category-card {
        width: 250px;
        background: #fff;
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .category-image {
        height: 200px;
        border-radius: 5px;
    }

    .category-card h3 {
        margin-top: 10px;
        font-size: 1.2rem;
    }

    /* Hire Page hire.html */


    .page-hero {
        height: 400px;
        display: flex;
        place-content: center;
        align-items: center;
    }

    .how-it-works-page {
        background-color: rgba(1, 19, 39, 0.87);
        backdrop-filter: blur(1px);
    }

    .page-hero-content {
        display: flex;
        /* gap: 20px; */
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .page-hero-content h1 {
        font-size: 2.8rem;
        margin: 20px;
        color: #dbdbdb;
    }

    .how {
        background: #dbdbdb;
        padding: 50px;
        border-radius: 15px;
    }

    .how h1 {
        color: #01162c !important;
    }

    .how p {
        color: black !important;
    }

    .page-hero-content p {
        font-size: 1.1rem;
        color: #ffffff;
        text-align: center;
    }

    /* How It Works Section */

    .how-it-works {
        padding: 60px 20px;
        text-align: center;
    }

    .how-it-works h2 {
        margin-bottom: 20px;
        color: #e7e7e7 !important;
    }

    .gigspace-brand-heading {
        color: #efefef !important;
    }

    .steps-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }

    .step-card {
        background: #e7e7e7;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 30px;
        width: 320px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .step-card h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #007BFF;
    }

    .profile-info p i {
        margin-right: 5px;
    }

    /* Call to Action Section */
    .cta-section {
        background-color: #0d7aff;
        color: #fff;
        text-align: center;
        padding: 50px 20px;
    }

    .cta-section h2 {
        font-size: 2rem;
        margin-bottom: 25px;
    }

    .cta-button {
        background-color: #fff;
        color: #007BFF;
        padding: 15px 30px;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .cta-button:hover {
        background-color: #f0f0f0;
        color: #0056b3;
    }

    /* Forms */
    .form-container {
        padding: 50px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .signup-form {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
    }

    .signup-form--wide {
        max-width: 750px;
    }

    .signup-form h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.8rem;
    }

    .form-description {
        text-align: center;
        margin-bottom: 25px;
        color: #666;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #2c2c2cff;
        font-size: 14px;
        margin: 8px;
    }

    .selected-skills,
    .skill-results {
        display: flex;
        width: 100%;
    }

    .skill-item {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        background-color: #03040670;
        width: max-content;
        margin: 3px;
        cursor: pointer;
    }

    .skill-item:hover {
        background: #f0f0f0;
    }

    .skill-tag {
        width: max-content;
        display: inline-block;
        background: #007bff;
        color: white;
        padding: 5px 10px;
        margin: 5px;
        display: flex;
        gap: 10px;
        border-radius: 5px;

        &span {
            background: #4c4c4cf6;
        }
    }

    .form-group label i,
    .step-card h3 i,
    .faq-item h4 i {
        margin-right: 8px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 8px 12px;
        outline: 1px solid #ddd;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        color: #333;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border: 1px solid #0056b3;
    }


    .name-field {
        display: flex;
        gap: 10px;
    }

    .radio-group {
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    .radio-option {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        cursor: pointer;
        background-color: #fff;
        transition: background-color 0.3s;
    }

    .radio-option:not(:last-child) {
        border-bottom: 1px solid #eee;
    }

    .radio-option:hover {
        background-color: #f9f9f9;
    }

    .radio-option input[type="radio"] {
        width: auto;
        margin-right: 12px;
    }

    .radio-option label {
        font-weight: 400;
        cursor: pointer;
    }

    .form-button {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 5px;
        background-color: #007BFF;
        color: #fff;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-button:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }

    .form-footer {
        text-align: center;
        margin-top: 20px;
    }

    .form-footer a {
        color: #007BFF;
        font-weight: bold;
    }

    /* Contact Page */
    .contact-section {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        padding: 60px 20px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .contact-info,
    .contact-form-wrapper {
        flex: 1;
        min-width: 300px;
    }

    .contact-info h3 {
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    .contact-info p {
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .contact-form {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    /* Back Button on Profile Pages */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 20px;
        padding: 8px 16px;
        background-color: transparent;
        color: #007BFF;
        border: 2px solid #eef5ff;
        border-radius: 50px;
        font-size: 0.9rem;
        transition: all 0.3s ease-in-out;
    }

    .back-button:hover {
        background-color: #eef5ff;
        color: #0056b3;
        margin: 15px 0 0 20px;
    }

    /* Background for profile pages */
    .profile-background {
        background-image: url('images/mdnbg.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        /* Keeps the background stationary on scroll */
        background-repeat: no-repeat;
    }

    /* Profile Page */
    .profile-header {
        background-color: #fff;
        padding: 40px 20px;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-color: #ccc;
        /* Placeholder for profile picture */
        overflow: hidden;
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info h1 {
        margin: 0;
        font-size: 2.5rem;
    }

    .profile-info h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 400;
        color: #555;
    }

    .profile-info p {
        margin-top: 5px;
        color: #777;
    }

    .profile-content {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .profile-main {
        flex: 3;
        min-width: 300px;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .profile-sidebar {
        flex: 1;
        min-width: 250px;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .profile-main h3,
    .profile-sidebar h3 {
        font-size: 1.6rem;
        margin-bottom: 20px;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    .gigs-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .gig-card {
        width: 250px;
    }

    .gig-image {
        width: 100%;
        height: 130px;
        background-color: #e0e0e0;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .gig-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .skills-list li {
        background-color: #eef5ff;
        color: #0d7aff;
        padding: 8px 12px;
        border-radius: 20px;
        margin-bottom: 10px;
        display: inline-block;
    }

    /* Featured Freelancers Section */
    .featured-freelancers {
        padding: 80px 20px;
        background-color: #fff;
        text-align: center;
    }

    .featured-freelancers h2 {
        font-size: 2rem;
        margin-bottom: 40px;
    }

    .freelancer-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        max-width: 1000px;
        margin: 0 auto;
    }

    .freelancer-card {
        background: #fff;
        border-radius: 8px;
        padding: 30px 25px;
        width: 240px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .freelancer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .freelancer-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #ccc;
        /* Placeholder for freelancer photo */
        margin: 0 auto 15px auto;
        overflow: hidden;
    }

    .freelancer-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .freelancer-card h3 {
        font-size: 1.4rem;
        margin-bottom: 5px;
    }

    .freelancer-card p {
        color: #666;
        margin-bottom: 15px;
    }

    .profile-link {
        background-color: #eef5ff;
        color: #007BFF;
        padding: 8px 16px;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .profile-link:hover {
        background-color: #dbe9ff;
    }

    /* Benefits Section */
    .benefits-section {
        padding: 80px 20px;
        background: linear-gradient(135deg, #0a192f, #0056b3);
        text-align: center;
    }

    .benefits-section h2 {
        font-size: 2rem;
        margin-bottom: 40px;
        color: #fff;
    }

    .benefits-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
    }

    .benefit-card {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        width: 300px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }

    .benefit-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px auto;
        background-color: #eef5ff;
        /* Placeholder for an icon */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .benefit-icon i {
        font-size: 1.8rem;
        color: #007BFF;
    }

    .benefit-icon.icon-blue {
        background-color: #eef5ff;
    }

    .benefit-icon.icon-blue i {
        color: #007BFF;
    }

    .benefit-icon.icon-purple {
        background-color: #f3e8ff;
    }

    .benefit-icon.icon-purple i {
        color: #9966cc;
    }

    .benefit-icon.icon-green {
        background-color: #e6f8f0;
    }

    .benefit-icon.icon-green i {
        color: #28a745;
    }

    .benefit-card h3 {
        font-size: 1.4rem;
        margin-bottom: 10px;
    }

    /* Testimonials Section */
    .testimonials {
        padding: 80px 20px;
        background-color: #F8F9FA;
        text-align: center;
    }

    .testimonials h2 {
        font-size: 2rem;
        margin-bottom: 40px;
    }

    .testimonial-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        max-width: 1000px;
        margin: 0 auto;
    }

    .testimonial-card {
        background-color: #F8F9FA;
        border-left: 4px solid #007BFF;
        padding: 30px;
        width: 400px;
        text-align: left;
    }

    .testimonial-card .quote {
        font-style: italic;
        color: #555;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .testimonial-card .author {
        font-weight: 600;
        color: #333;
    }

    /* start styling */
    .start {
        position: relative;
        background: url('../images/lighttheme.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center
    }

    .how-it-works-main {
        background: url('images/howitworksc.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    /* How It Works Page (Process Section) */
    .process-section {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        padding: 60px 20px;
        margin: 0 auto;
        background-color: #0056b3;
    }

    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 2rem;
        font-size: 1.2rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    .hero-stats span {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        backdrop-filter: blur(10px);
    }

    .gigs-vs-projects {
        padding: 4rem 2rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .gigs-vs-projects .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 3rem;
        color: #333;
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #0056b3);
        margin: 1rem auto 0;
        border-radius: 2px;
    }

    .comparison-table {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 900px;
        margin: 0 auto;
    }

    .comparison-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 0;
    }

    .comparison-row:nth-child(odd) {
        background: #f8f9fa;
    }

    .feature {
        font-weight: 600;
        padding: 1.5rem 2rem;
        border-right: 1px solid #e9ecef;
        color: #495057;
    }

    .gig-col,
    .project-col {
        padding: 1.5rem 2rem;
        text-align: center;
        font-weight: 500;
    }

    .gig-col {
        background: linear-gradient(135deg, #e3f2fd, #f5faff);
        color: #1976d2;
    }

    .project-col {
        background: linear-gradient(135deg, #f3e5f5, #faf5ff);
        color: #7b1fa2;
    }

    .images-row {
        align-items: center;
    }

    .images-row .gig-col img,
    .images-row .project-col img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .why-section {
        padding: 5rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
    }

    .feature-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .testimonials {
        padding: 5rem 2rem;
        background: #f8f9fa;
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2.5rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .testimonial-card {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }


    .quote-icon {
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .testimonial-card p {
        font-style: italic;
        line-height: 1.7;
        margin-bottom: 2rem;
        font-size: 1.1rem;
        color: #555;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .testimonial-author img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .testimonial-author h4 {
        margin: 0;
        font-size: 1.1rem;
    }

    .testimonial-author span {
        color: #666;
        font-size: 0.9rem;
    }

    .faq-section {
        padding: 5rem 2rem;
        background: white;
    }

    .faq-list {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        margin-bottom: 1.5rem;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        background: white;
        border: 1px solid #e9ecef;
    }

    .faq-question {
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .faq-question:hover {
        background: #f8f9fa;
    }

    .faq-question i.fa-question-circle {
        color: #007bff;
        font-size: 1.2rem;
    }

    .faq-question i.fa-chevron-down {
        margin-left: auto;
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-question i.fa-chevron-down {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .faq-item.active .faq-answer {
        max-height: 200px;
        padding: 1.5rem 2rem;
    }

    .cta-section {
        padding: 5rem 2rem;
        text-align: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('images/gigspace.png') center/cover;
        opacity: 0.1;
        z-index: 0;
    }

    .cta-section>* {
        position: relative;
        z-index: 1;
    }

    .cta-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2.5rem;
    }

    .cta-button {
        padding: 1.2rem 3rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        margin-top: 2.5rem;
    }

    .cta-button.primary {
        background: white;
        color: #007bff !important;
        box-shadow: 0 10px 30px rgba(0, 123, 255, 0.3);
    }

    .cta-button.primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 123, 255, 0.4);
    }

    .cta-button.secondary {
        background: transparent;
        color: white !important;
        border: 2px solid rgba(255, 255, 255, 0.8);
    }

    .cta-button.secondary:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: white;
        transform: translateY(-3px);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    @media (max-width: 768px) {
        .comparison-row {
            grid-template-columns: 1fr;
        }

        .gig-col,
        .project-col {
            border-left: 4px solid #007bff;
            margin-top: 1rem;
        }

        .project-col {
            border-left-color: #7b1fa2;
        }

        .features-grid,
        .testimonials-grid {
            grid-template-columns: 1fr;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .cta-button {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
    }

    .process-title {
        margin: 20px;
        text-align: center;
        color: #007BFF;
        position: relative;
    }


    .process-step h4 i {
        margin-right: 12px;
        color: #007BFF;
    }

    /* Enhanced Process Section - Timeline Styles */

    .process-column {
        flex: 1;
        min-width: 350px;
        background: rgba(255, 255, 255, 0.97);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .process-step {
        margin: 10px;
        position: relative;
        padding-left: 20px;
        z-index: 1;
    }

    .process-step-number {
        width: 30px;
        height: 30px;
        margin-block: 30px;
        background: linear-gradient(135deg, #007BFF, #0056b3);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        transition: transform 0.3s;
    }

    .process-step h4 {
        font-size: 1.4rem;
        color: #2c3e50;
        font-weight: 600;
        transition: color 0.3s;
    }

    .process-step h4 i {
        margin-right: 12px;
        color: #007BFF;
        width: 24px;
    }

    .process-step-details {
        background: rgba(255, 255, 255, 0.7);
        padding: 10px;
        border-radius: 0 8px 8px 0;
        font-size: 0.95rem;
        color: #555;
        line-height: 1.6;
        transition: all 0.3s;
    }

    .process-step:hover .process-step-number {
        transform: scale(1.1);
    }

    .process-step:hover h4 {
        color: #007BFF;
    }

    .process-step:hover .process-step-details {
        background: rgba(0, 123, 255, 0.1);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.2);
    }

    /* Mobile */
    @media (max-width: 768px) {
        .process-section.enhanced {
            flex-direction: column;
            gap: 40px;
        }

        .process-column {
            min-width: auto;
            padding: 40px 30px;
        }

        .process-column::before {
            left: 25px;
            right: 25px;
        }

        .process-step {
            padding-left: 55px;
        }
    }

    /* Workflow Diagram */
    .workflow-diagram {
        margin: 60px auto;
        max-width: 800px;
        text-align: center;
        padding: 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .workflow-flow {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 30px 0;
        flex-wrap: wrap;
        gap: 20px;
    }

    .flow-node {
        background: linear-gradient(135deg, #007BFF, #0056b3);
        color: white;
        padding: 20px 25px;
        border-radius: 15px;
        font-weight: 600;
        min-width: 120px;
        position: relative;
    }

    .flow-arrow {
        font-size: 2rem;
        color: #007BFF;
        margin: 0 10px;
        animation: arrowPulse 2s infinite;
    }

    @keyframes arrowPulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Support Page */
    .support-section {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        padding: 80px 20px;
        background-color: #F8F9FA;
    }

    .support-column {
        flex: 1;
        min-width: 320px;
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
    }

    .support-column h3 {
        font-size: 1.8rem;
        margin-bottom: 30px;
    }

    .faq-item {
        margin-bottom: 25px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }

    .faq-item h4 {
        font-size: 1.2rem;
        margin-bottom: 8px;
    }

    /* Footer */
    .footer {
        background: #1a1a2e;
        color: #fff;
        margin-top: auto;
    }

    .footer-top {
        padding: 60px 20px 40px;
    }

    .footer-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 1.5fr;
        gap: 40px;
    }

    /* Subscriber Section */
    .footer-subscribe p {
        color: #b0b0b0;
        font-size: 0.95rem;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .subscriber-count {
        color: #007BFF !important;
        font-weight: 600;
        font-size: 0.9rem !important;
        margin-bottom: 12px !important;
    }

    .subscriber-count i {
        margin-right: 6px;
    }

    .subscribe-form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .subscribe-form input[type="email"] {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.07);
        color: #fff;
        font-size: 0.95rem;
        outline: none;
        transition: border-color 0.3s, background 0.3s;
    }

    .subscribe-form input[type="email"]::placeholder {
        color: #888;
    }

    .subscribe-form input[type="email"]:focus {
        border-color: #007BFF;
        background: rgba(255, 255, 255, 0.1);
    }

    .subscribe-btn {
        width: 100%;
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        background: #007BFF;
        color: #fff;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    .subscribe-btn:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

    .subscribe-alert {
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .subscribe-success {
        background: rgba(40, 167, 69, 0.15);
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.3);
    }

    .subscribe-error {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .subscribe-info {
        background: rgba(23, 162, 184, 0.15);
        color: #17a2b8;
        border: 1px solid rgba(23, 162, 184, 0.3);
    }

    /* Contact Form Alerts */
    .contact-alert {
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.95rem;
        margin-bottom: 15px;
    }

    .contact-success {
        background: rgba(40, 167, 69, 0.12);
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.3);
    }

    .contact-error {
        background: rgba(220, 53, 69, 0.12);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .contact-info {
        background: rgba(23, 162, 184, 0.12);
        color: #17a2b8;
        border: 1px solid rgba(23, 162, 184, 0.3);
    }

    .footer-col h4 {
        font-size: 1.1rem;
        margin-bottom: 20px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .footer-col ul li {
        margin-bottom: 12px;
    }

    .footer-col ul li a {
        color: #b0b0b0 !important;
        transition: color 0.3s, padding-left 0.3s;
        display: inline-block;
    }

    .footer-col ul li a:hover {
        color: #007BFF !important;
        padding-left: 5px;
    }

    .footer-brand p {
        color: #b0b0b0;
        margin: 15px 0 20px;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .footer-logo {
        width: 140px;
        filter: brightness(0) invert(1);
    }

    .footer-socials {
        display: flex;
        gap: 12px;
    }

    .footer-socials a {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff !important;
        transition: background 0.3s, transform 0.3s;
    }

    .footer-socials a:hover {
        background: #007BFF;
        transform: translateY(-3px);
    }

    .footer-bottom {
        background: #111122;
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .footer-bottom-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 0.9rem;
        color: #888;
    }

    .footer-legal a {
        color: #888 !important;
        margin-left: 20px;
        transition: color 0.3s;
    }

    .footer-legal a:hover {
        color: #007BFF !important;
    }

    /* Team Section on Contact Page */
    .team-section {
        padding: 60px 20px;
        background-color: #F8F9FA;
        text-align: center;
    }

    .team-section h2 {
        font-size: 2rem;
        margin-bottom: 40px;
    }

    .team-card {
        background: #fff;
        border-radius: 8px;
        padding: 25px;
        width: 240px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .log-title {
        margin-block: 30px;
    }

    .back {
        margin-inline: 20px;
        padding: 10px 20px;
        border-radius: 5px;
        background: #0056b3;
        text-transform: uppercase;
    }

    /* gigSpace Brand Heading Styling */
    .gigspace-brand-heading {
        color: #ffffffff !important;
    }

    .gigspace-brand-heading .gig,
    .gigspace-brand-heading .a {
        color: #007BFF;
        /* Blue for 'Gig' and 'a' */
    }

    /* Special styling for brand heading in CTA */
    .cta-section .gigspace-brand-heading {
        padding: 2px 10px;
        border-radius: 8px;
    }

    /* Hamburger Menu */
    .nav-toggle {
        display: none;
        /* Hidden by default */
        padding: .5em;
        background: transparent;
        border: 0;
        cursor: pointer;
        position: absolute;
        right: 1em;
        top: 1.5em;
        z-index: 1001;
    }

    .hamburger {
        display: block;
        position: relative;
    }

    .hamburger,
    .hamburger::before,
    .hamburger::after {
        background: #007BFF;
        width: 2em;
        height: 3px;
        border-radius: 1em;
        transition: transform 250ms ease-in-out;
    }

    .hamburger::before,
    .hamburger::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
    }

    .hamburger::before {
        top: 6px;
    }

    .hamburger::after {
        bottom: 6px;
    }

    .nav--visible .hamburger {
        transform: rotate(.625turn);
    }

    .nav--visible .hamburger::before {
        transform: rotate(90deg) translateX(-6px);
    }

    .nav--visible .hamburger::after {
        opacity: 0;
    }

    /* --- Media Queries for Responsiveness --- */

    /* Tablets and smaller devices */
    @media (max-width: 768px) {

        /* Header and Nav */
        .nav-toggle {
            display: block;
        }

        nav {
            position: absolute;
            background: #fff;
            left: 0;
            right: 0;
            top: 70px;
            /* Position below header */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);

            /* Hide nav by default */
            visibility: hidden;
            height: 0;
            transition: transform 250ms cubic-bezier(.5, 0, .5, 1);
            transform: scaleY(0);
            transform-origin: top;
        }

        .nav--visible {
            visibility: visible;
            height: auto;
            transform: scaleY(1);
        }

        nav ul {
            flex-direction: column;
            padding: 20px;
            gap: 15px;
        }

        nav ul li {
            margin-right: 0;
            text-align: center;
        }

        nav ul li a {
            border-right: none;
            padding: 10px;
            display: block;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .header-btn {
            margin-right: 3.5em;
            /* Make space for hamburger */
        }

        /* General Layout */
        .hero-content h1 {
            font-size: 2.5rem;
            padding: 0 15px;
        }

        .search-bar {
            width: 90%;
        }

        .page-hero {
            height: 300px;
            padding: 0 20px;
        }

        .page-hero-content h1 {
            font-size: 2.2rem;
        }

        .process-section,
        .support-section {
            flex-direction: column;
        }

        .step-card,
        .benefit-card,
        .testimonial-card,
        .freelancer-card {
            width: 100%;
            max-width: 350px;
        }

        /* Footer */
        .footer-grid {
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .footer-brand {
            grid-column: 1 / -1;
            text-align: center;
        }

        .footer-socials {
            justify-content: center;
        }

        .footer-bottom-inner {
            flex-direction: column;
            text-align: center;
        }

        .footer-legal a {
            margin: 0 10px;
        }
    }

    @media (max-width: 480px) {
        .footer-grid {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .footer-col h4 {
            margin-bottom: 15px;
        }
    }

    /* Stats Section Styles */
    .stats-section {
        padding: 80px 20px;
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.1), rgba(0, 86, 179, 0.1));
        text-align: center;
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
    }

    .stats-card {
        background: linear-gradient(135deg, #fff, #f8f9ff);
        padding: 40px 20px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 123, 255, 0.15);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        border: 1px solid rgba(0, 123, 255, 0.2);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s;
    }

    .stats-card:hover::before {
        left: 100%;
    }

    .stats-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 123, 255, 0.25);
    }

    .stats-icon {
        font-size: 2.5rem;
        color: #007bff;
        margin-bottom: 15px;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: #0056b3;
        margin-bottom: 10px;
    }

    .stats-label {
        font-size: 1.1rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-container {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .stats-card {
            padding: 30px 15px;
        }

        .stats-number {
            font-size: 2rem;
        }

        .stats-icon {
            font-size: 2.5rem;
        }
    }
</style>
<style>
    .view-profile-page {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
        background: url('images/lighttheme.png') center/cover fixed;
        background-size: cover;
    }

    .section-title {
        font-size: 1.5rem;
        margin: 30px 0 15px;
        color: #222;
    }

    .gig-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .gig-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .gig-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .gig-body {
        padding: 15px;
    }

    .gig-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .gig-header h4 {
        font-size: 1.1rem;
        color: #222;
    }

    .gig-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .gig-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #888;
        margin-bottom: 8px;
    }

    .gig-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #4f46e5;
        margin-bottom: 12px;
    }

    .gig-actions {
        display: flex;
        gap: 10px;
    }

    .gig-btn {
        flex: 1;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .gig-btn.success {
        background: #4f46e5;
        color: #fff !important;
    }

    .gig-btn.success:hover {
        background: #3730a3;
    }

    .review-card {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .star-rating {
        color: #f5b041;
    }

    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .skills-list {
        list-style: none;
        padding: 0;
    }

    .skills-list li {
        background-color: #eef5ff;
        color: #0d7aff;
        padding: 8px 14px;
        border-radius: 20px;
        margin: 0 8px 10px 0;
        display: inline-block;
        font-size: 0.9rem;
    }

    .profile-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #007BFF;
        color: #fff !important;
        border-radius: 6px;
        font-weight: 600;
        margin-top: 10px;
    }

    .profile-btn:hover {
        background: #0056b3;
    }
</style>

<style>
    body {
        background: #f5f7fb;
    }

    .freelancers-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 50px 25px;
    }

    .page-header {
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 12px;
        letter-spacing: -1px;
    }

    .page-header p {
        color: #6b7280;
        font-size: 1rem;
    }

    .search-section {
        margin-bottom: 35px;
    }

    .search-form {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .search-input-wrapper {
        flex: 1;
        position: relative;
    }

    .search-input-wrapper i {
        position: absolute;
        top: 50%;
        left: 18px;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 15px;
    }

    .search-input {
        width: 100%;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        background: white;
        padding: 15px 18px 15px 50px;
        font-size: 15px;
        outline: none;
        transition: .3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
    }

    .search-input:focus {
        border-color: #4f46e5;
        box-shadow:
            0 0 0 4px rgba(79, 70, 229, 0.08),
            0 10px 25px rgba(79, 70, 229, 0.08);
    }

    .search-btn {
        padding: 15px 25px;
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg, #3831bf, #4f3aed);
        color: white;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: .3s ease;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.20);
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 24px rgba(79, 70, 229, 0.30);
    }

    @media(max-width:768px) {

        .search-form {
            flex-direction: column;
            align-items: stretch;
        }

        .search-btn {
            width: 100%;
        }

    }

    .freelancers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 20px;
    }

    .freelancer-card {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        border: 1px solid #edf2f7;
        transition: all .35s ease;
        display: flex;
        flex-direction: column;
    }

    .freelancer-card:hover {
        transform: translateY(-8px);
        box-shadow:
            0 20px 40px rgba(15, 23, 42, 0.08),
            0 6px 12px rgba(15, 23, 42, 0.05);
    }

    .gig-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: #f1f5f9;
    }

    .freelancer-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        padding: 22px 24px 18px;
    }

    .freelancer-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #eef2ff;
        box-shadow: 0 6px 14px rgba(79, 70, 229, 0.15);
    }

    .freelancer-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 5px;
    }

    .freelancer-meta {
        color: #6b7280;
        font-size: 13px;
    }

    .freelancer-body {
        padding: 0 24px 22px;
        flex: 1;
    }

    .freelancer-title {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 18px;
        line-height: 1.5;
    }

    .gig-preview {
        background: #f8fafc;
        border: 1px solid #edf2f7;
        border-radius: 18px;
        padding: 16px;
        margin-bottom: 18px;
        transition: .3s ease;
    }

    .gig-preview:hover {
        background: #f1f5f9;
    }

    .gig-label {
        font-size: 12px;
        color: #6b7280;
        display: block;
        margin-bottom: 6px;
    }

    .gig-title {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        line-height: 1.5;
        margin-bottom: 8px;
    }

    .gig-category {
        color: #6366f1;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .gig-price {
        font-size: 1.1rem;
        font-weight: 800;
        color: #111827;
    }

    .meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .category-tag {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #f59e0b;
        font-size: 14px;
        font-weight: 700;
    }

    .freelancer-footer {
        border-top: 1px solid #edf2f7;
        padding: 18px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .completed-orders {
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
    }

    .profile-link {
        background: linear-gradient(135deg, #4f46e5,#2c13e4);
        color: #fff !important;
        text-decoration: none;
        padding: 11px 18px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        transition: .3s ease;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.25);
    }

    .profile-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 24px rgba(79, 70, 229, 0.35);
    }

    .no-results {
        background: white;
        border-radius: 24px;
        padding: 70px 30px;
        text-align: center;
        border: 1px solid #edf2f7;
    }

    .no-results h2 {
        color: #111827;
        margin-bottom: 10px;
    }

    .no-results p {
        color: #6b7280;
    }

    @media(max-width: 768px) {

        .freelancers-page {
            padding: 35px 16px;
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .freelancers-grid {
            gap: 18px;
        }

        .gig-image {
            height: 190px;
        }

        .freelancer-header {
            padding: 18px 18px 14px;
        }

        .freelancer-body {
            padding: 0 18px 18px;
        }

        .freelancer-footer {
            padding: 16px 18px;
        }

        .profile-link {
            padding: 10px 14px;
            font-size: 13px;
        }
    }
</style>

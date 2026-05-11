# GigSpace 🚀 Freelance Marketplace Platform

## 📖 Project Overview
**GigSpace** is a full-featured freelance marketplace web application that connects clients seeking services with skilled freelancers. Inspired by platforms like Upwork and Fiverr, it enables:

- **Clients**: Post projects with budgets/deadlines, receive bids, hire freelancers, manage orders, and communicate via integrated messaging.
- **Freelancers**: Create profiles with skills/ratings, offer pre-packaged **Gigs** for direct purchase, bid on projects, track earnings, and chat with clients.
- **Key Workflows**: Project bidding → Order creation → Messaging → Completion/Reviews.

The platform supports roles for **clients** and **freelancers**, real-time unread message counts, profile images, skill matching, and newsletter subscriptions. Built for scalability, it handles user auth, file uploads (profiles/gigs), and dynamic dashboards.

**Current Status**: Functional prototype (XAMPP-local). Not yet production-hardened.

## 🛠️ Technology Stack
- **Backend**: PHP 7+ (procedural style, native sessions)
- **Database**: MySQL 8+ (mysqli extension, DB: `gigspace`)
- **Frontend**: HTML5, CSS3 (responsive grids), Vanilla JS (AJAX forms), Font Awesome
- **Server**: Apache (XAMPP), Windows 11 compatible
- **Assets**: Images/videos in `/images/`, uploads in `/dashboards/uploads/`
- **No Dependencies**: Self-contained, no Composer/NPM/Packages

**DB Config** (`config/db_config.php`):
```php
$hostname = 'localhost';
$user = 'mathew';  // CHANGE IN PROD!
$pwd = 'mathew123';  // CHANGE IN PROD!
$database = 'gigspace';
$conn = mysqli_connect($hostname, $user, $pwd, $database);
```

## 🏗️ System Architecture
**3-Tier MVC-like Structure** (Custom implementation):

```
┌─────────────────────┐    ┌─────────────────────┐    ┌─────────────────────┐
│   Presentation      │    │      Logic          │    │       Data          │
│   (Views/Pages)     │◄──►│   (Controllers)     │◄──►│   (MySQL Queries)   │
├─────────────────────┤    ├─────────────────────┤    ├─────────────────────┤
│ - Root: index.php,  │    │ - process/*.php     │    │ - config/db_config  │
│   hire.php, etc.    │    │   (AJAX/Forms)      │    │ - Direct mysqli_*   │
│ - dashboards/*      │    │ - templates/header  │    │                     │
│ - auth/components   │    │   /footer (shared)  │    └─────────────────────┘
└─────────────────────┘    └─────────────────────┘
         │
         ▼
┌─────────────────────┐
│     Sessions        │  (user_id, role for auth/routing)
└─────────────────────┘
```

- **Routing**: File-based (no router; query params like `?id=X`).
- **Auth**: Session-based (`$_SESSION['user_id']`, `$_SESSION['role']`).
- **Data Flow**: Forms/AJAX → process/*.php → SQL queries → Redirect/JSON.
- **Shared**: `templates/header.php` (nav/auth), `config/init.php` (session_start).

## 📁 File List
Core files (80+ total, excluding images/uploads):
- **Root**: `contact_us.php`, `hire.php`, `how-it-works.php`, `index.php`, `order.php`, `PROJECT_REPORT.txt`, `projects.php`, `README.md`, `start.php`, `view_freelancer.php`
- **assets/**: `styling.php`
- **auth/**: `auth.php`, `logout.php`
- **components/**: `component_header.php`, `login.php`, `signup-freelancer.php`, `signup.php`
- **config/**: `db_config.php`, `init.php`
- **dashboards/**: `client.php`, `dashboard.php`, `dashboardstyle.php`, `freelancer.php`, `client/*` (bids.php, clientStyle.php, cont.php, gigs.php, messages.php, orders.php, overview.php, profile.php, projects.php, projects_page.php), `freelancer/*` (earnings.php, freelancerStyle.php, gigs.php, messages.php, orders.php, overview.php, profile.php, projects.php), `uploads/*` (images)
- **images/**: 30+ assets (logos, categories like web.jpeg, graphic.jpeg)
- **process/**: `accept_bid.php`, `contact_form.php`, `create_project.php`, `get_messages.php`, `get_unread_count.php`, `place_bid.php`, `reject_bid.php`, `search_skills.php`, `send_message.php`, `subscribe.php`, `update_project_status.php`
- **templates/**: `footer.php`, `header.php`

## ✨ Features & Implementation
| Feature | Description | Key Files |
|---------|-------------|-----------|
| **Auth & Roles** | Signup/login for client/freelancer | `auth/*`, `components/signup*.php` |
| **Profiles** | Bios, images, skills, ratings/reviews | `dashboards/*/profile.php`, `view_freelancer.php` |
| **Gigs** | Freelancer services w/ images | `dashboards/freelancer/gigs.php`, `order.php` |
| **Projects** | Post/browse w/ budgets | `hire.php`, `process/create_project.php`, `projects.php` |
| **Bidding** | Bid/accept/reject on projects | `process/place_bid.php`, `accept_bid.php`, `reject_bid.php` |
| **Orders** | From gigs/projects, w/ requirements | `order.php`, `dashboards/*/orders.php` |
| **Messaging** | Per-order chats, unread counts | `process/send_message.php`, `get_messages.php`, `dashboards/*/messages.php` |
| **Dashboards** | Overview, earnings, projects | `dashboards/client/*`, `dashboards/freelancer/*` |
| **Search** | Skills/projects | `process/search_skills.php` |
| **Subscribe** | Newsletter | `process/subscribe.php`, `templates/footer.php` |
| **Uploads** | Profiles/gigs | `dashboards/uploads/*` |

## 🗄️ Database Schema (matches `gigspace.sql`)
**Manual setup** (no migrations). Create DB `gigspace`, then import `gigspace.sql` into MySQL.

### Core tables
- `users` — authentication (`role` enum: `client` / `freelancer`, `password`, `is_active`, etc.)
- `profiles` — public user profile (`full_name`, `profile_image`, `bio`, `country`, `phone_number`, `university`)
- `freelancer_profiles` — freelancer stats (`title`, `experience_level`, `rating`, `total_reviews`, `completed_orders`)
- `skills` — skill catalog
- `freelancer_skills` — join table between `freelancer_profiles` and `skills`
- `categories` — job categories
- `projects` — client projects (`budget_min`, `budget_max`, `deadline`, `status`: `open|closed|completed`)
- `gigs` — freelancer gigs (`price` is present in `gigs`, `delivery_time`, `revisions`, `status`: `active|paused|deleted`)
- `bids` — proposals on projects (`status`: `pending|accepted|rejected`, `delivery_time` in days)
- `orders` — hired work for either a project or a gig (contains `project_id` and `gig_id` as nullable)
- `conversations` — chat threads per `order_id`
- `messages` — chat messages (`message_type`: `text|image|file`, `attachment_url`, `is_read`)
- `reviews` — feedback per order (`rating` 1..5 check)
- `gig_images` — images attached to gigs
- `attachments` — generic file attachments (linked to a user)
- `subscribers` — newsletter subscribers

### Key relationships (high level)
- `users` → `profiles`
- `users` → `freelancer_profiles`
- `freelancer_profiles` ↔ `skills` via `freelancer_skills`
- `projects` → `bids` and `orders`
- `gigs` → `gig_images` and `orders`
- `orders` → `conversations` → `messages`
- `reviews` references `reviewer_id` and `reviewee_id`

## 🚀 Setup & Running
1. Install XAMPP, start **Apache** and **MySQL**.
2. Create a MySQL database named `gigspace`.
3. Import `gigspace.sql` into that database (phpMyAdmin → **Import**).
4. Update `config/db_config.php` with your MySQL credentials.
5. Access: `http://localhost/gigspace/`
6. Test: Signup client/freelancer → Post gig/project → Bid/order → Message.

**Demo Command**: `start http://localhost/gigspace/index.php`

## 🔒 Security Considerations
- **Vulns**: SQLi (interpolated vars), XSS (incomplete escaping), weak uploads.
- **Fixes**: PDO/prepared stmts, `htmlspecialchars()`, CSRF tokens, validate uploads.
- Exposed DB creds: Rotate immediately.

## 🌟 Strengths & Future Work
**Strengths**: Intuitive UX, complete core flows, responsive, media-rich.

**Improvements**:
- Framework (Laravel).
- Payments (Stripe).
- Real-time chat (WebSockets).
- Admin panel, analytics.
- API (REST/GraphQL).
- Docker/Deployment (Heroku/Vercel).

**Contribute**: Fork, PR to `blackboxai/readme-update`.


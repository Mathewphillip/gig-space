<!-- overview  and overall styles -->
<style>
    img{
        width: 100%;
        height: auto;
        position: relative;
    }
    /* LAYOUT */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }

    /* SIDEBAR */
    .sidebar {
        width: 260px;
        background: #111827;
        color: #fff;
        padding: 20px;
    }

    .sidebar h2 {
        color: #4f46e5;
        margin-bottom: 25px;
    }

    .sidebar ul {
        list-style: none;
    }

    .sidebar ul li {
        padding: 12px;
        margin: 5px 0;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }
    .sidebar ul li:hover {
        background: #1f2937;
    }
    /* MAIN AREA */
    .main {
        flex: 1;
        padding: 25px;
    }

    .section {
        display: none;
    }

    .section.active {
        display: block;
    }

    /* active sidebar */
    .sidebar li.active {
        background: #4f46e5;
        color: #fff;
        border-radius: 6px;
    }

    .actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* BUTTON BASE */
    .btn {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;

        padding: 12px 14px;
        border: none;
        border-radius: 10px;

        background: #f9fafb;
        color: #111827;

        font-size: 14px;
        font-weight: 600;

        cursor: pointer;

        transition: 0.25s ease;

        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
    }

    /* HOVER EFFECT */
    .btn:hover {
        background: #4f46e5;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.25);
    }

    /* ICON STYLE (if you add icons later) */
    .btn i {
        font-size: 16px;
        opacity: 0.9;
    }

    /* TOP BAR */
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .topbar h1 {
        font-size: 26px;
    }

    .user-box {
        background: #fff;
        padding: 10px 15px;
        border-radius: 10px;
        min-width: 300px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* STATS GRID */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: #fff;
        padding: 18px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .stat-card h4 {
        font-size: 13px;
        color: #666;
    }

    .stat-card h2 {
        margin-top: 8px;
    }

    /* MAIN GRID */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    /* BIG SECTIONS */
    .panel {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .panel h3 {
        margin-bottom: 15px;
        color: #000;
    }

    .panel span {
        font-size: 15px;
        font-weight: 400;
    }

    /* GIG LIST */
    .gig {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .gig:last-child {
        border: none;
    }

    /* ACTIVITY FEED */
    .activity {
        font-size: 14px;
        margin-bottom: 10px;
        color: #444;
    }

    /* MESSAGES */
    .message {
        padding: 10px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    .message small {
        color: #777;
    }

    /* EARNINGS BOX */
    .earnings {
        text-align: center;
    }

    .earnings h2 {
        font-size: 28px;
        color: #10b981;
    }

    .profile-box {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* LEFT SIDE IMAGE */
    .profile-left {
        width: 150px;
        height: 100%;
    }
    .profile-image-box img,
    .profile-left img {
        width: 100%;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #4f46e5;
    }

    /* RIGHT SIDE INFO */
    .profile-right {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .profile-right .fullname {
        margin: 0;
        font-size: 15px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .username {
        font-size: 14px;
        color: #666;
    }

    .email {
        font-size: 12px;
        color: #888;
        margin: 0;
    }

    /* ROLE */
    .role-badge {
        display: inline-block;
        padding: 5px 20px;
        background: #4f46e5;
        color: #fff;
        font-size: 14px;
        border-radius: 5px;
        width: fit-content;
        margin-top: 4px;
    }
    .role-badge.client{
        background:#ff9900;
    }

    /* BUTTON */
    .profile-edit-btn {
        margin-top: 8px;
        padding: 6px 10px;
        background: #111827;
        color: #fff;
        border-radius: 6px;
        font-size: 12px;
        text-decoration: none;
        width: fit-content;
        cursor: pointer;
    }

    .profile-edit-btn:hover {
        background: #4f46e5;
    }

    /* RESPONSIVE */
    @media(max-width:1000px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    .orders-panel {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* ORDER CARD */
    .order-card {
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 15px;
        border-radius: 12px;

        background: #fff;
        border: 1px solid #e5e7eb;

        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: 0.2s ease;
    }

    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    /* LEFT SIDE */
    .order-left h4 {
        font-size: 15px;
        margin-bottom: 4px;
    }

    .order-left p {
        font-size: 13px;
        color: #555;
    }

    .order-left small {
        font-size: 12px;
        color: #888;
    }

    /* STATUS CENTER */
    .order-middle {
        display: flex;
        align-items: center;
    }

    /* RIGHT ACTIONS */
    .order-right {
        display: flex;
        gap: 8px;
    }

    /* ORDER BUTTONS */
    .order-btn {
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        font-size: 12px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .order-btn:hover {
        background: #4f46e5;
        color: #fff;
        border-color: #4f46e5;
    }

    @media(max-width:600px) {
        .sidebar {
            display: none;
        }
    }

    .image-upload-btn {
        padding: 10px 15px;
        background-color: #111827;
        color: white;
        user-select: none;
        cursor: pointer;
        border-radius: 5px;
        text-align: center;
        font-size: 14px;
    }
</style>
<!-- gig styling -->
<style>
    .gigs-panel {
        padding: 20px;
        font-family: Arial, sans-serif;
    }
    /* HEADER */
    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .panel-header h3 {
        font-size: 22px;
        font-weight: 700;
    }

    .gig-form {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        transition: 0.3s ease;
    }

    .gig-form form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .gig-form input,
    .gig-form select,
    .gig-form textarea {
        padding: 12px 14px;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: 0.3s ease;
        background: #fafafa;
    }

    .gig-form input:focus,
    .gig-form select:focus,
    .gig-form textarea:focus {
        border-color: #6c63ff;
        background: #fff;
    }

    .gig-form textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .upload-box {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        display: block;
        margin-bottom: 15px;
    }

    .image-upload-box {
        border: 2px dashed #ccc;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        background: #fafafa;
        transition: 0.3s ease;
    }

    .image-upload-box:hover {
        border-color: #6c63ff;
        background: #f5f5ff;
    }

    .image-upload-box label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    .preview-box {
        margin-top: 10px;
    }

    .preview-box img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #eee;
    }

    .btn {
        padding: 10px 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .btn.primary {
        background: #6c63ff;
        color: white;
    }

    .btn.primary:hover {
        background: #574fd6;
    }

    .btn.full {
        width: 100%;
    }

    .gigs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 10px;
    }

    .gig-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease;
    }

    .gig-card:hover {
        transform: translateY(-5px);
    }
    .gig-description{

    }
    .gig-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .gig-body {
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .gig-body h4 {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .gig-meta {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: #555;
    }

    /* STATUS */
    .gig-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
        border: 1px solid #c3e6cb;
    }

    .status-active {
        color: white;
        background: #28a745;
    }
    .status-paused {
        background: #ffc107;
    }
    .gig-actions {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        gap: 5px;
    }

    /* BASE ACTION BUTTON */
    .gig-btn {
        flex: 1;
        padding: 6px;
        font-size: 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        background: #eee;
        transition: 0.3s ease;
    }

    .gig-btn:hover {
        background: #ddd;
    }

    /* EDIT */
    .gig-btn.edit {
        background: #3498db;
        color: white;
    }

    .gig-btn.edit:hover {
        background: #217dbb;
    }

    /* PAUSE */
    .gig-btn.pause {
        background: #f39c12;
        color: white;
    }

    /* ACTIVATE */
    .gig-btn.success {
        background: #05eb2bff;
        color: white;
    }

    /* DELETE */
    .gig-btn.danger {
        background: #ff1919ff;
        color: white;
    }

    .gig-btn.danger:hover {
        background: #c0392b;
    }

    .panel {
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
    }

    .gigs-panel-layout {
        display: grid;
        grid-template-columns: 500px 1fr;
        gap: 25px;
        align-items: start;
    }


    .gig-form {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    /* form spacing */
    .gig-form form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }


    .gigs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
    }

    /* makes cards breathe better */
    .gig-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
        transition: 0.3s ease;
    }

    .gig-card:hover {
        transform: translateY(-4px);
    }
  
    @media (max-width: 1000px) {
        .gigs-panel-layout {
            grid-template-columns: 1fr;
        }

        .gig-form {
            position: relative;
            top: auto;
        }
    }
</style>
<!-- orders.php styling -->
<style>
    .orders-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .order-card {
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 15px;
        border-radius: 10px;

        background: #fff;
        border: 1px solid #eee;

        transition: 0.2s;
    }

    .order-card:hover {
        transform: translateY(-2px);
    }

    .order-left h4 {
        font-size: 14px;
        margin-bottom: 4px;
    }

    .order-left p {
        font-size: 13px;
        color: #555;
    }

    .order-left small {
        font-size: 12px;
        color: #888;
    }

    /* STATUS */
    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        color: #fff;
    }

    /* STATUS COLORS */
    .status.pending {
        background: #f59e0b;
    }

    .status.accepted {
        background: #3b82f6;
    }

    .status.in_progress {
        background: #6366f1;
    }

    .status.delivered {
        background: #10b981;
    }

    .status.completed {
        background: #059669;
    }

    .status.cancelled {
        background: #ef4444;
    }

    /* BUTTONS */
    .order-btn {
        padding: 6px 10px;
        border: none;
        border-radius: 6px;
        background: #f3f4f6;
        cursor: pointer;
        font-size: 12px;
    }

    .order-btn:hover {
        background: #4f46e5;
        color: #fff;
    }

    .order-btn.success {
        background: #10b981;
        color: #fff;
    }

    .order-btn.primary {
        background: #4f46e5;
        color: #fff;
    }
</style>
<!-- messages.php styling -->
<style>
    .messages-container {
        display: flex;
        height: 500px;
        border: 1px solid #eee;
        border-radius: 10px;
        overflow: hidden;
    }

    /* LEFT SIDE */
    .conversations {
        width: 30%;
        border-right: 1px solid #eee;
        padding: 10px;
        overflow-y: auto;
        background: #fafafa;
    }

    .conversation-item {
        display: block;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        text-decoration: none;
        color: #000;
        transition: 0.2s;
    }

    .conversation-item:hover {
        background: #e5e7eb;
    }

    /* RIGHT SIDE */
    .chat-area {
        width: 70%;
        display: flex;
        flex-direction: column;
    }

    /* HEADER */
    .chat-header {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    /* MESSAGES */
    .chat-messages {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
    }

    .empty-chat {
        text-align: center;
        color: #888;
        margin-top: 50px;
    }

    /* INPUT */
    .chat-input {
        display: flex;
        padding: 10px;
        border-top: 1px solid #eee;
    }

    .chat-input input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .chat-input button {
        margin-left: 8px;
        padding: 8px 12px;
        border: none;
        background: #4f46e5;
        color: #fff;
        border-radius: 6px;
        cursor: pointer;
    }
</style>

<!-- earnings.php -->
<style>
    .earnings-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .earning-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .earning-card h4 {
        font-size: 14px;
        color: #555;
    }

    .earning-card h2 {
        margin-top: 8px;
        color: #4f46e5;
    }

    /* TRANSACTIONS */
    .transactions {
        background: #fff;
        padding: 15px;
        border-radius: 10px;
    }

    .transaction {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
</style>

<!-- profile.php -->
<style>
    .p-image-btn{
        min-width: 250px;
    }
    .profile-image-box{
        height: 150px;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .profile-image-box img{
        width: 150px;
        height: 150px;
    }
    .settings-form {
        max-width: 600px;
    }

    .form-row {
        margin-bottom: 12px;
        display: flex;
        flex-direction: column;
    }

    .form-row label {
        font-size: 13px;
        margin-bottom: 5px;
        color: #555;
    }

    .form-row input,
    .form-row textarea {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }
    .settings-form h4 {
        margin: 20px 0 10px;
        color: #4f46e5;
    }
    .success {
        color: green;
    }
    .error {
        color: red;
    }
    .field-container{
        display: flex;
        width: 100%;
        gap: 20px;
    }

    /* UNREAD MESSAGE BADGE */
    .msg-badge {
        background: #ef4444;
        color: #fff;
        font-size: 11px;
        font-weight: bold;
        padding: 2px 7px;
        border-radius: 10px;
        margin-left: 6px;
        vertical-align: middle;
    }
</style>

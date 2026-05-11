<style>
        body { background: #f8fafc; }
        .post-project-container {
            margin: 0 auto;
            padding: 40px 20px;
        }
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .page-header h1 {
            color: #1e293b;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .page-header p {
            color: #64748b;
            font-size: 1.1rem;
        }
        .page-nav {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .page-nav a {
            padding: 12px 24px;
            background: #4f46e5;
            color: white !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s;
        }
        .page-nav a:hover {
            background: #3730a3;
        }
        .gig-form {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .gig-form h4 {
            color: #1e293b;
            margin-bottom: 25px;
            font-size: 1.5rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .btn.primary.full {
            width: 100%;
            padding: 16px;
            font-size: 1.1rem;
            background: #103ab9;
            border: none;
        }
        .btn.primary.full:hover {
            background: #052e96;
        }
        .success-msg {
            background: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
        }
        .error-msg {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
        }
        .projects-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }
       
        .panel {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .post-project-container { padding: 20px 15px; }
            .gig-form { padding: 25px; }
            .page-header h1 { font-size: 2rem; }
            .form-grid { grid-template-columns: 1fr; }
            .projects-layout { grid-template-columns: 1fr; }
        }
</style>
<style>
    .order-btn {
        background: #4f46e5;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s;
    }
    .order-btn:hover {
        background: #3730a3 !important;
    }
    .order-btn.success {
        background: #10b981;
    }
    .order-btn.success:hover {
        background: #059669;
    }
    .status {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }
    .status.open { background: #10b981; color: #fff; }
    .status.closed { background: #6b7280; color: #fff; }
    .status.completed { background: #059669; color: #fff; }
    .status.pending { background: #f59e0b; color: #fff; }
    .status.accepted { background: #3b82f6; color: #fff; }
    .status.rejected { background: #ef4444; color: #fff; }
    .panel-header {
        margin-bottom: 20px;
    }
    .panel-header h3 {
        margin: 0;
        color: #1e293b;
    }

    /* Payments Panel */
    .payments-panel, .earnings-stats {
        text-align: center;
    }
    .earning-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 24px;
        border-radius: 16px;
        margin: 12px;
    }
    .earning-card h4 {
        margin: 0 0 8px 0;
        opacity: 0.9;
        font-size: 14px;
    }
    .earning-card h2 {
        margin: 0;
        font-size: 28px;
    }
    .earning-card p {
        margin: 4px 0 0 0;
        opacity: 0.8;
        font-size: 12px;
    }
    .transactions {
        margin-top: 24px;
    }
    .transaction {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        margin-bottom: 12px;
    }
    .order-right {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .projects-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
    @media (max-width: 768px) { .projects-layout { grid-template-columns: 1fr; } }

    /* Ensure client dashboard topbar stays aligned (not left-shifted) */
    .main .dashboard-topbar { width: 100%; }
    .main .dashboard-topbar .topbar { width: 100%; justify-content: space-between; align-items: center; }
    .main .dashboard-topbar { position: sticky; top: 0; z-index: 999; background: #f8fafc; padding-bottom: 10px; }
</style>
<style>
    .projects-list {
        max-height: 600px;
        overflow-y: auto;
    }

    .project-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .project-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .project-header h4 {
        margin: 0;
        color: #1f2937;
    }

    .status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status.open {
        background: #dbeafe;
        color: #1e40af;
    }

    .status.closed {
        background: #f3f4f6;
        color: #6b7280;
    }

    .project-details p {
        font-weight: 400;
        margin: 5px;
        color: #6b7280;
    }

    .project-bids {
        background: #f9fafb;
        padding: 12px;
        border-radius: 8px;
        margin: 16px 0;
    }

    .bids-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .bid-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
    }

    .project-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn.small {
        padding: 8px 16px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .projects-layout {
            grid-template-columns: 1fr;
        }

        .project-actions {
            justify-content: flex-start;
        }
    }
</style>

<style>
    /* Freelancers listing */
    .freelancers-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    @media (max-width: 1024px) {
        .freelancers-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .freelancers-grid { grid-template-columns: 1fr; }
    }

    .freelancer-card {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .freelancer-card-inner {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        height: 100%;
        transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
    }

    .freelancer-card:hover .freelancer-card-inner {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.10);
        border-color: #c7d2fe;
    }

    .freelancer-avatar {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #4f46e5;
        background: #f3f4f6;
    }

    .freelancer-card-inner {
        display: flex;
        gap: 14px;
        align-items: center;
    }

    .freelancer-info h4 {
        margin: 0;
        color: #111827;
        font-size: 15px;
        line-height: 1.25;
    }

    .freelancer-title {
        margin: 6px 0 8px;
        color: #6b7280;
        font-size: 13px;
    }

    .freelancer-meta {
        margin: 0;
        font-size: 12px;
        color: #6b7280;
    }

    .freelancer-rating {
        margin: 10px 0 0;
        display: flex;
        gap: 8px;
        align-items: baseline;
        flex-wrap: wrap;
    }

    .star-rating {
        color: #f59e0b;
        font-size: 12px;
        letter-spacing: 1px;
    }

    .freelancer-rating strong {
        color: #111827;
        font-size: 13px;
    }
</style>


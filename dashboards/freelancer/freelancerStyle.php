<style>
    /* Freelancer Projects Layout */
    .projects-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 30px;
    }

    .projects-left {
        /* My Bids */
    }

    .projects-right {
        /* Open Projects */
    }

    .freelancer-panel {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
        border: 1px solid #f1f5f9;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
    }

    .panel-header h3 {
        margin: 0;
        color: #1e293b;
        font-size: 22px;
        font-weight: 700;
    }

    .panel-header .view-all {
        color: #4f46e5;
        font-size: 14px;
        text-decoration: none;
    }

    .panel-header .view-all:hover {
        text-decoration: underline;
    }

    .project-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        transition: all 0.2s ease;
    }

    .project-card:hover {
        border-color: #4f46e5;
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.15);
        transform: translateY(-2px);
    }

    .project-title {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .project-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .project-category {
        background: #eff6ff;
        color: #1e40af;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .project-budget {
        font-weight: 700;
        color: #059669;
        font-size: 16px;
    }

    .bid-btn {
        background: linear-gradient(135deg, #4f46e5, #3730a3);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .bid-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
    }

    .bid-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .bid-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .bid-accepted {
        background: #d1fae5;
        color: #059669;
    }

    .bid-rejected {
        background: #fee2e2;
        color: #dc2626;
    }

    .empty-state {
        text-align: center;
        color: #6b7280;
        padding: 60px 20px;
    }

    .empty-state h4 {
        color: #374151;
        margin-bottom: 8px;
    }

    @media (max-width: 1024px) {
        .projects-layout {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .freelancer-panel {
            padding: 20px;
        }

        .panel-header h3 {
            font-size: 20px;
        }
    }
</style>

<!-- projects -->
<style>
        /* Bid Form Styles */
        .bid-form {
            background: #f8fafc;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
        }

        .bid-price-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group .currency {
            position: absolute;
            left: 16px;
            color: #6b7280;
            font-weight: 600;
            z-index: 1;
            font-size: 16px;
        }

        .input-group .unit {
            position: absolute;
            right: 16px;
            color: #6b7280;
            font-weight: 500;
            z-index: 1;
        }

        .bid-form input[type="number"] {
            padding: 16px 16px 16px 40px !important;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            background: white;
        }

        .bid-form input[type="number"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .bid-form textarea {
            padding: 16px !important;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            line-height: 1.6;
            resize: vertical;
            min-height: 140px;
            font-family: inherit;
        }

        .bid-form textarea:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .bid-submit-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            font-weight: 700 !important;
            font-size: 16px !important;
            padding: 18px !important;
            border-radius: 12px !important;
            transition: all 0.3s ease !important;
        }

        .bid-submit-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4) !important;
        }

        /* Status styles */
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status.open {
            background: #10b981;
            color: #fff;
        }

        .status.closed {
            background: #6b7280;
            color: #fff;
        }

        .status.completed {
            background: #059669;
            color: #fff;
        }

        .status.pending {
            background: #f59e0b;
            color: #fff;
        }

        .status.accepted {
            background: #3b82f6;
            color: #fff;
        }

        .status.rejected {
            background: #ef4444;
            color: #fff;
        }

        @media (max-width: 768px) {
            .bid-price-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
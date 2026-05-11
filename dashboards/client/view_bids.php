<?php
include('../../config/init.php');
include('../../config/db_config.php');
include('../../auth/auth.php'); 

$user_id = $_SESSION['user_id'];

// Filters
$project_id = (int) ($_GET['project_id'] ?? 0);
$status_filter = $_GET['status'] ?? 'all';

// Base query
$sql = "
    SELECT bids.*, 
           projects.id as project_id, projects.title as project_title, projects.status as project_status,
           freelancer_profiles.user_id as freelancer_user_id, 
           users.username as freelancer_username
    FROM bids 
    JOIN projects ON bids.project_id = projects.id
    JOIN freelancer_profiles ON bids.freelancer_id = freelancer_profiles.id
    JOIN users ON freelancer_profiles.user_id = users.id
    WHERE projects.client_id = $user_id
";

$params = [];
if ($project_id > 0) {
    $sql .= " AND projects.id = $project_id";
}
if ($status_filter !== 'all') {
    $sql .= " AND bids.status = '" . mysqli_real_escape_string($conn, $status_filter) . "'";
}

$sql .= " ORDER BY bids.id DESC, bids.amount ASC";

$bids_query = mysqli_query($conn, $sql);
$bids = [];
while ($b = mysqli_fetch_assoc($bids_query)) {
    $bids[] = $b;
}

// Stats
$total_bids = count($bids);
$pending_bids = count(array_filter($bids, function($b) { return $b['status'] == 'pending'; }));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bids | Client Dashboard - gigSpace</title>
    <?php include('../../assets/styling.php'); ?>
    <?php include('../dashboardstyle.php'); ?>
    <?php include('clientStyle.php');?>
    <style>
        /* BIDS PAGE ENHANCED STYLES */
        .bids-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
        }
        .page-header {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            text-align: center;
        }
        .page-header h2 {
            margin: 0 0 8px 0;
            color: #1e293b;
            font-size: 28px;
        }
        .filters {
            display: flex;
            gap: 10px;
            margin: 24px 0;
            flex-wrap: wrap;
            justify-content: center;
        }
        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #e5e7eb;
            background: white;
            color: #374151;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .filter-btn:hover, .filter-btn.active {
            background: #4f46e5;
            color: white;
            border-color: #4f46e5;
            transform: translateY(-1px);
        }
        .bids-grid {
            display: grid;
            gap: 20px;
        }
        .bid-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }
        .bid-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.12);
        }
        .bid-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }
        .bid-header h4 a {
            color: #1e293b;
            text-decoration: none;
            font-size: 20px;
            font-weight: 600;
        }
        .bid-header h4 a:hover {
            color: #4f46e5;
        }
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-badge.pending { background: #fef3c7; color: #d97706; }
        .status-badge.accepted { background: #d1fae5; color: #059669; }
        .status-badge.rejected { background: #fee2e2; color: #dc2626; }
        .bid-freelancer {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }
        .bid-amount {
            font-size: 28px;
            font-weight: 700;
            color: #059669;
            margin: 12px 0;
        }
        .bid-delivery {
            color: #6b7280;
            font-size: 14px;
        }
        .proposal-section {
            margin: 20px 0;
        }
        .proposal-preview {
            color: #6b7280;
            line-height: 1.6;
            max-height: 60px;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .proposal-full {
            max-height: none;
            color: #374151;
        }
        .toggle-proposal {
            background: none;
            border: none;
            color: #4f46e5;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 0;
            font-size: 14px;
        }
        .bid-actions {
            display: flex;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn.accept {
            background: #10b981;
            color: white;
        }
        .btn.accept:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        .btn.reject {
            background: #ef4444;
            color: white;
        }
        .btn.reject:hover {
            background: #dc2626;
        }
        .btn.secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        .btn.secondary:hover {
            background: #e5e7eb;
        }
        .accepted-badge {
            background: #10b981;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
        }
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            color: #6b7280;
        }
        .empty-state h4 {
            font-size: 24px;
            margin-bottom: 12px;
        }
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .bids-container { padding: 15px; }
            .filters { flex-direction: column; align-items: center; }
            .bid-header { flex-direction: column; gap: 12px; align-items: flex-start; }
            .bid-actions { flex-direction: column; width: 100%; }
            .btn { justify-content: center; width: 100%; }
        }
    </style>
</head>
<body style="background:  url('../../images/lighttheme.png') center/cover fixed; background-size: cover;">
    <div class="bids-container">
        <div class="page-header">
            <h2>Bids for your Project <span style="color: #6b7280; font-weight: 400;">(<?php echo $total_bids; ?> total)</span></h2>
            <p style="color: #6b7280; margin: 0;">Manage bids received across your projects</p>
            <p style="margin-top: 12px;"><a href="../dashboard.php" style="color: #4f46e5;">Back to Dashboard</a></p>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div style="background: #d1fae5; color: #065f46; padding: 16px; border-radius: 12px; text-align: center; margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 12px; text-align: center; margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (empty($bids)): ?>
            <div class="empty-state" >
                <h4>No bids yet</h4>
                <p style="margin: 10px;">Post a project to start receiving bids from freelancers</p>
                <a href="../dashboard.php" class="btn secondary" style="padding: 12px 24px; display: inline-block;">View Projects</a>
            </div>
        <?php else: ?>
            <div class="bids-grid">
                <?php foreach ($bids as $bid): 
                    $proposal = $bid['proposal'] ?? 'No proposal provided';
                    $short_proposal = strlen($proposal) > 100 ? substr($proposal, 0, 100) . '...' : $proposal;
                    $full_proposal_html = nl2br(htmlspecialchars($proposal));
                    $short_proposal_html = nl2br(htmlspecialchars($short_proposal));
                ?>
                    <div class="bid-card">
                        <div class="bid-header">
                            <h4><a href="projects_page.php?project_id=<?php echo $bid['project_id']; ?>"><?php echo htmlspecialchars($bid['project_title']); ?></a></h4>
                            <span class="status-badge <?php echo $bid['status']; ?>"><?php echo ucfirst($bid['status']); ?></span>
                        </div>
                        <div class="bid-freelancer">
                            <?php echo htmlspecialchars($bid['freelancer_username']); ?>
                        </div>
                        <div class="bid-amount">$<?php echo number_format($bid['amount'], 2); ?></div>
                        <div class="bid-delivery">(<?php echo $bid['delivery_time']; ?> days delivery)</div>
                        
                        <div class="proposal-section">
                            <div class="proposal-preview" id="proposal-<?php echo $bid['id']; ?>">
                                <?php echo $short_proposal_html; ?>
                            </div>
                            <?php if (strlen($proposal) > 100): ?>
                                <button class="toggle-proposal" onclick="toggleProposal('<?php echo $bid['id']; ?>', `<?php echo addslashes($full_proposal_html); ?>`, `<?php echo addslashes($short_proposal_html); ?>`)">
                                    Read more
                                </button>
                            <?php endif; ?>
                        </div>
                        
                        <div class="bid-actions">
                            <?php if ($bid['status'] == 'pending'): ?>
                                <a href="../../process/accept_bid.php?bid_id=<?php echo $bid['id']; ?>&project_id=<?php echo $bid['project_id']; ?>" 
                                   class="btn accept"  style="background: #10b981; color: white !important;">Accept Bid</a>
                                <a href="../../process/reject_bid.php?bid_id=<?php echo $bid['id']; ?>&project_id=<?php echo $bid['project_id']; ?>" 
                                   class="btn reject" onclick="return confirm('Reject this bid?')" style="background: #ef4444; color: white !important;">Reject</a>
                            <?php elseif ($bid['status'] == 'accepted'): ?>
                                <span class="accepted-badge">Order Created</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function toggleProposal(bidId, fullProposal, shortProposal) {
            const preview = document.getElementById('proposal-' + bidId);
            const button = event.target;
            
            if (preview.classList.contains('proposal-full')) {
                // Collapse
                preview.innerHTML = shortProposal;
                preview.classList.remove('proposal-full');
                button.textContent = 'Read more';
            } else {
                // Expand
                preview.innerHTML = fullProposal;
                preview.classList.add('proposal-full');
                button.textContent = 'Read less';
            }
        }
    </script>

</body>
</html>

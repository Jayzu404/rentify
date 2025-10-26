<?php
    // echo '<pre>';
    // var_dump($data['pendingUsers']);
    // echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Rentify | Admin Dashboard</title>
    <style>
        /* === RESET === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Segoe UI", Arial, sans-serif;
            background: #fafbfc;
            color: #0f172a;
            line-height: 1.6;
            font-size: 15px;
        }

        /* === HEADER === */
        .header {
            background: #1e40af;
            border-bottom: 1px solid #e8ecef;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(8px);
        }

        .header h1 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.02em;
        }

        .logout-btn {
            background: #dc2626;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #bc2222ff;
        }

        /* === LAYOUT === */
        .container {
            display: flex;
            min-height: calc(100vh - 64px);
        }

        /* === SIDEBAR === */
        .sidebar {
            width: 240px;
            background: #ffffff;
            padding: 1.5rem 0;
            border-right: 1px solid #e8ecef;
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }

        .nav-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 0.9375rem;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s ease;
            border-left: 3px solid transparent;
            margin: 0.25rem 0;
        }

        .nav-item:hover {
            background: #f8fafc;
            color: #334155;
        }

        .nav-item.active {
            background: #f0f9ff;
            color: #0284c7;
            border-left-color: #0284c7;
        }

        /* === MAIN CONTENT === */
        .main-content {
            flex: 1;
            padding: 2rem 2.5rem;
            overflow-y: auto;
            overflow-x: hidden;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            height: calc(100vh - 64px);
        }

        .search-box {
            position: fixed;
            top: 70px;
            z-index: 9999;
        }

        /* Ensure tables are responsive */
        .table-wrapper {
            overflow-x: auto;
            margin: 0 -0.5rem;
            padding: 0 0.5rem;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 8px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 4px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* === PAGE HEADER === */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: #64748b;
            font-size: 0.9375rem;
        }

        /* === DASHBOARD CARDS === */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid #e8ecef;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .stat-card h3 {
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        /* === CARD === */
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.75rem;
            border: 1px solid #e8ecef;
            margin-bottom: 1.5rem;
        }

        .card h2 {
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
            color: #0f172a;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        /* === SEARCH BAR === */
        .search-bar {
            margin-bottom: 1.5rem;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            width: 100%;
            max-width: 320px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            background: #fafbfc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cpath d='m21 21-4.35-4.35'%3E%3C/path%3E%3C/svg%3E") no-repeat 0.875rem center;
        }

        .search-bar:focus {
            border-color: #0284c7;
            background-color: #ffffff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        /* === TABLE === */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        thead {
            background: #fafbfc;
        }

        th {
            padding: 0.875rem 1rem;
            text-align: left;
            color: #475569;
            font-weight: 600;
            font-size: 0.8125rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e8ecef;
        }

        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9375rem;
            color: #334155;
        }

        tbody tr {
            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: #fafbfc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* === BUTTONS === */
        button {
            font-family: inherit;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .view-btn, .approve-btn, .reject-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .view-btn i,
        .approve-btn i,
        .reject-btn i {
            font-size: 1rem;
        }

        /* View */
        .view-btn {
            background: #f0f9ff;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }
        .view-btn:hover {
            background: #e0f2fe;
            border-color: #7dd3fc;
        }

        /* Approve */
        .approve-btn {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }
        .approve-btn:hover {
            background: #d1fae5;
            border-color: #6ee7b7;
        }

        /* Reject */
        .reject-btn {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .reject-btn:hover {
            background: #fee2e2;
            border-color: #fca5a5;
        }

        /* === ACTION BUTTONS === */
        .action-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 8px;
        }

        .action-buttons .action-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: #64748b;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-buttons .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .action-btn.ban {
            color: #ef4444;
        }
        .action-btn.ban:hover {
            background: #fef2f2;
            border-color: #fecaca;
        }

        .action-btn.restrict {
            color: #f59e0b;
        }
        .action-btn.restrict:hover {
            background: #fffbeb;
            border-color: #fde68a;
        }

        .action-btn.unban {
            color: #10b981;
        }
        .action-btn.unban:hover {
            background: #ecfdf5;
            border-color: #a7f3d0;
        }

        .action-btn.delete {
            color: #64748b;
        }
        .action-btn.delete:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* === BADGES === */
        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            line-height: 1;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background: #dcfce7;
            color: #166534;
        }

        .badge-active {
            background: #dbeafe;
            color: #1e40af;
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #94a3b8;
            font-size: 0.9375rem;
        }

        /* === HIDDEN SECTIONS === */
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }

        /* === RESPONSIVE === */
        @media (max-width: 1024px) {
            .main-content {
                padding: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1rem;
            }

            .stat-card {
                padding: 1.25rem;
            }

            .stat-card .number {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 1rem;
                height: 56px;
            }

            .header h1 {
                font-size: 1.125rem;
            }

            .logout-btn {
                padding: 0.45rem 0.75rem;
                font-size: 0.8125rem;
            }

            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                display: flex;
                overflow-x: auto;
                overflow-y: hidden;
                border-right: none;
                border-bottom: 1px solid #e8ecef;
                padding: 0;
                position: sticky;
                top: 56px;
                height: auto;
                z-index: 50;
            }

            .sidebar::-webkit-scrollbar {
                height: 3px;
            }

            .nav-item {
                flex: 0 0 auto;
                min-width: 120px;
                justify-content: center;
                font-size: 0.8125rem;
                padding: 0.875rem 1rem;
                border-left: none;
                border-bottom: 3px solid transparent;
                white-space: nowrap;
            }

            .nav-item.active {
                border-left: none;
                border-bottom-color: #0284c7;
            }

            .main-content {
                padding: 1.25rem 1rem;
                height: auto;
            }

            h2 {
                font-size: 1.25rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.875rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-card h3 {
                font-size: 0.75rem;
            }

            .stat-card .number {
                font-size: 1.5rem;
            }

            .search-bar {
                max-width: 100%;
                font-size: 0.875rem;
                padding: 0.65rem 0.875rem 0.65rem 2.5rem;
            }

            .card {
                padding: 1rem;
                border-radius: 10px;
            }

            .card h2 {
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            table {
                font-size: 0.8125rem;
            }

            th {
                padding: 0.75rem 0.5rem;
                font-size: 0.75rem;
            }

            td {
                padding: 0.75rem 0.5rem;
            }

            .view-btn, .approve-btn, .reject-btn {
                padding: 0.45rem 0.75rem;
                font-size: 0.8125rem;
                gap: 4px;
            }

            .view-btn i, .approve-btn i, .reject-btn i {
                font-size: 0.875rem;
            }

            .action-buttons {
                flex-wrap: nowrap;
                gap: 6px;
            }

            .action-btn {
                width: 28px;
                height: 28px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .nav-item {
                min-width: 100px;
                font-size: 0.75rem;
                padding: 0.75rem 0.75rem;
            }

            .nav-item span {
                display: none;
            }

            th, td {
                padding: 0.65rem 0.4rem;
                font-size: 0.75rem;
            }

            .action-buttons {
                gap: 4px;
            }

            .action-btn {
                width: 26px;
                height: 26px;
                font-size: 13px;
            }
        }

        /* === LOADING STATES === */
        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* === SMOOTH ANIMATIONS === */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section.active {
            animation: fadeIn 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rentify Admin</h1>
        <button class="logout-btn" onclick="logout()">Logout</button>
    </div>

    <div class="container">
        <aside class="sidebar">
            <div class="nav-item active" onclick="showSection('dashboard')">📊 Dashboard</div>
            <div class="nav-item" onclick="showSection('all-users')">👥 All Users</div>
            <div class="nav-item" onclick="showSection('pending-users')">👤 Pending Users</div>
            <div class="nav-item" onclick="showSection('pending-items')">📦 Pending Items</div>
            <div class="nav-item" onclick="showSection('all-items')">📋 All Items</div>
        </aside>

        <main class="main-content">
            <!-- Dashboard Section -->
            <div id="dashboard" class="section active">
                <h2 style="margin-bottom: 1.5rem;">Dashboard Overview</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Pending User/s</h3>
                        <div class="number" id="stat-pending-users"><?= htmlspecialchars($data['pendingUsersCount'] ?? 0); ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Pending Item/s</h3>
                        <div class="number" id="stat-pending-items"><?= htmlspecialchars($data['pendingItemsCount'] ?? 0); ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Total User/s</h3>
                        <div class="number" id="stat-total-users"><?= htmlspecialchars($data['allUserCount'] ?? 0); ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Item/s</h3>
                        <div class="number" id="stat-total-items"><?= htmlspecialchars($data['allItemCount'] ?? 0); ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Rentify Monthly Commission</h3>
                        <div class="number" id="rentify-monthly">0</div>
                    </div>
                    <div class="stat-card">
                        <h3>Rentify Yearly Commission</h3>
                        <div class="number" id="rentify-yearly">0</div>
                    </div>
                </div>
            </div>

            <!-- All Users Section -->
            <div id="all-users" class="section">
                <div class="card">
                    <div class="search-box">
                        <input type="text" class="search-bar" placeholder="Search users..." onkeyup="searchTable(this, 'all-users-table')">
                    </div>
                    <div class="table-wrapper">
                        <table id="all-users-table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Uploaded ID</th>
                                    <th>Join Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="all-users-body">
                                <?php foreach ($data['allUser'] as $user):?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']); ?></td>
                                        <td><?= htmlspecialchars($user['address']); ?></td>
                                        <td><?= htmlspecialchars($user['email']); ?></td>
                                        <td><?= htmlspecialchars($user['approval_status']); ?></td>
                                        <td><button class="view-btn" onclick="window.open('/file/image/uploads/ids/<?= htmlspecialchars($user['id_path']); ?>', '_blank')"><i class='bx bx-show'></i>View</button></td>
                                        <td><?= htmlspecialchars($user['created_at']); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn ban" title="Ban User">
                                                    <i class='bx bx-block'></i>
                                                </button>
                                                <button class="action-btn restrict" title="Restrict User">
                                                    <i class='bx bx-lock-alt'></i>
                                                </button>
                                                <button class="action-btn unban" title="Unban User">
                                                    <i class='bx bx-check-shield'></i>
                                                </button>
                                                <button class="action-btn delete" title="Delete User" data-uid="<?= htmlspecialchars($user['uid']); ?>" onclick="deleteUser(this)">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </div>
                                        </td> 
                                    </tr>
                               <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pending Users Section -->
            <div id="pending-users" class="section">
                <div class="card">
                    <h2>Pending User Registrations</h2>
                    <input type="text" class="search-bar" placeholder="Search users..." onkeyup="searchTable(this, 'pending-users-table')">
                    <div class="table-wrapper">
                        <table id="pending-users-table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>ID Upload</th>
                                    <th>Date Requested</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="pending-users-body">
                               <?php foreach ($data['pendingUsers'] as $pending): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pending['first_name'] . ' ' . $pending['middle_name'] . ' ' . $pending['last_name']); ?></td>
                                    <td><?= htmlspecialchars($pending['email']); ?></td>
                                    <td><?= htmlspecialchars($pending['address']); ?></td>
                                    <td><button class="view-btn" onclick="window.open('/file/image/uploads/ids/<?= htmlspecialchars($pending['id_path']); ?>', '_blank')"><i class='bx bx-show'></i>View</button></td>
                                    <td><?= htmlspecialchars($pending['created_at']); ?></td>
                                    <td>
                                        <button class="approve-btn" data-uid="<?= htmlspecialchars($pending['uid']); ?>" onclick="approveUser(this)">
                                            <i class='bx bx-check'></i> Approve
                                        </button>
                                        <button class="reject-btn">
                                            <i class='bx bx-x'></i> Reject
                                        </button>    
                                    </td>   
                                </tr>
                               <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pending Items Section -->
            <div id="pending-items" class="section">
                <div class="card">
                    <h2>Pending Item Listings</h2>
                    <input type="text" class="search-bar" placeholder="Search items..." onkeyup="searchTable(this, 'pending-items-table')">
                    <div class="table-wrapper">
                        <table id="pending-items-table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Owner</th>
                                    <th>Price/Day</th>
                                    <th>Date Listed</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="pending-items-body">
                                <!-- PHP will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- All Items Section -->
            <div id="all-items" class="section">
                <div class="card">
                    <h2>All Items</h2>
                    <input type="text" class="search-bar" placeholder="Search items..." onkeyup="searchTable(this, 'all-items-table')">
                    <div class="table-wrapper">
                        <table id="all-items-table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Owner</th>
                                    <th>Price/Day</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="all-items-body">
                                <!-- PHP will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.section');
            sections.forEach(s => s.classList.remove('active'));
            
            // Remove active from nav items
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(n => n.classList.remove('active'));
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
            
            // Add active to clicked nav item
            event.target.classList.add('active');
        }

        function rejectUser(userId) {
            if (confirm('Reject this user registration?')) {
                fetch('admin_actions.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({action: 'reject_user', user_id: userId})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('User rejected!');
                        location.reload();
                    }
                });
            }
        }

        function approveItem(itemId) {
            if (confirm('Approve this item listing?')) {
                fetch('admin_actions.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({action: 'approve_item', item_id: itemId})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item approved successfully!');
                        location.reload();
                    }
                });
            }
        }

        function rejectItem(itemId) {
            if (confirm('Reject this item listing?')) {
                fetch('admin_actions.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({action: 'reject_item', item_id: itemId})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item rejected!');
                        location.reload();
                    }
                });
            }
        }

        function viewDetails(id, type) {
            // Redirect to details page
            window.location.href = `view_details.php?type=${type}&id=${id}`;
        }

        async function deleteUser(button) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                const userId = button.dataset.uid;
                
                button.disabled = true;
                button.textContent = 'Deleting...';
                
                try {
                    const response = await fetch(`/admin/deleteUser?uid=${userId}`);
                    const result = await response.json();

                    if (result[0].success) {
                        alert(result[0].message);
                        
                        // Optional: remove after 2 seconds
                        // setTimeout(() => row.remove(), 2000);
                    } else {
                        // Error handling
                        alert('Error: ' + result[0].error);
                        button.disabled = false;
                        button.textContent = "<i class='bx bx-trash'></i>";
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    button.disabled = false;
                    button.textContent = "<i class='bx bx-trash'></i>";
                }
            }
        }

        function deleteItem(itemId) {
            if (confirm('Are you sure you want to delete this item?')) {
                fetch('admin_actions.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({action: 'delete_item', item_id: itemId})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item deleted!');
                        location.reload();
                    }
                });
            }
        }

        function searchTable(input, tableId) {
            const filter = input.value.toLowerCase();
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            }
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '/auth/login';
            }
        }

        // Load stats on page load
        function loadStats() {
            fetch('get_stats.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('stat-pending-users').textContent = data.pending_users || 0;
                    document.getElementById('stat-pending-items').textContent = data.pending_items || 0;
                    document.getElementById('stat-total-users').textContent = data.total_users || 0;
                    document.getElementById('stat-total-items').textContent = data.total_items || 0;
                });
        }

        // Using fetch API
        async function approveUser(button) {
            if (confirm('Are you sure to approve this user?')) {
                const userId = button.dataset.uid;
                const row = button.closest('tr');
                
                button.disabled = true;
                button.textContent = 'Approving...';
                
                try {
                    const response = await fetch(`/admin/approveUser?uid=${userId}`);
                    const result = await response.json();
                    
                    if (result[0].success) {
                        // Success - update UI
                        row.style.backgroundColor = '#d4edda';
                        button.textContent = '✓';
                        button.classList.add('btn-success');
                        
                        // Optional: remove after 2 seconds
                        setTimeout(() => row.remove(), 2000);
                    } else {
                        // Error handling
                        alert('Error: ' + result[0].error);
                        button.disabled = false;
                        button.textContent = 'Approve';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    button.disabled = false;
                    button.textContent = 'Approve';
                }
            }
        }
    </script>
</body>
</html>
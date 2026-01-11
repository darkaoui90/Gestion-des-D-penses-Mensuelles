<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyWallet - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f7fa;
            color: #2d3748;
            line-height: 1.6;
        }

        /* Header / Navbar */
        .header {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #e2e8f0;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .nav-links a.active {
            color: #667eea;
        }

        /* Main Layout */
        .main-container {
            display: flex;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: white;
            min-height: calc(100vh - 64px);
            padding: 24px 0;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.04);
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 4px;
        }

        .sidebar-nav a {
            display: block;
            padding: 12px 24px;
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav a:hover {
            background: #f7fafc;
            color: #667eea;
            border-left-color: #667eea;
        }

        .sidebar-nav a.active {
            background: #eef2ff;
            color: #667eea;
            border-left-color: #667eea;
        }

        /* Main Content */
        .content {
            flex: 1;
            padding: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 24px;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card-label {
            font-size: 14px;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
        }

        .card-currency {
            font-size: 18px;
            color: #a0aec0;
            margin-left: 4px;
        }

        .card.budget .card-value {
            color: #667eea;
        }

        .card.spent .card-value {
            color: #f56565;
        }

        .card.balance .card-value {
            color: #48bb78;
        }

        /* Expense List Section */
        .expense-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 32px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #1a202c;
        }

        .add-btn {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.2s;
        }

        .add-btn:hover {
            background: #5568d3;
        }

        /* Table */
        .expense-table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
        }

        .expense-table thead {
            background: #f7fafc;
        }

        .expense-table th {
            text-align: left;
            padding: 14px;
            font-weight: 600;
            font-size: 13px;
            color: #4a5568;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        .expense-table td {
            padding: 16px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #2d3748;
        }

        .expense-table tbody tr:hover {
            background: #f7fafc;
        }

        .expense-table tbody tr:last-child td {
            border-bottom: none;
        }

        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            background: #edf2f7;
            color: #4a5568;
        }

        .category-badge.food {
            background: #fef5e7;
            color: #d97706;
        }

        .category-badge.transport {
            background: #e0f2fe;
            color: #0284c7;
        }

        .category-badge.shopping {
            background: #fce7f3;
            color: #db2777;
        }

        .category-badge.bills {
            background: #f3e8ff;
            color: #9333ea;
        }

        .amount {
            font-weight: 600;
            color: #f56565;
        }

        .delete-btn {
            background: #feb2b2;
            color: #c53030;
            padding: 6px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .delete-btn:hover {
            background: #fc8181;
        }

        .budget-form {
            background: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
            align-items: center;
            border: 1px solid #e2e8f0;
            max-width: 400px;
        }

        .budget-form input[type="number"] {
            flex: 1;
            padding: 10px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Inter', -apple-system, sans-serif;
            color: #2d3748;
            background: #f7fafc;
            transition: all 0.2s ease;
            min-width: 0;
        }

        .budget-form input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .budget-form input[type="number"]::placeholder {
            color: #a0aec0;
        }

        .budget-form button {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            font-family: 'Inter', -apple-system, sans-serif;
        }

        .budget-form button:hover {
            background: #5568d3;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .budget-form button:active {
            transform: translateY(0);
        }

        /* Responsive adjustments for budget form */

        /* Footer */
        .footer {
            background: white;
            padding: 24px;
            text-align: center;
            color: #718096;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 16px;
            }

            .nav-links {
                display: none;
            }

            .sidebar {
                display: none;
            }

            .content {
                padding: 20px 16px;
            }

            .summary-cards {
                grid-template-columns: 1fr;
            }

            .expense-table {
                font-size: 14px;
            }

            .expense-table th,
            .expense-table td {
                padding: 10px 8px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .expense-table thead {
                display: none;
            }

            .expense-table tbody tr {
                display: block;
                margin-bottom: 16px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                padding: 12px;
            }

            .expense-table td {
                display: block;
                padding: 8px 0;
                border: none;
                text-align: left;
            }

            .budget-form {
                padding: 16px;
                margin-bottom: 24px;}

                .expense-table td:before {
                    content: attr(data-label);
                    font-weight: 600;
                    color: #4a5568;
                    display: inline-block;
                    width: 100px;
                }
            }
    </style>
</head>

<body>
    <!-- Header / Navbar -->
    <header class="header">
        <div class="header-content">
            <a href="/" class="logo">MyWallet</a>
            <nav>
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.php?page=dashboard">Dashboard</a></li>
                        <li><a href="index.php?page=expenses">Add expense</a></li>
                        <li><a href="index.php?page=logout">Logout</a></li>
                    </ul>
                </nav>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Main Content -->
        <main class="content">
            <h1 class="page-title">Dashboard</h1>
            <!-- Add Budget Amount -->
            <form method="post" action="index.php?page=dashboard" class="budget-form">
                <input
                    type="number"
                    name="budget_amount"
                    placeholder="new budget "
                    min="0"
                    step="0.01"
                    required>
                <button type="submit">Add to Budget</button>
            </form>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="card budget">
                    <div class="card-label">Total Budget</div>
                    <div class="card-value">
                        <?= $totalBudget ?>
                        <span class="card-currency">MAD</span>
                    </div>
                </div>

                <div class="card spent">
                    <div class="card-label">Total Spent</div>
                    <div class="card-value">
                        <?= $totalSpent ?>
                        <span class="card-currency">MAD</span>
                    </div>
                </div>

                <div class="card balance">
                    <div class="card-label">Remaining Balance</div>
                    <div class="card-value">
                        <?= $remaining ?>
                        <span class="card-currency">MAD</span>
                    </div>
                </div>
            </div>
            <!-- Expense List Section -->
            <section class="expense-section">
                <div class="section-header">
                    <h2 class="section-title">Recent Expenses</h2>
                    <a href="index.php?page=expenses" class="add-btn">+ Add Expense</a>
                </div>

                <table class="expense-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody><?php foreach ($expenses as $exp): ?>
                            <tr>
                                <td><?= htmlspecialchars($exp['title']) ?></td>
                                <td><?= htmlspecialchars($exp['category_name']) ?></td>
                                <td><?= htmlspecialchars($exp['amount']) ?></td>
                                <td><?= htmlspecialchars($exp['date']) ?></td>
                                <td><a href="index.php?page=dashboard&delete=<?= $exp['id'] ?>"
                                        class="delete-btn"
                                        onclick="return confirm('Delete this expense?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 MyWallet - Personal Finance Manager</p>
    </footer>
</body>

</html>
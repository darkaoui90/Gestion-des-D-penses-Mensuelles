<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense - MyWallet</title>
    <style>
        /* ========================================
           GLOBAL STYLES & RESET
           ======================================== */
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ========================================
           HEADER / NAVBAR STYLES
           ======================================== */
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

        /* Logo styling */
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }

        /* Navigation links container */
        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        /* Individual navigation link styling */
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

        /* Active page indicator */
        .nav-links a.active {
            color: #667eea;
        }

        /* ========================================
           MAIN CONTENT CONTAINER
           ======================================== */
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        /* ========================================
           FORM CONTAINER / CARD
           ======================================== */
        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            padding: 40px;
            width: 100%;
            max-width: 560px;
        }

        /* Page title styling */
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
            text-align: center;
        }

        /* Subtitle/description text */
        .page-subtitle {
            font-size: 15px;
            color: #718096;
            text-align: center;
            margin-bottom: 32px;
        }

        /* ========================================
           MESSAGE PLACEHOLDER STYLES
           (For success/error messages from backend)
           ======================================== */
        .message-placeholder {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            display: none;
            /* Hidden by default, show via backend */
        }

        /* Error message styling */
        .message-placeholder.error {
            background-color: #fff5f5;
            border: 1px solid #fc8181;
            color: #c53030;
        }

        /* Success message styling */
        .message-placeholder.success {
            background-color: #f0fff4;
            border: 1px solid #68d391;
            color: #2f855a;
        }

        /* ========================================
           FORM STYLES
           ======================================== */
        .expense-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Individual form field container */
        .form-group {
            display: flex;
            flex-direction: column;
        }

        /* Label styling */
        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        /* Required field indicator */
        .required {
            color: #f56565;
            margin-left: 4px;
        }

        /* ========================================
           INPUT FIELD STYLES
           ======================================== */
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            color: #2d3748;
            transition: all 0.2s ease;
            outline: none;
            background: white;
        }

        /* Focus state for inputs */
        .form-group input:focus,
        .form-group select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Placeholder text styling */
        .form-group input::placeholder {
            color: #a0aec0;
        }

        /* Select dropdown specific styling */
        .form-group select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%234a5568' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        /* Placeholder option styling */
        .form-group select option:disabled {
            color: #a0aec0;
        }

        /* Helper text under input fields */
        .form-helper {
            font-size: 13px;
            color: #718096;
            margin-top: 6px;
        }

        /* ========================================
           SUBMIT BUTTON STYLES
           ======================================== */
        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 8px;
        }

        /* Button hover effect */
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* Button active/pressed state */
        .submit-btn:active {
            transform: translateY(0);
        }

        /* ========================================
           BACK LINK STYLES
           ======================================== */
        .back-link {
            text-align: center;
            margin-top: 24px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: #5568d3;
            text-decoration: underline;
        }

        /* ========================================
           FOOTER STYLES
           ======================================== */
        .footer {
            background: white;
            padding: 24px;
            text-align: center;
            color: #718096;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
        }

        /* ========================================
           RESPONSIVE DESIGN - MOBILE
           ======================================== */
        @media (max-width: 768px) {

            /* Hide navigation links on mobile */
            .nav-links {
                display: none;
            }

            /* Adjust header padding */
            .header-content {
                padding: 0 16px;
            }

            /* Reduce form container padding */
            .form-container {
                padding: 28px 24px;
            }

            /* Adjust title size */
            .page-title {
                font-size: 24px;
            }

            /* Reduce main content padding */
            .main-content {
                padding: 24px 16px;
            }
        }

        /* Mobile portrait mode adjustments */
        @media (max-width: 480px) {
            .form-container {
                padding: 24px 20px;
            }

            .page-title {
                font-size: 22px;
            }

            .form-group input,
            .form-group select {
                padding: 11px 14px;
            }
        }
    </style>
</head>

<body>
    <!-- ========================================
         HEADER / NAVIGATION BAR
         ======================================== -->
    <header class="header">
        <div class="header-content">
            <!-- important: go through router, not "/" -->
            <a href="index.php?page=dashboard" class="logo">MyWallet</a>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php?page=dashboard">Dashboard</a></li>
                    <li><a href="index.php?page=expenses">Add expense</a></li>
                    <li><a href="index.php?page=logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- ========================================
         MAIN CONTENT AREA
         ======================================== -->
    <main class="main-content">
        <div class="form-container">
            <!-- Page Title & Subtitle -->
            <h1 class="page-title">Add New Expense</h1>
            <p class="page-subtitle">Track your spending by adding expense details</p>

            <!-- ========================================
                 MESSAGE PLACEHOLDER
                 (Show this via PHP when needed)
                 ======================================== -->
            <div class="message-placeholder error">
                <!-- Error messages appear here -->
                <!-- Example: Please fill in all required fields -->
            </div>

            <div class="message-placeholder success">
                <!-- Success messages appear here -->
                <!-- Example: Expense added successfully! -->
            </div>

            <!-- ========================================
                 ADD EXPENSE FORM
                 ======================================== -->
            <!-- important: go through router + match controller -->
            <form action="index.php?page=expenses" method="post" class="expense-form">

                <!-- Title Field -->
                <div class="form-group">
                    <label for="title">
                        Expense Title
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="e.g., Grocery shopping, Taxi fare"
                        required>
                    <span class="form-helper">A brief description of your expense</span>
                </div>

                <!-- Amount Field -->
                <div class="form-group">
                    <label for="amount">
                        Amount (MAD)
                        <span class="required">*</span>
                    </label>
                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        placeholder="0.00"
                        step="0.01"
                        min="0"
                        required>
                    <span class="form-helper">Enter the amount spent in Moroccan Dirham</span>
                </div>

                <!-- Date Field -->
                <div class="form-group">
                    <label for="date">
                        Date
                        <span class="required">*</span>
                    </label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        value="<?= date('Y-m-d') ?>"
                        required>
                    <span class="form-helper">When did this expense occur?</span>
                </div>

                <!-- Category Dropdown -->
                <div class="form-group">
                    <label for="category_id">
                        Category
                        <span class="required">*</span>
                    </label>
                    <!-- important: name="category_id" to match your model/controller -->
                    <select name="category_id" required>
                        <option value="" disabled selected>Select category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>">
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>logout

                    <span class="form-helper">Choose the expense category</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    Add Expense
                </button>
            </form>

            <!-- Back to Dashboard Link -->
            <div class="back-link">
                <a href="index.php?page=dashboard">← Back to Dashboard</a>
            </div>
        </div>
    </main>

    <!-- ========================================
         FOOTER
         ======================================== -->
    <footer class="footer">
        <p>&copy; 2026 MyWallet - Personal Finance Manager</p>
    </footer>
</body>

</html>
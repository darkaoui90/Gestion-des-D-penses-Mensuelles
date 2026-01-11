
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Authentication Pages</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .container {
                background: white;
                border-radius: 16px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                width: 100%;
                max-width: 440px;
                padding: 40px;
            }

            .header {
                text-align: center;
                margin-bottom: 32px;
            }

            .header h1 {
                color: #333;
                font-size: 28px;
                font-weight: 600;
                margin-bottom: 8px;
            }

            .header p {
                color: #666;
                font-size: 14px;
            }

            .message-placeholder {
                padding: 12px 16px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 14px;
                display: none;
            }

            .message-placeholder.error {
                background-color: #fee;
                border: 1px solid #fcc;
                color: #c33;
            }

            .message-placeholder.success {
                background-color: #efe;
                border: 1px solid #cfc;
                color: #3c3;
            }

            .form-group {
                margin-bottom: 24px;
            }

            label {
                display: block;
                color: #333;
                font-size: 14px;
                font-weight: 500;
                margin-bottom: 8px;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 12px 16px;
                border: 2px solid #e0e0e0;
                border-radius: 8px;
                font-size: 15px;
                transition: all 0.3s ease;
                outline: none;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            input::placeholder {
                color: #999;
            }

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
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                margin-top: 8px;
            }

            .submit-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            }

            .submit-btn:active {
                transform: translateY(0);
            }

            .footer-text {
                text-align: center;
                margin-top: 24px;
                color: #666;
                font-size: 14px;
            }

            .footer-text a {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
            }

            .footer-text a:hover {
                text-decoration: underline;
            }

            .page-switcher {
                text-align: center;
                margin-bottom: 20px;
            }

            .page-switcher button {
                background: none;
                border: none;
                color: #667eea;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                padding: 8px 16px;
                margin: 0 8px;
                border-radius: 6px;
                transition: background 0.2s ease;
            }

            .page-switcher button:hover {
                background: #f0f0f0;
            }

            .page {
                display: none;
            }

            .page.active {
                display: block;
            }

            @media (max-width: 480px) {
                .container {
                    padding: 28px 24px;
                }

                .header h1 {
                    font-size: 24px;
                }
            }
        </style>
    </head>
    <body>
<div class="container">

    <!-- Switch buttons -->
    <div class="page-switcher">
        <button onclick="showLogin()">Login</button>
        <button onclick="showSignup()">Signup</button>
    </div>

    <!-- LOGIN -->
    <div id="login-page" class="page active">
        <div class="header">
            <h1>Welcome Back</h1>
            <p>Please login to your account</p>
        </div>

        <form method="POST">
            <input type="hidden" name="action" value="login">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button class="submit-btn">Login</button>
        </form>
    </div>

    <!-- SIGNUP -->
    <div id="signup-page" class="page">
        <div class="header">
            <h1>Create Account</h1>
            <p>Sign up to get started</p>
        </div>

        <form method="POST">
            <input type="hidden" name="action" value="register">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button class="submit-btn">Create Account</button>
        </form>
    </div>

</div>

<script>
    function showLogin() {
        document.getElementById('login-page').classList.add('active');
        document.getElementById('signup-page').classList.remove('active');
    }

    function showSignup() {
        document.getElementById('signup-page').classList.add('active');
        document.getElementById('login-page').classList.remove('active');
    }

    document.addEventListener('DOMContentLoaded', showLogin);
</script>

</body>
    </html>
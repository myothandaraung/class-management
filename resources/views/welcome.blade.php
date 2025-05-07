<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admin Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .login-container {
            display: flex;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1000px;
            overflow: hidden;
        }
        
        .illustration-section {
            flex: 1;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
        }
        
        .illustration-section img {
            max-width: 100%;
            height: auto;
        }
        
        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-heading {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        
        .input-field {
            width: 100%;
            padding: 15px 40px 15px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }
        
        .input-field:focus {
            border-color: #4a90e2;
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: #4a90e2;
            text-decoration: none;
            font-size: 14px;
        }
        
        .login-button {
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .login-button:hover {
            background-color: #3a80d2;
        }
        
        .signup-text {
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        
        .signup-text a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 600;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        
        .footer img {
            max-width: 120px;
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .illustration-section {
                display: none;
            }
            
            .form-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <?php
    $username = '';
    // $error = '';
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $username = $_POST['username'] ?? '';
    //     $password = $_POST['password'] ?? '';
    //     if (empty($username) || empty($password)) {
    //         $error = "Username and password are required";
    //     } else {
    //         $error = "Invalid credentials. Please try again.";
    //     }
    // }
    ?>

    <div class="login-container">
        <div class="illustration-section">
            <img src="<?php echo htmlspecialchars('/path/to/admin-illustration.png'); ?>" alt="Admin Illustration">
        </div>
        
        <div class="form-section">
            <h1 class="login-heading">Login</h1>
            
            <?php if (!empty($error)): ?>
                <div style="color: red; margin-bottom: 15px; text-align: center;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group">
                    <input type="text" name="username" class="input-field" placeholder="school" value="<?php echo htmlspecialchars($username); ?>">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg>
                    </span>
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" class="input-field" placeholder="••••••••">
                    <span class="input-icon" style="cursor: pointer;" onclick="togglePasswordVisibility()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                    </span>
                </div>
                
                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
                
                <button type="submit" class="login-button">Login</button>
                
                <div class="signup-text">
                    Don't have account? Let's <a href="register.php">Get Started For Free</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="footer">
        <img src="<?php echo htmlspecialchars('/path/to/vedmarg-logo.png'); ?>" alt="Vedmarg Logo">
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.querySelector('input[name="password"]');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>
</html>
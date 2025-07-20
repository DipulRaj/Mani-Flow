<?php
require_once 'config.php';

$errors = [];

if (isLoggedIn()) {
    redirectTo('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $loginField = sanitizeInput($_POST['login_field'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($loginField)) {
        $errors[] = "Username or email is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE email = ? OR username = ?");
            $stmt->execute([$loginField, $loginField]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                
                redirectTo('dashboard.php');
            } else {
                $errors[] = "Invalid username/email or password";
            }
        } catch (PDOException $e) {
            $errors[] = "Login failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User Auth System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header">
                <h2>Welcome Back</h2>
                <p>Please sign in to your account</p>
            </div>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="login_field">Username or Email</label>
                    <input 
                        type="text" 
                        id="login_field" 
                        name="login_field" 
                        placeholder="Enter username or email"
                        value="<?php echo htmlspecialchars($loginField ?? ''); ?>"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password"
                        required
                    >
                </div>
                
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            
            <div class="form-footer">
                <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
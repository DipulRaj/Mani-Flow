<?php
require_once 'config.php';

// Check if user is logged in
if (!isLoggedIn()) {
    redirectTo('login.php');
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - User Auth System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="dashboard-wrapper">
            <header class="dashboard-header">
                <h1>Dashboard</h1>
                <nav>
                    <a href="logout.php" class="btn btn-secondary">Logout</a>
                </nav>
            </header>
            
            <div class="dashboard-content">
                <div class="welcome-section">
                    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
                    <p>You have successfully logged into your account.</p>
                </div>
                
                <div class="user-info">
                    <h3>Your Account Information</h3>
                    <div class="info-card">
                        <div class="info-item">
                            <label>Username:</label>
                            <span><?php echo htmlspecialchars($username); ?></span>
                        </div>
                        <div class="info-item">
                            <label>Email:</label>
                            <span><?php echo htmlspecialchars($email); ?></span>
                        </div>
                        <div class="info-item">
                            <label>Status:</label>
                            <span class="status-active">Active</span>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-actions">
                    <h3>Quick Actions</h3>
                    <div class="action-buttons">
                        <button class="btn btn-primary" onclick="alert('Feature coming soon!')">Update Profile</button>
                        <button class="btn btn-primary" onclick="alert('Feature coming soon!')">Change Password</button>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
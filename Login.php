<?php
include "db_connect.php";
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } else {
$stmt = $conn->prepare("SELECT id, full_name, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Login success
                $_SESSION['email'] = NULL; 
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];

                header("Location: user/dashboard.php");
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Account not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login | College Event Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

<style>
/* ===== LOGIN LAYOUT ===== */
.apply-wrapper {
    min-height: 100vh;
    display: flex;
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
}

/* LEFT */
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

/* RIGHT */
.apply-right {
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* FORM CARD */
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
    background: linear-gradient(135deg, #4f46e5, #4338ca);
    color: white;
    border: none;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
}

.form-card button:hover {
    box-shadow: 0 12px 30px rgba(79,70,229,0.4);
}

/* MESSAGES */
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

/* RESPONSIVE */
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
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1100px;
    margin: 80px auto;   /* centers whole section */
    gap: 40px;           /* space between cards */
}
/* LEFT CARD */
.left-card {
    width: 50%;
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.left-card {
    flex: 1;
    max-width: 600px;
}

.left-card h1 {
    margin-bottom: 15px;
}

.left-card p {
    margin-bottom: 15px;
    color: #555;
}

.left-card ul {
    list-style: none;
    padding: 0;
}

.left-card ul li {
    margin-bottom: 10px;
}
.container {
    align-items: flex-start;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🎓 College Event Portal</div>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="event/index.php">Events</a>
        <a href="gallery.php">Gallery</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</div>

<section class="apply-wrapper">

    <!-- LEFT -->
   <div class="container">
    <div class="left-card">
        <h1>Welcome Back</h1>
        <p>
            Login to manage your event registrations, track participation, and stay updated with upcoming college events.
        </p>

        <ul>
            <li>✔ Access registered events</li>
            <li>✔ Get notifications</li>
            <li>✔ Manage your profile</li>
        </ul>
    </div>

    <!-- RIGHT -->
    <div class="apply-right">
        <div class="form-card">
            <h2>Login</h2>

            <?php if (!empty($error)) { ?>
                <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>

            <form method="POST">
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Login</button>
            </form>

            <p class="form-footer">
                Don’t have an account? <a href="register.php">Register</a>
                Forgot Password? <a href="forgot_password.php">Forgot Password</a>
            </p>
        </div>
    </div>

</section>
<!-- FOOTER -->
<div class="footer">
    © 2026 College Event Management System
</div>

</body>
</html>

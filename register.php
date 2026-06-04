<?php
include "db_connect.php";

/* USER REGISTRATION */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered.";
    } else {
        $insert = "INSERT INTO users (full_name, email, password)
                   VALUES ('$name', '$email', '$pass')";

        if (mysqli_query($conn, $insert)) {
            $success = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>College Event Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
<style>/* ===== APPLY / REGISTER LAYOUT ===== */
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

.event-date {
    font-size: 16px;
    color: #4f46e5;
    margin-bottom: 25px;
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
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    border: none;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
}

.form-card button:hover {
    box-shadow: 0 12px 30px rgba(34,197,94,0.4);
}

/* MESSAGES */
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
</style>
</head><body>

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

    <!-- LEFT: NORMAL DETAILS -->
    <div class="apply-left">
        <h1>Join College Event Portal</h1>

        <p class="event-text">
            Create your account to stay updated with the latest college events,
            workshops, cultural fests, and sports activities.
        </p>

        <p class="event-text">
            ✔ Register for events<br>
            ✔ Receive updates & notifications<br>
            ✔ Manage your event participation<br>
            ✔ Access event details anytime
        </p>

        <p class="event-text">
            Registration is free and only takes a minute.
        </p>
    </div>

    <!-- RIGHT: USER REGISTRATION -->
    <div class="apply-right">
        <div class="form-card">
            <h2>Create Account</h2>

            <?php if (!empty($success)) { ?>
                <p class="success-msg">✅ Account created successfully</p>
            <?php } elseif (!empty($error)) { ?>
                <p class="error-msg"><?php echo $error; ?></p>
            <?php } ?>

            <form method="POST">
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Register</button>
            </form>

            <p class="form-footer">
                Already registered? <a href="login.php">Login</a>
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
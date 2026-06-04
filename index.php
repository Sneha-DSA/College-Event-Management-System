<!DOCTYPE html>
<html>
<head>
    <title>College Event Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

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

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <h1>College Event Management System</h1>
        <p>Discover and participate in amazing campus events.</p>
        <a href="event/index.php" class="btn">Explore Events</a>
    </div>

   
</section>
<section class="features">
    <h2>Why Choose Our Platform?</h2>
    <div class="cards">
        <div class="card">
            <h3>Easy Event Registration</h3>
            <p>Students can register for events in just one click.</p>
        </div>
        <div class="card">
            <h3>Manage Events</h3>
            <p>Admins can add, update and manage college events.</p>
        </div>
        <div class="card">
            <h3>Secure Login</h3>
            <p>Separate login for students and administrators.</p>
        </div>
    </div>
</section>
<!-- FOOTER -->
<div class="footer">
    © 2026 College Event Management System
</div>
<style>.features {
    text-align: center;
    padding: 60px 20px;
}

.cards {
    display: flex;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
}

.card {
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    width: 280px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);

    /* Animation */
    opacity: 0;
    transform: translateY(40px);
    animation: fadeUp 0.8s ease forwards;

    /* Hover effect */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Delay for each card */
.card:nth-child(1) {
    animation-delay: 0.2s;
}
.card:nth-child(2) {
    animation-delay: 0.5s;
}
.card:nth-child(3) {
    animation-delay: 0.8s;
}

/* Hover Animation */
.card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

/* Keyframes */
@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card h3 {
    color: #4f46e5;
    margin-bottom: 10px;
}

.card p {
    color: #555;
}</style>
</body>
</html>

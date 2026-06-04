<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="site-header">
  <div class="navbar">

    <div class="nav-title">College Event Portal</div>

   <div class="nav-right">
    <a href="/college/index.php">Home</a>
    <a href="/college/event/index.php">Events</a>
    <a href="/college/event/add_event.php">Add Event</a>
    <a href="/college/gallery.php">Gallery</a>
    
<a href="event/register.php">Register</a>

    <?php if (isset($_SESSION['user'])) { ?>
        <a href="/college/logout.php">Logout</a>
    <?php } else { ?>
        <a href="/college/login.php">Sign In</a>
    <?php } ?>
</div>

  </div>
</header>

<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>College Event Gallery</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
<style>
/* ===== RESET ===== */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

body{
  background:linear-gradient(135deg,#eef2ff,#f8fafc);
  color:#1f2933;
}

/* ===== HEADER ===== */
.page-header{
  text-align:center;
  padding:80px 20px 50px;
}



.page-header p{
  margin-top:10px;
  color:#4b5563;
}

/* ===== GALLERY ===== */
.gallery{
  max-width:1200px;
  margin:auto;
  padding:30px;
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:35px;
}

/* ===== CARD ===== */
.card{
  position:relative;
  background:#fff;
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 20px 40px rgba(0,0,0,0.12);
  transition:.4s;
  animation:fadeUp .8s ease forwards;
}

@keyframes fadeUp{
  from{ opacity:0; transform:translateY(30px); }
  to{ opacity:1; transform:translateY(0); }
}

.card:hover{
  transform:translateY(-12px);
}

.card img{
  width:100%;
  height:220px;
  object-fit:cover;
}

/* ===== IMAGE OVERLAY ===== */
.overlay{
  position:absolute;
  inset:0;
  background:rgba(79,70,229,0.75);
  display:flex;
  align-items:center;
  justify-content:center;
  opacity:0;
  transition:.4s;
}

.overlay span{
  background:#fff;
  color:#4f46e5;
  padding:10px 20px;
  border-radius:30px;
  font-weight:600;
}

.card:hover .overlay{ opacity:1; }

/* ===== CONTENT ===== */
.card-content{
  padding:20px;
  text-align:center;
}

.card-content h3{
  font-size:20px;
  margin-bottom:6px;
}

.card-content p{
  font-size:14px;
  color:#6b7280;
}

/* ===== MODAL ===== */
.modal{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.85);
  display:none;
  align-items:center;
  justify-content:center;
  z-index:999;
}

.modal img{
  max-width:90%;
  max-height:85%;
  border-radius:12px;
}

.modal.active{ display:flex; }

.footer-space{ height:60px; }
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


<!-- HEADER -->
<div class="page-header">
  <h1>College Event Gallery</h1>
  <p>Moments that define our campus life</p>
</div>

<!-- GALLERY -->
<div class="gallery">

  <div class="card">
    <img src="img/event1.jpg" onclick="openModal(this.src)">
    <div class="card-content">
      <h3>Cultural Night</h3>
      <p>Music • Dance • Celebration</p>
    </div>
  </div>

  <div class="card">
    <img src="img/event2.jpg" onclick="openModal(this.src)">
    <div class="card-content">
      <h3>Art Exhibition</h3>
      <p>Creativity beyond limits</p>
    </div>
  </div>

  <div class="card">
    <img src="img/event3.jpg" onclick="openModal(this.src)">
    <div class="card-content">
      <h3>Annual Function</h3>
      <p>Memories made together</p>
    </div>
  </div>

</div>


<!-- GALLERY HIGHLIGHTS -->
<section class="highlights">

    <div class="section-heading">
        <h2>✨ Gallery Highlights</h2>
        <p>Celebrating the best moments from our campus events</p>
    </div>

    <div class="highlight-cards">

        <div class="highlight-box">
            <div class="highlight-icon">🎭</div>
            <h3>50+ Cultural Events</h3>
            <p>
                Music, dance, drama and entertainment programs organized throughout the year.
            </p>
        </div>

        <div class="highlight-box">
            <div class="highlight-icon">🏆</div>
            <h3>100+ Winners</h3>
            <p>
                Students recognized for excellence in academics, sports and competitions.
            </p>
        </div>

        <div class="highlight-box">
            <div class="highlight-icon">📸</div>
            <h3>1000+ Memories</h3>
            <p>
                Captured unforgettable moments shared by students and faculty members.
            </p>
        </div>

    </div>

</section>
<style>
  /* HIGHLIGHTS SECTION */

.highlights{
    max-width:1200px;
    margin:80px auto;
    padding:0 30px;
}

.section-heading{
    text-align:center;
    margin-bottom:45px;
}

.section-heading h2{
    font-size:36px;
    color:#111827;
    margin-bottom:10px;
}

.section-heading p{
    color:#6b7280;
}

.highlight-cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:30px;
}

.highlight-box{
    background:#fff;
    padding:35px 25px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 15px 35px rgba(0,0,0,0.08);
    transition:.3s;
}

.highlight-box:hover{
    transform:translateY(-10px);
}

.highlight-icon{
    font-size:50px;
    margin-bottom:15px;
}

.highlight-box h3{
    font-size:22px;
    margin-bottom:12px;
    color:#111827;
}

.highlight-box p{
    color:#6b7280;
    line-height:1.7;
}
</style>

<!-- MODAL -->
<div class="modal" id="imgModal" onclick="closeModal()">
  <img id="modalImg">
</div>

<div class="footer-space"></div>

<script>
function openModal(src){
  document.getElementById('modalImg').src = src;
  document.getElementById('imgModal').classList.add('active');
}
function closeModal(){
  document.getElementById('imgModal').classList.remove('active');
}
</script>
<!-- FOOTER -->
<div class="footer">
    © 2026 College Event Management System
</div>
</body>
</html>

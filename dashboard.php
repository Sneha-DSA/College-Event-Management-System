<?php
include "db_connect.php";

/* Count events */
$eventResult = mysqli_query($conn, "SELECT id FROM events");
$totalEvents = $eventResult ? mysqli_num_rows($eventResult) : 0;

/* Count registrations */
$regResult = mysqli_query($conn, "SELECT id FROM registrations");
$totalRegistrations = $regResult ? mysqli_num_rows($regResult) : 0;
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CE Portal — Dashboard</title>

  <!-- Bootstrap (optional, helps layout) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Your custom styles -->
  <link rel="stylesheet" href="css/style.css">

</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="#">CE Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link" href="#">Events</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Upcoming</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Impact</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-secondary">Sign In</button>
          <button class="btn btn-primary">Create Event</button>
        </div>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="hero">
    <div class="container hero-inner text-center">
      <h1 class="hero-title">Discover, Join &amp; Create College Events</h1>
      <p class="lead text-muted mb-4">Centralized portal for students, faculty, and clubs to manage events, ticketing, and coordination.</p>

      <div class="search-row justify-content-center">
        <input id="searchInput" class="search-input form-control" placeholder="Search events..." />
        <select id="filterSelect" class="search-select form-select">
          <option value="all">All</option>
          <option value="tech">Tech</option>
          <option value="cultural">Cultural</option>
          <option value="sports">Sports</option>
        </select>
        <button id="searchBtn" class="search-btn btn">Search</button>
      </div>
    </div>
  </header>

  <!-- UPCOMING EVENTS SECTION -->
  <section class="section">
    <div class="container">
      <h2 class="mb-4">Upcoming Events</h2>

      <div id="eventsGrid" class="events-grid">
        <!-- event cards inserted by JS -->
      </div>
    </div>
  </section>

  <!-- Footer (small) -->
  <footer class="py-4 text-center text-muted">
    © <span id="yr"></span> CE Portal — Built by you
  </footer>

  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Small interactive script: sample events + search/filter -->
  <script>
    // sample events (you can load these dynamically later)
    const events = [
      { id:1, name:"Annual Tech Fest", date:"2025-12-20", venue:"College Auditorium", category:"tech", img:"/mnt/data/aca346f3-f378-42ca-b5d4-27e5ca8d17cc.png", desc:"Hackathons, workshops, and project exhibits."},
      { id:2, name:"Cultural Day", date:"2026-01-05", venue:"Main Ground", category:"cultural", img:"/mnt/data/aca346f3-f378-42ca-b5d4-27e5ca8d17cc.png", desc:"Dance, music, drama and fashion show."},
      { id:3, name:"Intercollege Sports Meet", date:"2026-02-28", venue:"Indoor Stadium", category:"sports", img:"/mnt/data/aca346f3-f378-42ca-b5d4-27e5ca8d17cc.png", desc:"Athletics, badminton and football tournaments."},
      { id:4, name:"AI Workshop", date:"2025-11-30", venue:"Lab 4", category:"tech", img:"/mnt/data/aca346f3-f378-42ca-b5d4-27e5ca8d17cc.png", desc:"Intro to ML & hands-on sessions."}
    ];

    const grid = document.getElementById('eventsGrid');
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');
    const searchBtn = document.getElementById('searchBtn');

    function renderEvents(list){
      grid.innerHTML = '';
      if(!list.length){
        grid.innerHTML = '<p class="text-muted">No events found.</p>';
        return;
      }
      list.forEach(e => {
        const card = document.createElement('div');
        card.className = 'event-card';
        card.innerHTML = `
          <div class="thumb" style="background-image:url('${e.img}');"></div>
          <div class="p-3 d-flex flex-column" style="gap:.6rem">
            <h3 class="mb-0">${escapeHtml(e.name)}</h3>
            <div class="event-meta">
              <small>📅 ${new Date(e.date).toLocaleDateString()}</small>
              <small> • </small>
              <small>📍 ${escapeHtml(e.venue)}</small>
            </div>
            <p class="desc mb-0">${escapeHtml(e.desc)}</p>
            <div class="event-actions mt-2">
              <button class="btn-ghost">Details</button>
              <button class="btn-primary" style="margin-left:auto">Register</button>
            </div>
          </div>
        `;
        grid.appendChild(card);
      });
    }

    function escapeHtml(s){
      if(!s) return '';
      return s.replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;');
    }

    function applyFilter(){
      const q = searchInput.value.trim().toLowerCase();
      const cat = filterSelect.value;
      const filtered = events.filter(ev => {
        const matchesQ = !q || ev.name.toLowerCase().includes(q) || ev.desc.toLowerCase().includes(q);
        const matchesCat = cat === 'all' || ev.category === cat;
        return matchesQ && matchesCat;
      });
      renderEvents(filtered);
    }

    searchBtn.addEventListener('click', applyFilter);
    searchInput.addEventListener('keydown', (e)=> { if(e.key==='Enter') applyFilter(); });

    // initial render
    renderEvents(events);

    // footer year
    document.getElementById('yr').textContent = new Date().getFullYear();
  </script>

</body>
</html>

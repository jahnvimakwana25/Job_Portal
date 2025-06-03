<?php
session_start();
require_once 'db.php';
$obj = new JobPortal();

$fullTimeJobs = $obj->getJobsByType('Full Time');
$partTimeJobs = $obj->getJobsByType('Part Time');
$internshipJobs = $obj->getJobsByType('Internship');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home - Job Portal</title>
  <link rel="stylesheet" href="CSS/style.css">
  <style>
   * {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial, sans-serif;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 10px;
}

.main-header {
  background-color: #2c3e50;
  color: white;
  padding: 10px 0;
}

.header-flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo a {
  color: white;
  font-size: 28px;
  text-decoration: none;
  font-weight: bold;
  margin-left: 10px; /* spacing added after header "Job Portal" */
}

.main-nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  gap: 20px;
}

.main-nav a {
  color: white;
  text-decoration: none;
  font-size: 16px;
}

/* Full-width slider styling */
.slider-wrapper {
  margin-top: 20px;
  width: 100%;
}

.slider-container {
  position: relative;
  width: 100%;
  max-height: 450px;
  overflow: hidden;
}

.mySlides {
  display: none;
}

.mySlides img {
  width: 100%;
  height: 450px;
  object-fit: cover;
}

.numbertext {
  color: #f2f2f2;
  font-size: 14px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
  background: rgba(0, 0, 0, 0.5);
}

.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  background-color: rgba(0, 0, 0, 0.5);
  transform: translateY(-50%);
  z-index: 1;
}

.next { right: 0; }
.prev { left: 0; }
/* Job Section Title */
.job-section h1 {
  font-size: 28px;
  margin-bottom: 20px;
  color: #003366;
}

/* Job Menu Tabs */
.job-menu {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-bottom: 40px;
  flex-wrap: wrap;
}

.job-type-btn {
  padding: 10px 25px;
  border: 2px solid #003366;
  background-color: white;
  color: #003366;
  border-radius: 30px;
  font-size: 16px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
}

.job-type-btn:hover {
  background-color: #003366;
  color: white;
}

.job-type-btn.active {
  background-color: #003366;
  color: white;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Job Lists */
.job-list {
  display: none;
  justify-content: center;
  flex-wrap: wrap;
  gap: 30px;
  padding: 0 20px;
}

/* Job Card */
.job-card {
  background-color: white;
  border: 1px solid #ddd;
  width: 1000px;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.06);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.job-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

.job-card h3 {
  margin: 0 0 10px;
  color: #003366;
}

.job-card p {
  margin: 6px 0;
  font-size: 14px;
  color: #333;
}

.job-card p strong {
  color: #555;
}


/* Footer */
footer {
  background-color: #2c3e50;
  color: white;
  padding: 15px 0;
  text-align: center;
  margin-top: 40px;
}

  </style>

  <script>
    let slideIndex = 1;
    function showSlides(n) {
      let slides = document.getElementsByClassName("mySlides");
      if (n > slides.length) { slideIndex = 1 }
      if (n < 1) { slideIndex = slides.length }
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slides[slideIndex - 1].style.display = "block";
    }

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    window.onload = () => {
      showSlides(slideIndex);

      // Tabs
      const buttons = document.querySelectorAll('.job-type-btn');
      const lists = document.querySelectorAll('.job-list');
      buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
          const type = btn.getAttribute('data-type');
          buttons.forEach(b => b.classList.remove('active'));
          lists.forEach(l => l.style.display = 'none');
          btn.classList.add('active');
          document.getElementById('job-' + type).style.display = 'block';
        });
      });

      // Set default tab active
      buttons[0].classList.add('active');
      document.getElementById('job-full').style.display = 'block';
    };
  </script>
</head>
<body>

<!-- Header -->
<header class="main-header">
  <div class="container header-flex">
    <div class="logo"><a href="index.php">Job Portal</a></div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <nav class="main-nav">
      <ul class="nav-links center-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="user/login.php">Jobs</a></li>
        <li><a href="user/login.php">About</a></li>
        <li><a href="user/login.php">Contact</a></li>
      </ul>
      <ul class="nav-links right-nav">
        <li><a href="user/register.php">Register</a></li>
        <li><a href="user/login.php">Login</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- Slider -->
<div class="container slider-wrapper">
  <div class="mySlides"><img src="images/slider1.jpg"></div>
  <div class="mySlides"><img src="images/slider2.jpg"></div>
  <div class="mySlides"><img src="images/slider3.jpg"></div>
  <div class="mySlides"><img src="images/slider4.jpg"></div>

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>


<!-- Job Type Menu -->
<div class="container job-section">

<h1 align="center">Explore Career Opportunities</h1><br><br>
  <div class="job-menu">
    <button class="job-type-btn" data-type="full">Full Time</button>
    <button class="job-type-btn" data-type="part">Part Time</button>
    <button class="job-type-btn" data-type="intern">Internship</button>
  </div>

  <!-- Full Time -->
  <div id="job-full" class="job-list" style="display:none;">
    <?php foreach ($fullTimeJobs as $job): ?>
      <div class="job-card">
        <h3><?= htmlspecialchars($job['jobtitle']) ?></h3>
        <p><strong>Company:</strong> <?= htmlspecialchars($job['company_name']) ?></p>
        <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Part Time -->
  <div id="job-part" class="job-list" style="display:none;">
    <?php foreach ($partTimeJobs as $job): ?>
      <div class="job-card">
        <h3><?= htmlspecialchars($job['jobtitle']) ?></h3>
        <p><strong>Company:</strong> <?= htmlspecialchars($job['company_name']) ?></p>
        <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Internship -->
  <div id="job-intern" class="job-list" style="display:none;">
    <?php foreach ($internshipJobs as $job): ?>
      <div class="job-card">
        <h3><?= htmlspecialchars($job['jobtitle']) ?></h3>
        <p><strong>Company:</strong> <?= htmlspecialchars($job['company_name']) ?></p>
        <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="container">
    <p>&copy; <?= date("Y") ?> JobPortal. All rights reserved.</p>
  </div>
</footer>

</body>
</html>

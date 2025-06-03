<?php
require '../db.php';
session_start();
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
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
  <link rel="stylesheet" href="../CSS/home.css">
  <link rel="stylesheet" href="../CSS/style.css">
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

<header class="main-header">
    <div class="container header-flex">
        <div class="logo">
            <a href="index.php">Job Portal</a>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <nav class="main-nav">
            <ul class="nav-links center-nav">
                <li><a href="../index.php">Home</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>

            <div  style="align-item:right">
            <a href="../logout.php" class="logout-btn">Logout</a>
    </div>
        </nav>
    </div>
</header>


<!-- Slider -->
<div class="container slider-wrapper">
  <div class="mySlides"><img src="../images/slider1.jpg"></div>
  <div class="mySlides"><img src="../images/slider2.jpg"></div>
  <div class="mySlides"><img src="../images/slider3.jpg"></div>
  <div class="mySlides"><img src="../images/slider4.jpg"></div>

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br><br><br>
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

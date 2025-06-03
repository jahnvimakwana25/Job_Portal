<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/home.css"> <!-- Adjust path if in css/ folder -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<!-- Header -->
<header class="main-header">
  <div class="container header-flex">
    <!-- Logo -->
    <div class="logo">
      <a href="index.php">Job Portal</a>
    </div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <!-- Navigation Menu -->
    <nav class="main-nav">
      <ul class="nav-links ">
        <li><a href="home.php">Home</a></li>
        <li><a href="jobs.php">Jobs</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>

      <div  style="align-item:right">
            <a href="../logout.php" class="logout-btn">Logout</a>
    </div>
  </div>
</header>
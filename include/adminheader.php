<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../user/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Job Portal</title>
    <link rel="stylesheet" href="../CSS/adminstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar .logout-btn {
            color: white;
            text-decoration: none;
            background-color: #e74c3c;
            padding: 5px 10px;
            border-radius: 4px;
            margin-left: 10px;
        }

        .navbar .welcome {
            margin-right: 10px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px; /* below navbar */
            left: 0;
            width: 220px;
            height: calc(100vh - 60px);
            background-color: #2c3e50;
            color: white;
            overflow-y: auto;
            padding-top: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 12px 20px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #2c3e50;
            border-radius: 4px;
        }

        .dropdown-content {
            display: none;
            background-color: #2c3e50;
            margin-top: 5px;
            margin-left: 15px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content li {
            padding: 10px;
        }

        /* Main content area */
        .main-content {
            margin-left: 220px;
            margin-top: 60px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h2>Job Portal - Admin</h2>
        <div>
            <span class="welcome">Welcome, <?php echo $_SESSION['username']; ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="../admin/dashboard.php">Dashboard</a></li>
            <li class="dropdown">
                <a href="#">Manage Category <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="add_category.php">Add Category</a></li>
                    <li><a href="display_category.php">View Category</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Manage Jobs <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="add_job.php">Add Job</a></li>
                    <li><a href="display_job.php">View Job</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Main Content Wrapper -->
    <div class="main-content">

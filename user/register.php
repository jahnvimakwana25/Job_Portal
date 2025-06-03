<?php
require '../db.php';
$obj = new JobPortal();
$conn = $obj->conn;

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['btnsub'])) {
    $name      = trim($_POST['name']);
    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $phone     = trim($_POST['phone']);
    $gender    = $_POST['gender'] ?? '';
    $address   = trim($_POST['address']);
    $role      = 'user';

    $hasErrors = false;

    if (empty($name)) {
        echo "<p style='color:red;'>Full Name is required.</p>";  
        $hasErrors = true;
    } else {
        if (!preg_match("/^[a-zA-Z ]{3,100}$/", $name)) {
            echo "<p style='color:red;'>Full Name must be 3-100 letters and spaces only.</p>";  
            $hasErrors = true;
        }
    }

    if (empty($username)) {
        echo "<p style='color:red;'>Username is required.</p>";  
        $hasErrors = true;
    } else {
        if (!preg_match("/^[a-zA-Z0-9_]{4,20}$/", $username)) {
            echo "<p style='color:red;'>Username must be 4-20 characters (letters, numbers, underscore).</p>";  
            $hasErrors = true;
        }
    }

    if (empty($email)) {
        echo "<p style='color:red;'>Email is required.</p>";  
        $hasErrors = true;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red;'>Invalid email format.</p>";  
            $hasErrors = true;
        }
    }

    if (empty($password)) {
        echo "<p style='color:red;'>Password is required.</p>";  
        $hasErrors = true;
    } else {
        if (strlen($password) < 6) {
            echo "<p style='color:red;'>Password must be at least 6 characters.</p>";  
            $hasErrors = true;
        }
    }

    if (empty($phone)) {
        echo "<p style='color:red;'>Phone number is required.</p>";  
        $hasErrors = true;
    } else {
        if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
            echo "<p style='color:red;'>Phone must be 10-15 digits only.</p>";  
            $hasErrors = true;
        }
    }

    if (empty($gender)) {
        echo "<p style='color:red;'>Gender is required.</p>";  
        $hasErrors = true;
    } else {
        if (!in_array($gender, ['Male', 'Female', 'Other'])) {
            echo "<p style='color:red;'>Please select a valid gender.</p>";  
            $hasErrors = true;
        }
    }

    if (empty($address)) {
        echo "<p style='color:red;'>Address is required.</p>";  
        $hasErrors = true;
    } else {
        if (strlen($address) < 10 || strlen($address) > 255) {
            echo "<p style='color:red;'>Address must be between 10 and 255 characters.</p>";  
            $hasErrors = true;
        }
    }

    if (!$hasErrors) {
        try {
            $obj->registerUser($name, $username, $email, $password, $phone, $gender, $address, $role);
            $success = "<p style='color:green;'>Registered successfully!</p>";
            header("Location:login.php");
            echo $success;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                $error = "<p style='color:red;'>Email or Username already exists.</p>";
            } else {
                $error = "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
            }
            echo $error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registration</title>
  <link rel="stylesheet" href="../CSS/style.css" />
  <style>
  .registration-page {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding-bottom: 30px;
  }

  .registration-page form {
    max-width: 500px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .registration-page form h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
  }

  .registration-page table {
    width: 100%;
    margin-bottom: 20px;
  }

  .registration-page table td {
    padding: 10px;
  }

  .registration-page table label {
    font-size: 16px;
    color: #2c3e50;
  }

  .registration-page input[type="text"],
  .registration-page input[type="email"],
  .registration-page input[type="password"],
  .registration-page textarea,
  .registration-page select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    margin-bottom: 10px;
    box-sizing: border-box;
  }

  .registration-page button[type="submit"] {
    width: 100%;
    padding: 14px;
    background-color: #28a745;
    border: none;
    color: white;
    font-size: 18px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .registration-page button[type="submit"]:hover {
    background-color: #218838;
  }

  .registration-page p {
    text-align: center;
    font-size: 16px;
  }

  .registration-page p[style*="color:green"] {
    color: #28a745;
  }

  .registration-page a {
    color: #007bff;
    text-decoration: none;
  }

  .registration-page a:hover {
    text-decoration: underline;
  }

  /* Header style remains global */
  .main-header {
    background-color: #2c3e50;
    padding: 20px 0;
  }

  .header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
  }

  .logo a {
    font-size: 24px;
    color: white;
    text-decoration: none;
  }

  .main-nav {
    display: flex;
    justify-content: space-between;
    width: 60%;
  }

  .main-nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  .main-nav ul li {
    display: inline-block;
    margin-right: 20px;
  }

  .main-nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
  }

  .main-nav ul li a:hover {
    color: #28a745;
  }
  </style>
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
        <li><a href="login.php">Jobs</a></li>
        <li><a href="login.php">About</a></li>
        <li><a href="login.php">Contact</a></li>
      </ul>
      <ul class="nav-links right-nav">
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </div>
</header>

<div class="registration-page">
  <form action="" method="POST">
    <h1>Registration Form</h1>
    <table border="0" cellpadding="10">
      <tr>
        <td><label for="name">Full Name:</label></td>
        <td><input type="text" name="name" id="name" placeholder="Full Name" ></td>
      </tr>
      <tr>
        <td><label for="username">Username:</label></td>
        <td><input type="text" name="username" id="username" placeholder="Username" ></td>
      </tr>
      <tr>
        <td><label for="email">Email:</label></td>
        <td><input type="email" name="email" id="email" placeholder="Email" ></td>
      </tr>
      <tr>
        <td><label for="password">Password:</label></td>
        <td><input type="password" name="password" id="password" placeholder="Password" ></td>
      </tr>
      <tr>
        <td><label for="phone">Phone Number:</label></td>
        <td><input type="text" name="phone" id="phone" placeholder="Phone Number" ></td>
      </tr>
      <tr>
        <td><label for="gender">Gender:</label></td>
        <td>
          <select name="gender" id="gender" >
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="address">Address:</label></td>
        <td><textarea name="address" id="address" placeholder="Address" rows="4" cols="30" ></textarea></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center;">
          <button type="submit" name="btnsub">Register</button>
        </td>
      </tr>
    </table>
    <p style="text-align:center; margin-top: 10px;">
      Already registered? <a href="login.php">Login here</a>
    </p>
  </form>
</div>

<?php include('../include/footer.php'); ?>
</body>
</html>

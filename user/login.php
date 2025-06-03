<?php
require '../db.php';
session_start();
$obj = new JobPortal();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnlogin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        // Admin login
        if ($username === 'admin' && $password === 'admin25') {
            $_SESSION['username'] = 'admin';
            $_SESSION['role'] = 'admin';
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            // Check if username exists
            if ($obj->isusernameexists($username)) {
                // Validate user credentials
                if ($obj->validateUser($username, $password)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'user';
                    header("Location: ../user/home.php");
                    exit;
                } else {
                    $error = "Invalid password. Please try again.";
                }
            } else {
                $error = "Username does not exist.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Job Portal</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

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

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .error {
            color: #e74c3c;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .error a {
            color: #3498db;
            text-decoration: none;
        }

        .error a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        table th {
            text-align: left;
            padding-right: 10px;
            font-size: 16px;
            color: #2c3e50;
        }

        table td {
            padding: 10px;
        }

        table input[type="text"], table input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        table input[type="submit"] {
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

        table input[type="submit"]:hover {
            background-color: #218838;
        }
        .register-link {
    text-align: center;
    margin-top: 10px;
}

.register-link a {
    color: #3498db;
    text-decoration: none;
    font-size: 15px;
}

.register-link a:hover {
    text-decoration: underline;
    color: #2c80d3;
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

<div class="login-container">

    <?php if (!empty($error)): ?>
        <div class="error">
            <script>alert("<?= htmlspecialchars($error) ?>");</script>
            <p><?= htmlspecialchars($error) ?></p>
            <?php if ($error === "Username does not exist."): ?>
                <p>Don't have an account? <a href="register.php">Register here</a>.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <h2>Login Form</h2>
        <table>
            <tr>
                <th>Username:</th>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" value="Login" name="btnlogin">
                </td>
            </tr>
        </table>       
        <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
    </form>
</div>

</body>
</html>
<?php include('../include/footer.php'); ?>

<?php
include '../db.php';
include('../include/header.php');

$obj = new JobPortal();

if (isset($_GET['jobid'])) {
    $jobid = $_GET['jobid'];
    $jobdetails = $obj->GetJobDetails($jobid);
}

if (!$jobdetails) {
    echo "Job not found.";
    exit();
}

session_start(); // For success/error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $applicant_name = trim($_POST['applicant_name']);
    $applicant_email = trim($_POST['applicant_email']);

    // Validate form data
    if (empty($applicant_name) || empty($applicant_email)) {
        $_SESSION['error'] = "Name and email are required.";
    } else {
        // Insert application into the database
        if ($obj->ApplyForJob($jobid, $applicant_name, $applicant_email)) {
            $_SESSION['success'] = "Your application has been submitted successfully.";
            echo "<script>alert('Successfully Apply...')</script>";
            header("Location: job_details.php?jobid=$jobid");
            exit();
        } else {
            $_SESSION['error'] = "Failed to submit application. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for Job - <?= htmlspecialchars($jobdetails['jobtitle']) ?></title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/style.css">
    
    <style>
        /* Container */
.container {
    width: 90%;
    max-width: 1500px;
    font-family: 'Segoe UI', sans-serif;
}

/* Page title */
.container h1 {
    font-size: 28px;
    text-align: center;
    color: #34495e;
    margin-bottom: 30px;
}

/* Form group styling */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
}

input[type="text"],
input[type="email"],
input[type="file"],
textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

input:focus,
textarea:focus {
    border-color: #34495e;
    outline: none;
}

/* Submit button */
.apply-button {
    background-color: #34495e;
    color: #fff;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.apply-button:hover {
    background-color: #34495e;
}

/* Success and error messages */
.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    border-radius: 6px;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #f5c6cb;
    border-radius: 6px;
}

/* Responsive */
@media (max-width: 600px) {
    .container {
        padding: 20px;
    }

    .apply-button {
        width: 100%;
    }
}
</style>
    
</head>
<body>

<div class="container">
    <br><br>
    <h1>Apply for Job: <?= htmlspecialchars($jobdetails['jobtitle']) ?></h1>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="applicant_name">Full Name:</label>
            <input type="text" name="applicant_name" id="applicant_name" required>
        </div>

        <div class="form-group">
            <label for="applicant_email">Email Address:</label>
            <input type="email" name="applicant_email" id="applicant_email" required>
        </div>

        

        <div class="form-group">
            <button type="submit" class="apply-button">Submit Application</button>
        </div>
    </form>
</div>

</body>
</html>

<?php include('../include/footer.php'); ?>

<?php
include '../db.php';
include('../include/header.php');

$obj = new JobPortal();

// Fetch job details by jobid from the URL
if (isset($_GET['jobid'])) {
    $jobid = $_GET['jobid'];
    $jobdetails = $obj->GetJobDetails($jobid); // You must have this method returning associative array
}

// If no job found, show error
if (!$jobdetails) {
    echo "Job not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - <?= htmlspecialchars($jobdetails['title']) ?></title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        /* Main container */
.container {
    width: 90%;
    max-width: 1500px;
    font-family: 'Segoe UI', sans-serif;
}

/* Job title */
.job-title {
    font-size: 32px;
    color: #34495e;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center;
}

/* General job info blocks */
.job-company,
.job-location,
.job-type,
.job-salary,
.job-postedby {
    font-size: 18px;
    color: #333;
    margin: 10px 0;
}

/* Description block */
.job-description {
    margin: 20px 0;
}

.job-description h3 {
    font-size: 22px;
    margin-bottom: 10px;
    color:     color: #333;
    ;
}



/* Apply button */
.job-apply {
    margin-top: 30px;
    text-align: center;
}

.apply-button {
    padding: 12px 24px;
    background-color: #34495e;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.apply-button:hover {
    background-color: #34495e;
}

/* Responsive */
@media (max-width: 600px) {
    .container {
        padding: 20px;
    }

    .job-title {
        font-size: 26px;
    }

    .apply-button {
        width: 100%;
        display: block;
    }
}

</style>
</head>
<body>

<div class="container">
    <!-- Job Title -->
     <br><br>
    <h1 class="job-title"><?= htmlspecialchars($jobdetails['jobtitle']) ?></h1>

    <!-- Company -->
    <div class="job-company"><strong>Company:</strong> <?= htmlspecialchars($jobdetails['company_name']) ?></div>

    <!-- Location -->
    <div class="job-location"><strong>Location:</strong> <?= htmlspecialchars($jobdetails['location']) ?></div>

    <!-- Description -->
    <div class="job-description">
    <strong>Description: </strong><?= nl2br(htmlspecialchars($jobdetails['description'])) ?>
    </div>

    <!-- Job Type -->
    <div class="job-type">
        <strong>Job Type:</strong> <?= htmlspecialchars($jobdetails['jobtype']) ?>
    </div>

    <!-- Salary Range -->
    <div class="job-salary">
        <strong>Salary Range:</strong> <?= htmlspecialchars($jobdetails['salaryrange']) ?>
    </div>

    <!-- Posted By -->
    <div class="job-postedby">
        <strong>Posted By:</strong> <?= htmlspecialchars($jobdetails['postedby']) ?>
    </div>

    <!-- Apply Button -->
    <div class="job-apply">
        <a href="job_apply.php?jobid=<?= $jobdetails['jobid'] ?>" class="apply-button">Apply for this Job</a>
    </div>
</div>

</body>
</html>

<?php include('../include/footer.php'); ?>

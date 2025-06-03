<?php
include '../db.php';
include('../include/header.php');

$obj = new JobPortal();
$categoryName = isset($_GET['category']) ? $_GET['category'] : '';

$jobs = $obj->GetJobsByCategoryName($categoryName);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categoryName) ?> Jobs</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        /* Container styling */
.container {
    width: 90%;
    max-width: 1500px;   
}

/* Page title */
.category-title {
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    color: #34495e;
    margin-bottom: 30px;
}

/* Job listing container */
.job-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Individual job card */
.job-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f9f9f9;
    border-left: 5px solid #34495e;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    transition: background-color 0.3s;
}

.job-item:hover {
    background-color: #eef5ff;
}

/* Job info section */
.job-details {
    flex-grow: 1;
}

.job-title {
    font-size: 20px;
    color: #002244;
    font-weight: 600;
    margin-bottom: 5px;
}

.job-company {
    font-size: 16px;
    color: #555;
    margin-bottom: 4px;
}

.job-location {
    font-size: 15px;
    color: #777;
}

/* "View Details" button */
.job-actions .job-link {
    display: inline-block;
    padding: 10px 16px;
    background-color: #34495e;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.job-actions .job-link:hover {
    background-color: #34495e;
}

/* Message when no jobs found */
.no-jobs {
    text-align: center;
    font-size: 18px;
    color: #999;
    margin-top: 40px;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .job-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .job-actions {
        margin-top: 10px;
        align-self: stretch;
    }

    .job-actions .job-link {
        width: 100%;
        text-align: center;
    }
}

        </style>
</head>
<body>

    <div class="container">
    <br><br>
        <h1 class="category-title"><?= htmlspecialchars($categoryName) ?> Jobs</h1>

        <?php if (count($jobs) > 0): ?>
            <div class="job-list">
                <?php foreach ($jobs as $job): ?>
                    <div class="job-item">
                        <div class="job-details">
                            <div class="job-title"><?= htmlspecialchars($job['jobtitle']) ?></div>
                            <div class="job-company"><?= htmlspecialchars($job['company_name']) ?></div>
                            <div class="job-location"><?= htmlspecialchars($job['location']) ?></div>
                        </div>
                        <div class="job-actions">
                            <a href="job_details.php?jobid=<?= $job['jobid'] ?>" class="job-link">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-jobs">No jobs found in this category.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include('../include/footer.php'); ?>

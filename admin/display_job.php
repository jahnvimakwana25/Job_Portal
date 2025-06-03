<?php
require '../db.php';  // Include database connection

$obj = new JobPortal();  // Create an object of the JobPortal class

// Fetch all jobs from the database, including jobtype and salaryrange
$jobs = $obj->GetAllJobs();  // Make sure this method joins category table to fetch category name

?>

<?php include('../include/adminheader.php'); ?>  

<h2>All Jobs</h2>

<?php
// Display success or error messages if set
if (isset($_SESSION['error'])) {
    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Company</th>
            <th>Location</th>
            <th>Category</th>
            <th>Job Type</th>  <!-- New column for Job Type -->
            <th>Salary Range</th>  <!-- New column for Salary Range -->
            <th>Posted By</th>
            <th>Is Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($jobs): ?>
            <?php foreach ($jobs as $job): ?>
                <tr>
                    <td><?php echo $job['jobid']; ?></td>
                    <td><?php echo $job['jobtitle']; ?></td>
                    <td><?php echo $job['description']; ?></td>
                    <td><?php echo $job['company_name']; ?></td>
                    <td><?php echo $job['location']; ?></td>
                    <td><?php echo $job['categoryname']; ?></td>
                    <td><?php echo $job['jobtype']; ?></td>  <!-- Display Job Type -->
                    <td><?php echo $job['salaryrange']; ?></td>  <!-- Display Salary Range -->
                    <td><?php echo $job['postedby']; ?></td>
                    <td><?php echo $job['isactive']; ?></td>
                    <td>
                        <a href="update_job.php?jobid=<?php echo $job['jobid']; ?>">Edit</a> |
                        <a href="deactivate_job.php?jobid=<?php echo $job['jobid']; ?>" onclick="return confirm('Are you sure you want to deactivate this job?')">Deactivate</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No jobs found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

<?php
require '../db.php';

$obj = new JobPortal();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnupdatejob'])) {
    $jobid = $_POST['jobid'];
    $jobtitle = trim($_POST['jobtitle']);
    $description = trim($_POST['description']);
    $company = trim($_POST['company']);
    $location = trim($_POST['location']);
    $categoryid = $_POST['categoryid'];
    $postedby = $_POST['postedby'];
    $jobtype = $_POST['jobtype'];  // New field for job type
    $salaryrange = $_POST['salaryrange'];  // New field for salary range
    $isactive = isset($_POST['isactive']) ? 1 : 0;

    if (empty($jobtitle) || empty($description) || empty($company) || empty($location) || empty($categoryid)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        if ($obj->UpdateJob($jobid, $jobtitle, $description, $company, $location, $categoryid, $postedby, $jobtype, $salaryrange, $isactive)) {
            $_SESSION['success'] = "Job updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update job.";
        }
    }
    header("Location: display_job.php");
    exit();
}

$jobdetails = null;
if (isset($_GET['jobid'])) {
    $jobid = $_GET['jobid'];
    $jobdetails = $obj->GetJobDetails($jobid);
}
?>

<?php include('../include/adminheader.php'); ?>

<h2>Update Job</h2>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<form method="POST" action="">
    <table border="0" cellpadding="10">
        <tr>
            <td><label for="jobid">Job ID:</label></td>
            <td><input type="text" name="jobid" id="jobid" value="<?php echo htmlspecialchars($jobdetails['jobid']); ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="jobtitle">Job Title:</label></td>
            <td><input type="text" name="jobtitle" id="jobtitle" value="<?php echo htmlspecialchars($jobdetails['jobtitle']); ?>" required></td>
        </tr>
        <tr>
            <td><label for="description">Description:</label></td>
            <td><input type="text" name="description" id="description" value="<?php echo htmlspecialchars($jobdetails['description']); ?>" required></td>
        </tr>
        <tr>
            <td><label for="company">Company Name:</label></td>
            <td><input type="text" name="company" id="company" value="<?php echo htmlspecialchars($jobdetails['company_name']); ?>" required></td>
        </tr>
        <tr>
            <td><label for="location">Location:</label></td>
            <td><input type="text" name="location" id="location" value="<?php echo htmlspecialchars($jobdetails['location']); ?>" required></td>
        </tr>
        <tr>
            <td><label for="categoryid">Category:</label></td>
            <td>
                <select name="categoryid" required>
                    <option value="">Select Category</option>
                    <?php
                    $categories = $obj->GetAllCategories();  // Assuming you have a method to fetch categories
                    foreach ($categories as $category) {
                        echo "<option value='{$category['categoryid']}' " . ($category['categoryid'] == $jobdetails['categoryid'] ? 'selected' : '') . ">{$category['categoryname']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="jobtype">Job Type:</label></td>  <!-- New field for Job Type -->
            <td>
                <select name="jobtype" required>
                    <option value="Full Time" <?php echo ($jobdetails['jobtype'] == 'Full Time') ? 'selected' : ''; ?>>Full Time</option>
                    <option value="Part Time" <?php echo ($jobdetails['jobtype'] == 'Part Time') ? 'selected' : ''; ?>>Part Time</option>
                    <option value="Internship" <?php echo ($jobdetails['jobtype'] == 'Internship') ? 'selected' : ''; ?>>Internship</option>
                    
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="salaryrange">Salary Range:</label></td>  <!-- New field for Salary Range -->
            <td><input type="text" name="salaryrange" id="salaryrange" value="<?php echo htmlspecialchars($jobdetails['salaryrange']); ?>" required></td>
        </tr>
        <tr>
            <td><label for="postedby">Posted By:</label></td>
            <td><input type="text" name="postedby" id="postedby" value="<?php echo htmlspecialchars($jobdetails['postedby']); ?>" required></td>
        </tr>
        <tr>
            <td><label for="isactive">Is Active:</label></td>
            <td><input type="checkbox" name="isactive" id="isactive" <?php echo ($jobdetails['isactive'] == 1) ? 'checked' : ''; ?>></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button type="submit" name="btnupdatejob">Update Job</button>
            </td>
        </tr>
    </table>
</form>

</div> <!-- Close main-content from adminheader -->
</body>
</html>

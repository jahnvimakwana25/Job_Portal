<?php
require '../db.php';

$obj = new JobPortal();

$categories = $obj->GetAllCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnaddjob'])) {
    $jobtitle = trim($_POST['jobtitle']);
    $description = trim($_POST['description']);
    $company = trim($_POST['company']);
    $location = trim($_POST['location']);
    $categoryid = $_POST['categoryid'];
    $postedby = $_POST['postedby'];
    $jobtype = $_POST['jobtype'];  // New field
    $salaryrange = trim($_POST['salaryrange']);  // New field

    if (empty($jobtitle) || empty($description) || empty($company) || empty($location) || empty($categoryid) || empty($jobtype) || empty($salaryrange)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        if ($obj->AddJob($jobtitle, $description, $company, $location, $categoryid, $postedby, $jobtype, $salaryrange)) {
            $_SESSION['success'] = "Job added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add job.";
        }
    }
    header("Location: add_job.php");
    exit();
}
?>

<?php include('../include/adminheader.php'); ?>

<h2>Add Job</h2>

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
            <td><label for="jobtitle">Job Title:</label></td>
            <td><input type="text" name="jobtitle" id="jobtitle" required></td>
        </tr>
        <tr>
            <td><label for="description">Description:</label></td>
            <td><input type="text" name="description" id="description" required></td>
        </tr>
        <tr>
            <td><label for="company">Company Name:</label></td>
            <td><input type="text" name="company" id="company" required></td>
        </tr>
        <tr>
            <td><label for="location">Location:</label></td>
            <td><input type="text" name="location" id="location" required></td>
        </tr>
        <tr>
            <td><label for="categoryid">Category:</label></td>
            <td>
                <select name="categoryid" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['categoryid']; ?>"><?php echo $cat['categoryname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="postedby">Posted By:</label></td>
            <td><input type="text" name="postedby" id="postedby" required></td>
        </tr>
        <tr>
            <td><label for="jobtype">Job Type:</label></td>
            <td>
                <select name="jobtype" id="jobtype" required>
                    <option value="">Select Job Type</option>
                    <option value="Full Time">Full Time</option>
                    <option value="Internship">Internship</option>
                    <option value="Part Time">Part Time</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="salaryrange">Salary Range:</label></td>
            <td><input type="text" name="salaryrange" id="salaryrange" required></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button type="submit" name="btnaddjob">Add Job</button>
            </td>
        </tr>
    </table>
</form>

</body>
</html>

<?php  
require '../db.php';
$obj = new JobPortal();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnDeactivate'])) {
    $jobid = $_POST['jobid'];

    // Call the method to deactivate the job
    $obj->DeactivateJob($jobid);
    
    $_SESSION['success'] = "Job deactivated successfully.";
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

<h2>Deactivate Job</h2>

<?php
if (isset($_SESSION['success'])) {
    echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<form method="POST" action="">
    <table>
        <tr>
            <td><label for="jobid">Job ID to deactivate:</label></td>
            <td>
                <input type="text" name="jobid" id="jobid" 
                       value="<?php echo htmlspecialchars($jobdetails['jobid']); ?>" readonly>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <button type="submit" name="btnDeactivate">Deactivate Job</button>
            </td>
        </tr>
    </table>
</form>


</div> <!-- Close main-content from adminheader -->
</body>
</html>

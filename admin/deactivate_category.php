<?php  // Include the JobPortalAdmin class
require '../db.php';
$obj = new JobPortal();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnDeactivate'])) {
    $categoryid = $_POST['categoryid'];  // Get category ID from form input

    // Call the method to deactivate the category
    $obj->DeactivateCategory($categoryid);
    
    $_SESSION['success'] = "Category deactivated successfully.";
    header("Location: display_category.php");
    exit();
}
$categorydetails = null;
if (isset($_GET['categoryid'])) 
{
    $categoryid = $_GET['categoryid'];
    $categorydetails = $obj->GetCategoryDetails($categoryid);  
}
?>


<?php include('../include/adminheader.php'); ?>

<h2>Deactivate Job Category</h2>

<?php
if (isset($_SESSION['success'])) {
    echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<form method="POST" action="">
    <table>
        <tr>
            <td><label for="categoryid">Category ID to deactivate:</label></td>
            <td>
                <input type="text" name="categoryid" id="categoryid" 
                       value="<?php echo htmlspecialchars($categorydetails['categoryid']); ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <button type="submit" name="btnDeactivate">Deactivate Category</button>
            </td>
        </tr>
    </table>
</form>


</div> <!-- Close main-content from adminheader -->
</body>
</html>

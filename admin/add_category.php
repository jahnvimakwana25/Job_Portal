<?php
require '../db.php';
include('../include/adminheader.php');
$obj = new JobPortal();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnaddcat'])) {
    $categoryname = trim($_POST['categoryname']);
    $isactive = isset($_POST['isactive']) ? 1 : 0;

    if (empty($categoryname)) {
        $_SESSION['error'] = "Category name is required.";
    } else {
        if ($obj->AddCategory($categoryname, $isactive)) {
            $_SESSION['success'] = "Category added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add category.";
        }
    }
    header("Location: addcategory.php");
    exit();
}
?>

<h2>Add Job Category</h2>

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

<form method="POST">
    <table>
        <tr>
            <td><label for="categoryname">Category Name:</label></td>
            <td><input type="text" name="categoryname" id="categoryname" required></td>
        </tr>
        <tr>
            <td><label for="isactive">Is Active:</label></td>
            <td><input type="checkbox" name="isactive" id="isactive"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><button type="submit" name="btnaddcat">Add Category</button></td>
        </tr>
    </table>
</form>

</div></body></html>

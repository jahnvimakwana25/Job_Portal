<?php
require '../db.php';
include('../include/adminheader.php');
$obj = new JobPortal();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['categoryid'];
    $name = trim($_POST['categoryname']);
    $active = isset($_POST['isactive']) ? 1 : 0;

    if (empty($name)) {
        $_SESSION['error'] = "Category name required.";
    } else {
        if ($obj->UpdateCategory($id, $name, $active)) {
            $_SESSION['success'] = "Updated successfully.";
        } else {
            $_SESSION['error'] = "Update failed.";
        }
    }
    header("Location: viewcategory.php");
    exit();
}

$details = null;
if (isset($_GET['categoryid'])) {
    $details = $obj->GetCategoryDetails($_GET['categoryid']);
}
?>

<h2>Update Category</h2>

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
            <td><label>Category ID:</label></td>
            <td><input type="text" name="categoryid" readonly value="<?= $details['categoryid'] ?>"></td>
        </tr>
        <tr>
            <td><label>Category Name:</label></td>
            <td><input type="text" name="categoryname" required value="<?= $details['categoryname'] ?>"></td>
        </tr>
        <tr>
            <td><label>Is Active:</label></td>
            <td><input type="checkbox" name="isactive" <?= $details['isactive'] ? 'checked' : '' ?>></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><button name="btnupdatecat">Update</button></td>
        </tr>
    </table>
</form>

</div></body></html>

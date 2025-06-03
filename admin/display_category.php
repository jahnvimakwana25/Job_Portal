<?php
require '../db.php';
include('../include/adminheader.php');
$obj = new JobPortal();
$categories = $obj->GetAllCategories();
?>

<h2>All Job Categories</h2>

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

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($categories): ?>
            <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['categoryid'] ?></td>
                    <td><?= $cat['categoryname'] ?></td>
                    <td><?= $cat['isactive'] ? 'Active' : 'Inactive' ?></td>
                    <td>
                        <a href="update_category.php?categoryid=<?= $cat['categoryid'] ?>">Edit</a> |
                        <a href="deactivate_category.php?categoryid=<?= $cat['categoryid'] ?>" onclick="return confirm('Are you sure?')">Deactivate</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No categories found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</div></body></html>

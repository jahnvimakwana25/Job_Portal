<?php
require '../db.php'; // Your database connection
include('../include/header.php');

$obj = new JobPortal();
$categories = $obj->GetAllCategoriesActive();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Categories</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        .category-img {
            width: 200px;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid black;
        }
        table {
            margin: 0 auto;
        }
        td {
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>
<br><br><br>
<h1 style="text-align:center;">Job Categories</h1>

<table>
    <tr>
    <?php
    $count = 0;
    foreach ($categories as $cat):
        $imageName = strtolower(str_replace(" ", "_", $cat['categoryname'])) . ".jpg";
    ?>
        <td>
            <a href="job_category.php?category=<?= urlencode($cat['categoryname']) ?>">
                <img src="../images/<?= $imageName ?>" alt="<?= $cat['categoryname'] ?>" class="category-img">
            </a>
            <p><?= $cat['categoryname'] ?></p>
        </td>
    <?php
        $count++;
        if ($count % 3 == 0) echo "</tr><tr>"; 
    endforeach;
    ?>
    </tr>
</table>

</body>
</html>

<?php include('../include/footer.php'); ?>

<head>
    <title>Job Categories</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<br><br><br>
<h1 style="text-align:center;">Job Categories</h1>

<table>
    <tr>
    <?php
    $count = 0;
    foreach ($categories as $cat):
        $imageName = strtolower(str_replace(" ", "_", $cat['categoryname'])) . ".jpg";
    ?>
        <td>
            <a href="job_category.php?category=<?= urlencode($cat['categoryname']) ?>">
                <img src="../images/<?= $imageName ?>" alt="<?= $cat['categoryname'] ?>">
            </a>
            <p><?= $cat['categoryname'] ?></p>
        </td>
    <?php
        $count++;
        if ($count % 3 == 0) echo "</tr><tr>"; 
    endforeach;
    ?>
    </tr>
</table>

</body>
</html>

<?php include('../include/footer.php'); ?>

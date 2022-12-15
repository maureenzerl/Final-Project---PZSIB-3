<?php
include '../../connect.php';
$id = $_GET['id'];
$sql = "DELETE FROM category_lists WHERE category_id='$id'";
$datas = $conn->query($sql);

if (mysqli_affected_rows($conn) > 0) {
    header("Location:index.php");
} else {
    $_SESSION['error'] = "Failed to delete data!";
}

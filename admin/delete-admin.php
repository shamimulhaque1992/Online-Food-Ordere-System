<?php


include('../config/constants.php');

//get the value

$id = $_GET['id'];

//SQL for deleting the data

$sql = "DELETE FROM tbl_admin WHERE id=$id";


//execute query

$res = mysqli_query($conn, $sql);

if($res==TRUE)
{
    $_SESSION['delete']='<div class="success">Admin Deleted Successfully</div>';
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['delete']='<div class="error">Failed to Delete Admin try again later</div>';
    header('location:'.SITEURL.'admin/manage-admin.php');
}

?>
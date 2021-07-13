<?php


include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{


    //getting the value
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];



    //checking the image is available or not then delete from device folder
    if($image_name!="")
    {
        //setting the path of folder
        $path="../images/category/".$image_name;
        //removing the file
        $remove=unlink($path);


        if($remove==false)
        {
            $_SESSION['remove']='<div class="error">Failed to remove</div>';
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
    }

    //SQL for deleting the data

    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Executing the query
    $res = mysqli_query($conn, $sql);


    if($res==TRUE)
        {
            $_SESSION['delete']='<div class="success">Category Deleted Successfully</div>';
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete']='<div class="error">Failed to Delete Category try again later...</div>';
            header('location:'.SITEURL.'admin/manage-category.php');
        }







}
else
{
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>
<?php


include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //1. Get id And Image Name
    //getting the value
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    

    //remove the image from device
    if($image_name!="")
    {
        //setting the path of folder
        $path="../images/food/".$image_name;
        //removing the file
        $remove=unlink($path);


        if($remove==false)
        {
            $_SESSION['upload']='<div class="error">Failed to remove</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }



    //SQL to delet food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //Executing the query
    $res = mysqli_query($conn, $sql);
    //4.redirect ti manage page
    //Check the query executed or not and show massege in manage section
    if($res==TRUE)
        {
            $_SESSION['delete']='<div class="success">Food Deleted Successfully</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete']='<div class="error">Failed to Delete Food try again later...</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }



}
else
{
    $_SESSION['unauthorize']='<div class="error">Unauthorized Access...</div>';
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>
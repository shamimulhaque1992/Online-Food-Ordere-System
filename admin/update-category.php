<?php include('partials/menu.php');?>
<div class="main-content ">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>


        <?php
        
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];

            //SQL for getting all the value
            $sql = "SELECT * FROM tbl_category WHERE id=$id";



            //Execute the Query
            $res = mysqli_query($conn, $sql);

            
            //Count The Rows from Database
            $count=mysqli_num_rows($res);

            //Check
            if($count==1)
            {
                //$_SESSION['update']= "<div class = 'success'>Admin Updated Successfully</div>";
                //header('location:'.SITEURL.'admin/manage-admin.php');

                //Get All the data of particular id in update form
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];


            }
            else{
                $_SESSION['no-category-found'] = "<div class = 'error'>Category not Found...</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }



        }
        else
        {
            header("location:" . SITEURL . 'admin/manage-category.php');
        }
        
        
        
        
        
        
        ?>





        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>"><br>
                    </td>

                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image!="")
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>">
                                <?php
                            }
                            else
                            {
                                echo"<div class='error'>Image not Added.<?div>";
                            }
                        
                        ?>
                    </td>

                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image"><br>
                    </td>

                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No<br>
                    </td>

                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes

                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No<br>
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >

                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        
            if(isset($_POST['submit']))
            {
                
                
                //Getting the data from the form
                $id= $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //Upate new image
                //Check image selected or not


                if($_FILES['image']['name'])
                {
                    $image_name=$_FILES['image']['name'];
                    
                    
                    
                    
                    //Check is there any image or not
                    if($image_name!="")
                    {
                        //upload the new image
                        //remove the old image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;







                        //upload file
                        $upload = move_uploaded_file($source_path, $destination_path);


                        //check upload
    

                        if ($upload == false) {
                            $_SESSION['upload'] = '<div class="success">Failed to Upload!</div>';
                            header("location:" . SITEURL . 'admin/manage-category.php');
                            die();
                        }


                        //remove current image
                        
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove=unlink($remove_path);



                            //check removed or not
                            if($remove==false)
                            {
                                $_SESSION['failed-remove'] = '<div class="error">Failed to Remove The Current Image...</div>';
                                header("location:" . SITEURL . 'admin/manage-category.php');
                                die();
                            }
                        }
                        
                        




                    }
                    else
                    {
                        $image_name=$current_image;
                    }


                }
                else
                {
                    $image_name=$current_image;
                }

                // SQL for update database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name='$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";


                //Execute query
                $res2 = mysqli_query($conn, $sql2);


                //redirect to manage category


                //checking Execution

                if($res2 == true)
                {
                    $_SESSION['update'] = '<div class="success">Successfully Updated Category!</div>';
                    header("location:" . SITEURL . 'admin/manage-category.php');
                    //die();
                }
                else
                {
                    $_SESSION['update'] = '<div class="error">Failed to Updated Category!</div>';
                    header("location:" . SITEURL . 'admin/manage-category.php');
                }


            }
        
        
        
        
        
        ?>



    </div>
</div>

<?php include('partials/footer.php');?>
<?php include('partials/menu.php'); ?>

<?php

if (isset($_POST['submit'])) {


    //Getting the data from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //Upate new image
    //Check image selected or not


    if ($_FILES['image']['name']) {
        $image_name = $_FILES['image']['name'];




        //Check is there any image or not
        if ($image_name != "") {
            //upload the new image
            //remove the old image
            $ext = end(explode('.', $image_name));
            $image_name = "Food_Name_" . rand(000, 999) . '.' . $ext;

            $src_path = $_FILES['image']['tmp_name'];
            $dest_path = "../images/food/" . $image_name;







            //upload file
            $upload = move_uploaded_file($src_path, $dest_path);


            //check upload


            if ($upload == false) {
                $_SESSION['upload'] = '<div class="success">Failed to Upload!</div>';
                header("location:" . SITEURL . 'admin/manage-food.php');
                die();
            }


            //remove current image

            if ($current_image != "") {
                $remove_path = "../images/food/" . $current_image;
                $remove = unlink($remove_path);



                //check removed or not
                if ($remove == false) {
                    $_SESSION['failed-remove'] = '<div class="error">Failed to Remove The Current Image...</div>';
                    header("location:" . SITEURL . 'admin/manage-food.php');
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    // SQL for update database
    $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name='$image_name',
                    category_id='$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";


    //Execute query
    $res3 = mysqli_query($conn, $sql3);


    //redirect to manage category


    //checking Execution

    if ($res3 == true) {
        $_SESSION['update'] = '<div class="success">Successfully Updated Food!</div>';
        header("location:" . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['update'] = '<div class="error">Failed to Updated Food!</div>';
        header("location:" . SITEURL . 'admin/manage-food.php');
    }
}





?>




<div class="main-content ">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>


        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //SQL for getting all the value
            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";



            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_num_rows($res2);

            //Check

            //$_SESSION['update']= "<div class = 'success'>Admin Updated Successfully</div>";
            //header('location:'.SITEURL.'admin/manage-admin.php');

            //Get All the data of particular id in update form
            $row2 = mysqli_fetch_assoc($res2);
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            //$new_image = $row['new_name'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            header("location:" . SITEURL . 'admin/manage-food.php');
        }






        ?>





        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>"><br>
                    </td>

                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea><br>
                    </td>

                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>"><br>
                    </td>

                </tr>


                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>">
                        <?php
                        } else {
                            echo "<div class='error'>Image not Added.<?div>";
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
                    <td>Category:</td>
                    <td>
                        <select name="category">


                            <?php

                            //displaying foods from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";


                            //Execute Query
                            $res = mysqli_query($conn, $sql);

                            //Count rows to show
                            $count = mysqli_num_rows($res);


                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>

                                    <option <?php if ($current_category == $category_id) echo "selected"; ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                <?php
                                }
                            } else {

                                ?>
                                <option value="0">No Category Found</option>


                            <?php
                            }




                            ?>



                        </select><br>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No<br>
                    </td>

                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes

                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No<br>
                    </td>

                </tr>

                <tr>
                    <td colspan="2">


                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>





    </div>
</div>

<?php include('partials/footer.php'); ?>
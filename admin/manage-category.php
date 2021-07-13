<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }


        ?><br><br>

        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
            </tr>


            <?php



            //SQL to get all data from database
            $sql = "SELECT * FROM tbl_category";




            //SQL to get all data from database
            $res = mysqli_query($conn, $sql);


            //Count rows
            $count = mysqli_num_rows($res);

            //seriyal the values
            $sn = 1;

            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];




            ?>
                    <tr>
                        <td><?php echo $sn++; ?> .</td>
                        <td><?php echo $title ?></td>

                        <td>
                            <?php
                            //Check wheather the image name is available

                            if ($image_name != "") {
                            ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="200px" height="170px">

                            <?php
                            } else {
                                echo "<div class='error'>Image is not Available.</div>";
                            }

                            ?>
                        </td>

                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>

                        </td>
                    </tr>


                <?php

                }
            } else {

                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added</div>
                    </td>
                </tr>

            <?php

            }





            //while ($rows = mysqli_fetch_assoc($res)) {
            //$id = $rows['id'];
            //$full_name = $rows['full_name'];
            //$username = $rows['username'];


            ?>









        </table>
    </div>
</div>
<?php include("partials/footer.php"); ?>
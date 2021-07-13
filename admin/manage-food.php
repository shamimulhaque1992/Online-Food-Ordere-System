<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br>


        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>


        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>


            <?php



            //SQL to get all data from database
            $sql = "SELECT * FROM tbl_food";




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
                    $price = $rows['price'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];




            ?>
                    <tr>
                        <td><?php echo $sn++; ?> .</td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $price ?></td>

                        <td>
                            <?php
                            //Check wheather the image name is available

                            if ($image_name != "") {
                            ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="200px" height="170px">

                            <?php
                            } else {
                                echo "<div class='error'>Image is not Available.</div>";
                            }

                            ?>
                        </td>

                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>

                        </td>
                    </tr>


            <?php

                }
            } else {
                echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
            }


            ?>


        </table>
    </div>
</div>
<?php include("partials/footer.php"); ?>
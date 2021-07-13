<?php include('partials-front/menu.php') ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <?php
        
        //Get the search result
        $search = $_POST['search'];
        
        ?>

        <h2 class="text-black bg-gry">Foods on Your Search <a href="#" class="text-black">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>



        <?php

        


        //SQL for retriving result according to search result
        //This query will retrive value according to search matching title and description column
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' or ' %$search% '";


        //execute the query
        $res = mysqli_query($conn, $sql);


        //Check Whether food is availavable 
        $count = mysqli_num_rows($res);



        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $price = $rows['price'];
                $description = $rows['description'];
                $image_name = $rows['image_name'];


        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php

                        //Checking Image Availablity
                        if ($image_name == "") {
                            echo  "<div class = 'error'>Image Not Available...</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                        <?php
                        }

                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">৳ <?php echo $price; ?> BDT</p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>


            <?php

            }
        } else {

            ?>
            <tr>
                <td colspan="6">
                    <div class="error">Food Not Found!</div>
                </td>
            </tr>

        <?php

        }



        ?>




        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>
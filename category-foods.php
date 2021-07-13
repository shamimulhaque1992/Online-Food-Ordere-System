<?php include('partials-front/menu.php')?>


<?php
//Check Whether category id is given or not
if(isset($_GET['category_id']))
{
    $category_id=$_GET['category_id'];
    //SQL for Display the title based on id
    $sql="SELECT title FROM tbl_category WHERE id=$category_id";



    //Execute SQL
    $res= mysqli_query($conn, $sql);



    //Getting the value from database
    $row = mysqli_fetch_assoc($res);



    $category_title = $row['title'];
}
else
{
    header('location:'.SITEURL);
}






?>



    <!-- fOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2 class="text-black bg-gry">Foods on <a href="#" class="text-black">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD SEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
            //SQL query to show food for selected category
            $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";


            //Execute Query
            $res2=mysqli_query($conn, $sql2);


            //Count the rows
            $count2=mysqli_num_rows($res2);


            //Check Food availablity
            if($count2>0)
            {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id=$row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
    
    
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
                        <h4><?php echo $title?></h4>
                        <p class="food-price">৳ <?php echo $price; ?> BDT</p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
    
            <?php
                }
            }
            else
            {
                echo "<div class='error'>Food Is not Avaiable...</div>";
            }
            
            
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>
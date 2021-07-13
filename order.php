<?php include('partials-front/menu.php') ?>

<?php

if (isset($_GET['food_id'])) {
    //Get the id
    $food_id = $_GET['food_id'];


    //SQL get The details
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

    //Execute SQL
    $res = mysqli_query($conn, $sql);

    //Count rows
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //Get the data from db
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}


?>



<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-black bg-gry">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset class="bdr-blk">
                <legend>Selected Food</legend>

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
                    <h3><?php echo $title ?></h3>
                    <input type="hidden" name='food' value="<?php echo $title ?>">
                    <p class="food-price">৳ <?php echo $price; ?> BDT</p>
                    <input type="hidden" name='price' value="<?php echo $price ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset class="bdr-blk">
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Khandoker Shamimul Haque" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 01779312970" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. khandoker15-1992@diu.edu.bd" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        if (isset($_POST['submit'])) {

            //getting all data from form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            //SQL for save the data in db
            $sql2 = "INSERT INTO tbl_order SET
                    
                food = '$food',
                price = $price,
                qty =  $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'

                    
                    
            ";


            //Execute SQL
            $res2 = mysqli_query($conn, $sql2);


            if ($res2 == true) {
                //Get the data from db
                $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully</div>";
                header('location:' . SITEURL);
            } else {
                $_SESSION['order'] = "<div class='error text-center'>Failed to Place Order </div>";
                header('location:' . SITEURL);
            }
        }

        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php') ?>
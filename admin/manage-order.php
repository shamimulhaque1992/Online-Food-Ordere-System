<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        
        <br>
        <br>

        <?php


        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php
            
            //Getting All the data from DB
            $sql="SELECT * FROM tbl_order ORDER BY id DESC";// Display the letest order at first

            //Execute the query
            $res=mysqli_query($conn, $sql);

            //Count the rows
            $count = mysqli_num_rows($res);

            //creating serial number and its initial is 1
            $sn=1;


            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $food = $rows['food'];
                    $price = $rows['price'];
                    $qty = $rows['qty'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];




            ?>
                    <tr>
                        <td><?php echo $sn++; ?> .</td>
                        <td><?php echo $food ?></td>
                        <td><?php echo $price ?></td>
                        <td><?php echo $qty ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $order_date ?></td>

                        <td>
                            <?php 
                            if($status=='Ordered')
                            {
                                echo "<label>$status</label>";
                            }
                            elseif($status=='On Delivery')
                            {
                                echo "<label style='color: orange'>$status</label>";
                            }
                            elseif($status=='Delivered')
                            {
                                echo "<label style='color: green'>$status</label>";
                            }
                            elseif($status=='Cancelled')
                            {
                                echo "<label style='color:red'>$status</label>";
                            }
                            
                            ?>
                        </td>

                        <td><?php echo $customer_name ?></td>
                        <td><?php echo $customer_contact ?></td>
                        <td><?php echo $customer_email ?></td>
                        <td><?php echo $customer_address ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                            

                        </td>
                    </tr>


            <?php

                }
            } else {
                echo "<tr><td colspan='12' class='error'>Order not Available.</td></tr>";
            }
            
            
            
            
            ?>



            
        
        </table>
    </div>
</div>
<?php include("partials/footer.php"); ?>
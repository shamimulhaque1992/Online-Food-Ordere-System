<?php include("partials/menu.php");
?>


	<!-- Main Content Section Starts-->
	<div class="main-content">
		<div class="wrapper">
			<h1>Dashboard</h1>

			<?php
        
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        
        
        
        ?>

			<div class="col-4 text-center">

				<?php
				//SQL
				$sql="SELECT * FROM tbl_category";

				//Execute Query
				$res=mysqli_query($conn, $sql);

				//Count the rows
				$count=mysqli_num_rows($res);
				
				
				?>

				<h1><?php echo $count;?></h1>
				<br>
				Categories
			</div>
			<div class="col-4 text-center">

				
				<?php
				//SQL
				$sql2="SELECT * FROM tbl_food";

				//Execute Query
				$res2=mysqli_query($conn, $sql2);

				//Count the rows
				$count2=mysqli_num_rows($res2);
				
				
				?>



				<h1><?php echo $count2;?></h1>
				<br>
				Foods
			</div>
			
			
			
			
			<div class="col-4 text-center">


				<?php
				//SQL
				$sql3="SELECT * FROM tbl_order";

				//Execute Query
				$res3=mysqli_query($conn, $sql3);

				//Count the rows
				$count3=mysqli_num_rows($res3);
				
				
				?>




				<h1><?php echo $count3;?></h1>
				<br>
				Total Orders
			</div>
			
			
			
			<div class="col-4 text-center">


				<?php
				//SQL for revinue
				$sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
				
				//Execute Query
				$res4=mysqli_query($conn, $sql4);

				//Get The total Value
				$row4=mysqli_fetch_assoc($res4);


				//Get the totak Revinur
				$total_revenue=$row4['Total'];
				
				?>

				<h1>৳ <?php echo $total_revenue;?> BDT</h1>
				<br>
				Revenue Generated
			</div>
			<div class="clearfix"></div>
		</div>

	</div>
	<!-- Main Content Section Ends-->


<?php include("partials/footer.php")?>
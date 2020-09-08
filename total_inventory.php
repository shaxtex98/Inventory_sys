<?php
include_once("./database/constants.php");
include_once("./templates/header.php");

// if the session is not set then it will go the following page not dashboard.
if(!isset($_SESSION["userid"])){
	header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html>
<body>
	<!-- Navbar  -->
	<?php include_once("./templates/header.php"); ?>
	<br/><br/>
	<div class="container">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>No #</th>
					<th>Product</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Price<small><strong> (PKR) </strong></small></th>
					<th>Stock</th>
					<th>Reg. Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="get_product">
				
			</tbody>
		</table>
	</div>

	<?php 
		include_once("./templates/update_product.php");
	?>
	
</body>
</html>

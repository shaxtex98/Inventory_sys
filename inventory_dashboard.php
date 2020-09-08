<?php
include_once("./database/constants.php");
// if the session is not set then it will go the following page not dashboard.
if(!isset($_SESSION["userid"])){
	header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html>
<!-- head files are moved to header.php -->
<body>
	<!-- Navbar  -->
	<?php include_once("./templates/header.php"); ?>
	<br/><br/>
	<!-- Login Area -->
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card mx-auto">
					<img src="./images/user.png" style="width: 60%"class="card-img-top mx-auto" alt="User Pic">
					<div class="card-body">
						<h5 class="card-title"><b>Profile:</b></h5>
						<i class="fa fa-user">&nbsp;</i><input class="card-text" type="text" name="username" value="<?php echo $row["username"]; ?>"readonly/>
						<p class="card-text"><i class="fa fa-user">&nbsp;</i>Admin</p>
						<p class="card-text">Last login: XXXX-XX-XX</p>
						<a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron" style="width: 100%;height: 100%;">
					<h1>Welcome Admin,</h1>
					<div class="row">	
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Purchases</h5>
									<p class="card-text">Here You can make invoices and create new orders</p>
									<a href="new_order.php" class="btn btn-primary">Make and Print Invoices</a>
								</div>
							</div>
						</div>	
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Total Inventory</h5>
									<p class="card-text">Here You can make invoices and create new orders</p>
									<a href="total_inventory.php" class="btn btn-primary">See Table</a>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<p></p>
	<p></p>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Categories</h5>
						<p class="card-text">Here You can manage your categories and can add new parent and sub-categories.</p>
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#form_category">Add</a>
						<a href="manage_categories.php" class="btn btn-primary">Manage</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Brands</h5>
						<p class="card-text">Here You can manage your Brands and you can add New Brands.</p>
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#form_brand">Add</a>
						<a href="manage_brand.php" class="btn btn-primary">Manage</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Products</h5>
						<p class="card-text">Here You can manage your products and you can add new Products.</p>
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#form_product">Add</a>
						<a href="manage_product.php" class="btn btn-primary">Manage</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
	//category form
	include_once("./templates/category.php");
	//brands form
	include_once("./templates/brand.php");
	//products form
	include_once("./templates/products.php");
	?>
	
</body>
</html>

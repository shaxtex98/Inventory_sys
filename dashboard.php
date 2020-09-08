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
					<img src="./images/user.png" style="width: 60%; height: 100%"class="card-img-top mx-auto" alt="User Pic">
					<div class="card-body">
						<h5 class="card-title"><b>Profile:</b></h5>
						<p class="card-text" class="usernamedash"><i class="fa fa-user">&nbsp;</i>Ahmad Shah</p>
						<p class="card-text"><i class="fa fa-user">&nbsp;</i>Admin</p>
						<p class="card-text">Last login: XXXX-XX-XX</p>
						<a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron" style="width: 100%;height: 100%;">
					<h1 style="text-align: center">Welcome Admin,</h1>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Made Purchases?</h5>
									<p class="card-text">Here You can make invoices and create new orders</p>
									<a href="new_order.php" class="btn btn-primary">Make and Print Invoices</a>
								</div>
							</div>
						</div>	
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Inventory System</h5>
									<p class="card-text">Here You can make invoices and create new orders</p>
									<a href="inventory_dashboard.php" class="btn btn-primary">Dashboard</a>
									<a href="total_inventory.php" class="btn btn-primary">See Table</a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Expense System</h5>
									<p class="card-text">Here You can make invoices and create new orders</p>
									<a href="expenses_dashboard.php" class="btn btn-primary">Dashboard</a>
									<a href="manage_expenses.php" class="btn btn-primary">See Enteries</a>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	

</body>
</html>

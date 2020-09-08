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
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inventory Management System</title>
	<script src="./js/jquery/jquery.min.js"></script>
	<script src="./js/umd/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="./css/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="./css/fontawesome/css/all.css">
	<script type="text/javascript" src="./js/manage.js"></script>
	<script type="text/javascript" src="./js/datatables.min.js"></script>
	<script type="text/javascript" src="bootstrap4-datatables.min.js"></script>
</head>
<body>
	<!-- Navbar  -->
	<?php include_once("./templates/header.php"); ?>
	<br/><br/>
	<div class="container">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>No #</th>
					<th>Expense Type</th>
					<th>Expense Description</th>
					<th>Expense Quantity</th>
					<th>Expense Registration Date</th>
					<th>Expense Receipt No.</th>
					<th>Expense Amount<small><strong> (PKR) </strong></small></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="get_expense">
				
			</tbody>
		</table>
	</div>

	<?php 
		include_once("./templates/update_expenses.php");
	?>
	
</body>
</html>

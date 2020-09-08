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
					<th>Registerar Name</th>
					<th>Expense Type</th>
					<th>Expense Description</th>
					<th>Expense Quantity</th>
					<th>Expense Registration Date</th>
					<th>Expense Receipt No.</th>
					<th>Expense Amount<small><strong> (PKR) </strong></small></th>
					<th colspan="2">Actions</th>
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

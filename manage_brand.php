<?php
include_once("./database/constants.php");
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
					<th>Brands</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="get_brand">
				
			</tbody>
		</table>
	</div>

	<?php 
		include_once("./templates/update_brand.php");
	?>
	
</body>
</html>

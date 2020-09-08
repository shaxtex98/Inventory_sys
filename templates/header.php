<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inventory Management System</title>
	<script src="./js/jquery/jquery.min.js"></script>
	<script src="./js/umd/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="./css/fontawesome/css/all.css">
	<script type="text/javascript" src="./js/main.js"></script>
	<script type="text/javascript" src="./js/manage.js"></script>
	<script type="text/javascript" src="./js/order.js"></script>
</head>




<nav class="navbar navbar-expand-sm navbar-dark bg-primary" >
	<a class="navbar-brand" href="index.php"><img src="./images/Wlogo.png" height="40px" width="130px"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="index.php"><i class="fa fa-home">&nbsp;</i> Home <span class="sr-only">(current)</span></a>
			</li>
			<div class="dropdown">
				<a class="btn btn-primary dropdown-toggle active" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Systems
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="expenses_dashboard.php"><i class="fa fa-list">&nbsp;</i>Expense System</a>
					<a class="dropdown-item" href="inventory_dashboard.php"><i class="fa fa-table">&nbsp;</i>Inventory System</a>
				</div>
			</div>
			<?php 
			if (isset($_SESSION["userid"])) {
				?>
				<li class="nav-item">
					<a class="nav-link active" href="logout.php"><i class="fa fa-user">&nbsp;</i>Logout</a>
				</li>
				<?php
			}
			?>

		</ul>
	</div>
</nav>
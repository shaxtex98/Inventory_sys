<?php 

include_once("./database/constants.php");
include_once("./templates/header.php");


if (isset($_SESSION["userid"])) {
	header("location:".DOMAIN."/dashboard.php");
}

?>

<!DOCTYPE html>
<html>
<body>
	<div class="overlay"><div class="loader"></div></div>
	<!-- Navbar  -->
	<?php include_once("./templates/header.php"); ?>
	<br/><br/>
	<!-- Login Area -->
	<div class="container">
		<?php 
			if (isset($_GET["msg"]) && !empty($_GET["msg"])) {
				?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?php echo $_GET["msg"]; ?>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				<?php 
			}
		?>
		<div class="card mx-auto" style="width: 18rem;">
			<img src="./images/login.png" style="width: 60%" class="card-img-top mx-auto" alt="Login icon">
			<div class="card-body">
				<form id="form_login" onsubmit="return false">
					<div class="form-group">
						<label for="log_email">Email address</label>
						<input type="email" class="form-control" name="log_email" id="log_email" placeholder="Enter email">
						<small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
					<div class="form-group">
						<label for="log_pass">Password</label>
						<input type="password" name="log_pass" class="form-control" id="log_pass" placeholder="Enter Password">
						<small id="p_error" class="form-text text-muted"></small>
					</div>
					<button type="submit" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
					<span><a href="register.php">Register</a></span>
				</form>
			</div>
			<div class="card-footer"><a href="#">Forget Password?</a></div>
		</div>
	</div>
	
</body>
</html>

<script type="text/javascript">
	function AlphOnly(input){
		var regex = /[^a-z0-9 ]/gi;
		input.value = input.value.replace(regex,"");
	}

</script>
<?php
include_once("./database/constants.php");
include_once("./templates/header.php");

?>
<!----------------------------------Registration FORM ----------------------------->
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
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<?php echo $_GET["msg"]; ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php 
		}
		?>
		<div class="card mx-auto" style="width: 30rem;">
			<div class="card-header">Register</div>
			<div class="card-body">
				<form id="register_form" onsubmit="return false" autocomplete="off">
					<div class="form-group">
						<label for="username">Full Name</label>
						<input type="text" name="username" onkeyup="AlphOnly(this)"class="form-control" id="username" placeholder="Enter Your Name">
						<small id="u_error" class="form-text text-muted"></small>
					</div>
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
						<small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
					<div class="form-group">
						<label for="Password1">Password</label>
						<input type="password" name="password1" class="form-control" id="password1" placeholder="Password">
						<small id="p1_error" class="form-text text-muted"></small>
					</div>
					<div class="form-group">
						<label for="Password2">Re-Enter Password</label>
						<input type="password" name="password2" class="form-control" id="password2" placeholder="Password">
						<small id="p2_error" class="form-text text-muted"></small>
					</div>
					<div class="form-group">
						<label for="usertype">Usertype</label>
						<select name="usertype" class="form-control" id="usertype">
							<option></option>
							<option value="Admin">Admin</option>
							<option value="Other">Other</option>
						</select>
						<small id="t_error" class="form-text text-muted"></small>
					</div>
					<button type="submit" name="user_register" class="btn btn-primary"><i class="fa fa-user">&nbsp;</i>Register</button>
					<span><a href="index.php">Login</a></span>
				</form>
			</div>
			<div class="card-footer text-muted"></div>
		</div>
	</div>
	
</body>
</html>

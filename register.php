<?php 
require ('config/connection.php');
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>
	<html>
	<head>
		<title>Welcome to Swirlfeed!</title>
		<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="assets/js/register.js"></script>
	</head> 
	<body>
		<?php  

				if(isset($_POST['register'])) {
					echo '
					<script>
					$(document).ready(function() {
						$("#first").hide();
						$("#second").show();
					});

					</script>';
				}
		?>
      
                	<div class="wrapper">

						<div class="login_box">

							<div class="login_header">
								<h1>WeChat.!</h1>
								Login or sign up below!
							</div>
							<br>
					 <div id="first">
						<form action="register.php" method="POST">
							<input type="email" name="log_email"  placeholder="Enter Email" value="<?php 
							if(isset($_SESSION['log_email'])) {
								echo $_SESSION['log_email'];
							} 
							?>" required>
							<br>
							<input type="password" name="password" placeholder="password">
							<br>
							<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>
							<input type="submit" name="login" value="Login">
							<br>
						<a href="#" id="signup" class="signup">Need and account? Register here!</a>

						</form>
					</div>

                    <div id="second">
                    <form action="register.php" method="POST">
                            <label>FirstName  </label>
                            <input type="text" name="first_name"  value ="<?php
								if(isset($_SESSION['first_name'])){
								echo $_SESSION['first_name'];}?>" required>
								<br>
						<?php if (in_array("Your FirstName must be between 2 & 25 characters<br>", $error_array)) echo"Your FirstName must be between 2 & 25 characters<br>";?>
                
                            <label>LastName</label>
                            <input type="text" name="last_name"  value="<?php
								if(isset($_SESSION['last_name'])){
								echo $_SESSION['last_name'];}?>" required>
							<br>
						<?php if (in_array("Your LastName must be between 2 & 25 characters<br>", $error_array)) echo  "Your LastName must be between 2 & 25 characters<br>";?>
                            <label>Email</label>
                            <input type="email" name="email"  value="<?php
								if(isset($_SESSION['email'])){
								echo $_SESSION['email'];}?>" required>
								<br>
						<?php if (in_array("Your FirstName must be between 2 & 25 characters<br>", $error_array)) echo  "Your FirstName must be between 2 & 25 characters<br>";?>
                            <label>Confirm_Email</label>
                            <input type="email" name="check_email"  value="<?php
								if(isset($_SESSION['check_email'])){
								echo $_SESSION['check_email'];}?>" required>
								<br>
						<?php if (in_array("Email is already in use<br>", $error_array)) echo "Email is already in use<br>";
							else if (in_array("Invalid format<br>", $error_array)) echo "Invalid format<br>";
						 	else if (in_array("Emails don't match<br>", $error_array)) echo "Email don't match<br>";?>

                            <label>Password</label>
                            <input type="password" name="password"  required>
        
                            <label>Re_Password</label>
                            <input type="password" name="re_password"  required>
                        
                        <br>
                        <?php if (in_array("Your Password don't Match<br>", $error_array)) echo "Your Password don't Match<br>";
						else if (in_array("Your password Can only contain English characters or Numbers<br>", $error_array))echo "Your password Can only contain English characters or Numbers<br>";
						else if (in_array("Your Password Must be between 5 & 30 characters<br>", $error_array)) echo "Your Password Must be between 5 & 30 characters<br>";?>
                        
                        	<input type="submit" name="register"  value = "Register" class="btn btn-Success">
                        	<br>
                        	<?php if (in_array("<span style='color: #14c800;'>You 're all set! Goahed &login!</span><br>", $error_array)) echo "<span style='color: #14c800;'>You 're all set! Go ahead &login!</span><br>";?>
                            <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
		                </form>
		            </div>
		        </div>
		    </div>
		</body>
		</html>


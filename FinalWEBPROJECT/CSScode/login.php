<?php
	session_start();
	include('include/header.php');
	include('include/connection.php');
	include('functions/functions.php');
	login();
?>


	<!-- main start -->
	<section class="main">
		<div class="container">
			<div class="login-area">
				<h2>Login Form</h2>
				<form method="post">
					<label for="username">Email:</label>
					<input type="email" name="username" class="form-input input-text" id="username" required>
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-input input-pass" id="password" required>
					<input type="checkbox" name="remember" class="rem" value="1"> Remember me.
					<input type="submit" name="login" class="form-input input-submit" value="Login">
				</form>
			</div>
		</div>	
	</section>
	<!-- main end -->

<?php
	include('include/footer.php');
?>

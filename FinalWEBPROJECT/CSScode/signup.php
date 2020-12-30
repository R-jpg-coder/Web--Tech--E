<?php
	include('include/connection.php');
	include('include/header.php');
	include('functions/functions.php');
	register();
?>


	<!-- main start -->
	<section class="main">
		<div class="container">
			<div class="login-area">
				<h2>Signup Form</h2>
				<form method="post">
					<label for="name">Name:</label>
					<input type="text" name="name" class="form-input input-text" id="name" required>
					<label for="email">Email:</label>
					<input type="email" name="email" class="form-input input-text" id="email" required>
					<label for="phone">Phone:</label>
					<input type="text" name="phone" class="form-input input-text" id="phone" required>
					<label for="password">Password:</label>
					<input type="password" name="pass" class="form-input input-pass" id="password" required>
					<input type="submit" name="submit" class="form-input input-submit" value="Sign up">
				</form>
			</div>
		</div>	
	</section>
	<!-- main end -->

<?php
	include('include/footer.php');
?>
	
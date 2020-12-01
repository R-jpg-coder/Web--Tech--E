<?php


	function register(){
		
		GLOBAL $conn;
		if(isset($_POST['submit'])){
			$name=$_POST['name'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$pass=md5($_POST['pass']);
			
			$sql_register="INSERT INTO `user`(`name`, `email`, `phone`, `password`) VALUES ('$name','$email','$phone','$pass')";
			
			$run_sql_register= mysqli_query($conn,$sql_register);
			
			if($run_sql_register){
				echo"<script>alert('Register Successfully');</script>";
				echo"<script>window.open('login.php','_self');</script>";
			}
		}
		
		
	}
	
	
	
	
function login(){
		
		GLOBAL $conn;
		if(isset($_POST['login'])){
		
		$username = $_POST['username'];
		$pass = md5($_POST['password']);
		
		$query="select * from user where email='$username' AND password='$pass'";
		
		$run_query= mysqli_query($conn,$query);
		
		$count = mysqli_num_rows($run_query);
		
		if($count<1){
			echo"<script>alert('Username & Password is invalid');</script>";
		}else{
			echo"<script>window.open('user/main.php','_self');</script>";
		}
	}
	}
?>
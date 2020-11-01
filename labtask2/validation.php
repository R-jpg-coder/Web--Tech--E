<html>
	<head>
		<title>Form Validation</title>
	</head>
	<body>
	<?php
		$nameerr = $emailerr = $doberr = $gendererr = $degerr = $bldgrperr ="";
		$name = $email = $dob = $gender = $degree = $bldgrp = "";
		
				if(isset($_POST['submit'])){
					
					
						// name validation
						
						if(empty($_POST['name'])){
							$nameerr ="<span style='color:red;'>Name is required.</span>";
						}
						else {  
						$name = test_input($_POST["name"]);  
						// check if name only contains letters and whitespace  
							if (!preg_match("/^[a-zA-Z]*$/",$name)) {  
								$nameerr ="<span style='color:red;'>Only alphabets and white space are allowed</span>";								
								}  
							} 


						//email validation
					
						 if (empty($_POST["email"])) {  
								$emailerr = "<span style='color:red;'>Email is required.</span>"; 
						} else {  
								$email = test_input($_POST["email"]);  
								// check that the e-mail address is well-formed  
								if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
									$emailerr = "<span style='color:red;'>Invalid email format</span>"; 									
								}  
						 }  
						 
						 // date of birth validation
				
						 if (empty($_POST["dob"])) {  
								$doberr = "<span style='color:red;'>Date is required.</span>"; 
						}
						
						// gender validate
						
						
						 if (empty($_POST["Gender"])) {  
								$gendererr = "<span style='color:red;'>Gender selection is required.</span>"; 
						}
						
						
						// Degree validate
						
						
						 if (empty($_POST["degree"])) {  
								$degerr = "<span style='color:red;'>Degree selection is required.</span>"; 
						}
						
						
						// BloddGroup validate
						
						
						 if (empty($_POST["bldgrp"])) {  
								$bldgrperr = "<span style='color:red;'>Bloodgroup selection is required.</span>"; 
						}
				
				
				
				
				
				
				
				}
			function test_input($data) {
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}
			?>
	
	
		<form method="post">
			Name: <input type="text" name="name"> <?php echo $nameerr;?><br><br>
			Email: <input type="text" name="email"> <?php echo $emailerr; ?><br><br>
			Date of Birth: <input type="date" name="dob"> <?php echo $doberr; ?><br><br>
			Gender: <input type="radio" name="Gender" value="Male">Male
					<input type="radio" name="Gender" value="Female">Female
					<input type="radio" name="Gender" value="other">Other
			 <?php echo $gendererr; ?>
			<br><br>
			Degree: <input type="checkbox" name="degree" value="SSC"> SSC 
					<input type="checkbox" name="degree" value="HSC"> HSC
					<input type="checkbox" name="degree" value="BSC"> BSC
					<input type="checkbox" name="degree" value="MSC"> MSC
					<?php echo $degerr; ?>
			<br><br>
			Blood Group:<select name="bldgrp">
							<option></option>
							<option value="A+">A+</option>
							<option value="B+">B+</option>
							<option value="AB+">AB+</option>
							<option value="A-">A-</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
						</select> <?php echo $bldgrperr; ?><br><br>
						
				<input type="submit" name="submit" value="submit">
		
		</form>
	</body>
</html>
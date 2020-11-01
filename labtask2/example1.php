<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $date of birth = test_input($_POST["DATE OF BIRTH"]);
  $gender = test_input($_POST["GENDER"]);
  $degree = test_input($_POST["DEGREE"]);
  $blood group = test_input($_POST["BLOOD GROUP"]);
}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <br><br>
  E-mail: <input type="text" name="email">
  <br><br>
  DATE OF BIRTH: <input type="text" name="date of birth">
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <br><br>
  <input type="submit" name="submit" value="Submit"> 
  <b>DEGREE:</b><input type="checkbox"name="c1"value="SSC">SSC
				<input type="checkbox"name="c3"value="HSC">HSC
				<input type="checkbox"name="c4"value="BSC">BSc
				<input type="checkbox"name="c5"value="MSC">MSC
				<input type="submit" name="submit" value="Submit">
	<b>BLOOD GROUP:</b><input type="text"name="textbox14"><br></br>
		<b>BLOOD GROUP:</b>
		<Select name="blood group">
		<option>A</option>
		<option>B</option>
		<option>O</option>
		</select><br></br>			
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $Date of birth;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>
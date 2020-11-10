<?php
session_start();
if(isset($_SESSION['ui'])) {
$db = mysqli_connect("localhost", "X_Company", "#WTpro2020", "employee");
   if(isset($_POST['submit_button']))
     {
                
       if($_POST['password'] == $_POST['password2'])
         {

            $fname = $_POST['firstName'];
            $lname = $_POST['lastName'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $gender = $_POST['gender'];
            $contact = $_POST['Phone'];
            $address = $_POST['address'];
            $bg = $_POST['BG'];
            $JD = $_POST['JoinDate'];
            $UI =$_SESSION['ui'];
            $sql = "INSERT INTO hr_details(First_name, Last_name, Email, Password, Gender, Contact_no, Address, Blood_group, Join_date, UID) VALUE('$fname', '$lname', '$email', '$password', '$gender', '$contact', '$address', '$bg', '$JD','$UI')";
            mysqli_query($db, $sql);
            
            header("location: success.php");
            
         }
          else
         {
         echo '<h1>';
         echo "Password do not match please try again.";
          echo '</h1>';
         }
     }
}else{
    echo "No acess";
    header("location: auth_hr.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign UP</title>
</head>
<body style="background-color:lightgray;">

<h1>Welcome</h1>
        <form method="post" action="signup.php">
              <label>First Name</label><br>
              <input type="text" name="firstName" required><br><br>
              <label>Last Name</label><br>
              <input type="text" name="lastName" required><br><br>   
              <label>Email</label><br>
              <input type="email" name="email" required><br><br>  
              <label>Password</label><br>
              <input type="password" name="password" required><br><br>
              <label>Re-Type Password</label><br>
              <input type="password" name="password2" required><br><br>
              <label>Gender </label>
              <input type="radio" name="gender" value="Male">Male
              <input type="radio" name="gender" value="Female">Female<br><br>
              <label>Contact No</label><br>
              <input type="tel" name="Phone" value="+880"><br><br>
              <label>Address</label><br>
              <textarea name="address" rows="4" cols="50" placeholder="Address."></textarea><br><br>
              <label>Join Date</label>
              <input type="text" name="JoinDate" placeholder="2012-12-12" required><br><br>  
              <input type="submit" name="submit_button" value="Sign Up">
              </form>
</body>
</html>
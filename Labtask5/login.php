<?php
 $db = mysqli_connect("localhost", "X_Company", "#WTpro2020", "employee");
if(isset($_POST['signup']))
  {
      header("location: auth_hr.php");
  }
elseif(isset($_POST['submit']))
{
    session_start();
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql="SELECT * FROM hr_details WHERE email='$email' AND password='$password'";
        $verify = mysqli_query($db, $sql);
    
        if(mysqli_num_rows($verify)== 1)
        {
            $_SESSION['email']=$email;
            header("location: show.php");
        }else {
            echo "incorrect email/password combination";
        }
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form method="post" action="login.php">
         <label>
          Write down your email.
         </label><br>
         <input type = "text" name = "email"><br><br>
         <label>
         Password: 
         </label>
         <input type = "password" name = "password">
         <input type ="submit" name = "submit" value ="Login">
         <input type = "submit" name = "signup" value ="signup">
        </form>
    </body>
</html>
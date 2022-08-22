<?php
include'config.php';
error_reporting(0);
if(isset($_POST['submit']))
{
	if(isset($_GET['token'])){

		$token=$_GET['token'];

	$newpassword=mysqli_real_escape_string($conn, $_POST["Npass"]);
	$cpassword=mysqli_real_escape_string($conn,$_POST["Cpass"]);

	

	$pass=password_hash($newpassword,PASSWORD_BCRYPT);
	$cpass=password_hash($cpassword,PASSWORD_BCRYPT);

	if($newpassword===$cpassword){

		
		$updatequery="UPDATE regi set password='$pass' where token='$token' ";

		$iquery=mysqli_query($conn,$updatequery);
		
		if($iquery){
			echo"<script>alert('Your password has been updated.');</script>";
			header('location:Login.php');

		}else{
			echo"<script>alert('Your password is not updated.');</script>";
			//header('location:Reset.php');
		}
	}else{
		echo"<script>alert('Password are not matching.');</script>";
	}
}else{
	echo"<script>alert('No token found.');</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" type="text/css" href="Reset.css">
	

	<title>Password Reset</title>
</head>
<body>
<div class="main">

    <div class="container">


      <div class="row">
        <div class="col-12">
        <form action="" method="POST" class="login-email">

            <h1>Password Validation
              <hr>
            </h1>

           
            <div class="form-group">
              <i class="fas fa-eye-slash"id="PASS"></i>
              <input type="password" class="form-control" id="psw" name="Npass"placeholder="Enter Your New Password"
                required> 
               </div>
			        <div class="form-group">
              <i class="fas fa-eye-slash"id="CPASS"></i>
              <input type="password" class="form-control" id="c_psw" name="Cpass"placeholder="Confirm Password" required>

            </div>

            <button name="submit"value="submit" class="btn btn-submit">Update Password</button>
           
          </form>
          <div id="validation_box">
            <h4>Password Must Contain The Following</h4>
            <p id="letter" class="invalid">Lowercase Letters</p>
            <p id="capital" class="invalid">Uppercase Letters</p>
            <p id="number" class="invalid">A Number</p>
            <p id="length" class="invalid">Atleast 8 Characters</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="Reset.js"></script>

</body>

</html>
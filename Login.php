<?php
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="Style.css" />
	<link rel="stylesheet" href="pass.css" />
	<title> Sign In and sing up Form</title>
</head>

<body>
	<?php

	require('config.php');
	if (isset($_POST['Signup'])) {
		$msg = '';
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$password = mysqli_real_escape_string($conn, $_POST['psw']);
		$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);


		$pass = password_hash($password, PASSWORD_BCRYPT);
		$cpass = password_hash($cpassword, PASSWORD_BCRYPT);

		$token = bin2hex(random_bytes(15));

		$emailquery = "SELECT * FROM regi where email='$email'";
		$query = mysqli_query($conn, $emailquery);

		$emailcount = mysqli_num_rows($query);

		if ($emailcount > 0) {
			$msg = "Email Already exist";
			//echo "<script>alert('Email alreday exist in our Database.');</script>";
		} else {
			if ($password === $cpassword) {


				$added_on = date('Y-m-d h:i:s');
				$insertquery = "INSERT into regi(username, email, phone, password, cpassword,token,added_on)values('$username','$email','$phone','$pass','$cpass','$token','$added_on')";
				$iquery = mysqli_query($conn, $insertquery);

				if ($iquery) {
	?>
					<script>
						$msg = "Insertion Sucessfully";
						//alert("Insertion Sucessfully");
					</script>
				<?php
				} else {
				?>
					<script>
						$msg = "Not Inserted";
						//alert("Not Inserted");
					</script>
				<?php
				}
			} else {
				$msg = "";
				$msg = "Password ARE Not matching";
				//alert("Password ARE Not matching");
				?>



	<?php
			}
		}
	}

	?>

	<?php

	include 'config.php';

	if (isset($_POST['loginbtn'])) {

		$email = $_POST['emailid'];
		$password = $_POST['lpassword'];

		$email_search = "SELECT * FROM regi where email='$email'";
		$query = mysqli_query($conn, $email_search);

		$res = mysqli_query($conn, "select * from regi where email='$email'");
		$check_user = mysqli_num_rows($res);
		if ($check_user > 0) {
			$row = mysqli_fetch_assoc($res);
			$_SESSION['USER_LOGIN'] = 'yes';
			$_SESSION['USER_ID'] = $row['id'];
			$_SESSION['USER_NAME'] = $row['username'];
		}
		// if (isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID'] != '') {
		//wishlist_add($conn, $_SESSION['USER_ID'], $_SESSION['WISHLIST_ID']);
		//unset($_SESSION['WISHLIST_ID']);
		//}
		$email_count = mysqli_num_rows($query);

		if ($email_count) {
			$email_pass = mysqli_fetch_assoc($query);

			$db_pass = $email_pass['password'];

			$pass_decode = password_verify($password, $db_pass);
			if ($pass_decode) {

				$msg = 'Login SucessFull';
				//echo "<script>alert('Login sucessfull.');</script>";
	?>
				<script>
					location.replace("../Admin/index.php");
				</script>
	<?php
			} else {
				$msg = 'Password is incorrect';
				//echo "<script>alert('Password is incorrect.');</script>";
			}
		} else {
			$msg = 'Invalid Email';
			//echo "<script>alert('Invalid Email.');</script>";
		}
	}
	?>

	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="sign-in-form" method="post">
					<h2 class="title">Sign in</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="email" placeholder="Email" name="emailid" value="<?php echo $_POST["emailid"]; ?>" required />
					</div>
					<div class="input-field">
						<i class="fas fa-eye-slash" aria-hidden="true" id="lpass"></i>
						<input type="password" placeholder="Password" id="lpassword" name="lpassword" value="<?php echo $_POST["lpassword"]; ?>" required />
					</div>
					<input type="submit" value="Login" class="btn solid" name="loginbtn" method="post" />
					<div class="forget">
						<a href="Forget.php"><b>Forget Password?</b></a>
					</div>
					<div style="color:red;font-weight:500;display: block;text-align: center; margin-block-start: 1em;margin-block-end: 1em;margin-inline-start: 0px;margin-inline-end: 0px;">
						<P><?php echo $msg ?></P>
						<?php $msg = ''; ?>
					</div>
				</form>

				<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="sign-up-form" method="post">
					<h2 class="title">Sign up</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Username" name="username" value="<?php echo $_POST["username"]; ?>" required />
					</div>
					<div class="input-field">
						<i class="fas fa-envelope"></i>
						<input type="email" placeholder="Email" name="email" value="<?php echo $_POST["email"]; ?>" required />
					</div>
					<div class="input-field">
						<i class="fas fa-phone"></i>
						<input type="number" placeholder="Phone Number" name="phone" value="<?php echo $_POST["phone"]; ?>" required />
					</div>
					<div class="input-field">
						<span toggle="#psw" id="icon" class="fas fa-eye-slash field-icon toggle-password fa-4x"></span>
						<input type="password" id="psw" name="psw" placeholder="Enter Your password" value="<?php echo $_POST["psw"]; ?>" required>

					</div>
					<div class="input-field">
						<i class="fas fa-eye-slash" aria-hidden="true" id="eye"></i>
						<input type="password" placeholder="Confirm Password" id="cpassword" name="cpassword" value="<?php echo $_POST["cpassword"]; ?>" required />
					</div>
					<input type="submit" value="Sign up" class="btn solid" name="Signup" />

					<div id="validation_box">

						<h4>Password Must Contain The Following</h4>

						<p id="letter" class="invalid">Lowercase Letters</p>
						<p id="capital" class="invalid">Uppercase Letters</p>
						<p id="number" class="invalid">A Number</p>
						<p id="length" class="invalid">Atleast 8 Characters</p>

					</div>
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>New here ?</h3>
					<p>
						SIGN UP TO CREATE NEW ACCOUNT
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Sign up
					</button>
				</div>
				<img src="img/c-removebg-preview.png" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>One of us ?</h3>
					<p>
						ALREADY REGISTERD USER? CLICK HERE TO LOGIN
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Sign in
					</button>
				</div>
				<img src="img/register.svg" class="image" alt="" />
			</div>
		</div>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
	<script src="app.js"></script>
	<script src="pass.js"></script>
</body>

</html>
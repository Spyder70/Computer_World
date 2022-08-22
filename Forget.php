<?php
require('config.php');
require('function.inc.php');
$msg = "";
if (isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	userforget($conn);
	$emailquery = "SELECT * FROM regi where email='$email'";
	$query = mysqli_query($conn, $emailquery);
	$emailcount = mysqli_num_rows($query);
	if ($emailcount) {
		$userdata = mysqli_fetch_array($query);
		$username = $userdata['username'];
		$token = $userdata['token'];
		$subject = "Password Reset";
		$body = "";
		$html = 'Hi,' . $username . ', We heard You just forgotten your passowrd.No worries we are here to help you out. Click here to Reset your password http://localhost/Computer_world/Reset.php?token=' . $token . '';
		$sender_email = "From: sauravpoojari65@gmail.com";
		include('smtp/PHPMailerAutoload.php');
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->SMTPSecure = "tls";
		$mail->SMTPAuth = true;
		$mail->Username = "sauravproject855@gmail.com";
		$mail->Password = "Saurav18052";
		$mail->SetFrom("sauravproject855@gmail.com");
		$mail->addAddress($email);
		$mail->IsHTML(true);
		$mail->Subject = "Password Reset";
		$mail->Body = $html;
		$mail->SMTPOptions = array('ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => false
		));
		if ($mail->send()) {
			$msg = "Please Check your mail to activate your account.Check Spam Folder also";
			//echo "<script>alert('Please Check your mail to activate your account.Check Spam Folder also. ');</script>";
		} else {
			//echo "<script>alert('Email Sending Failed.');</script>";
			$msg = "Email Sending Failed";
		}
	} else {
		//echo "<script>alert('No Email Found.');</script>";
		$msg = "No Email Found";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Forget.css">
	<title>Password Reset</title>
</head>

<body>
	<div class="Fcontainer">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Password Reset</p>
			<div class="input-group">
				<input type="email" placeholder="Please Enter Your Email" name="email" value="" required>
			</div>

			<div class="input-group">
				<button name="submit" class="btn" name="submit">Submit</button>
			</div>
			<div style="color:red;font-weight:500;display: block;text-align: center; margin-block-start: 1em;margin-block-end: 1em;margin-inline-start: 0px;margin-inline-end: 0px;">
				<p><?php echo $msg ?></p>
			</div>
		</form>
	</div>
</body>

</html>
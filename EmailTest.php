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
$mail->addAddress($user_order['email']);
$mail->IsHTML(true);
$mail->Subject = "Invoice Details";
$mail->Body = $html;
$mail->SMTPOptions = array('ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => false
));
if ($mail->send()) {
//echo "Please check your email id for password";
} else {
//echo "Error occur";
}
}
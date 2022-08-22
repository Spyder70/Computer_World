<?php
function pr($arr)
{
    /*To return array length*/
    echo '<pre>';
    print_r($arr);
}
function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}
function get_safe_value($conn, $str)
{
    if ($str != '') {
        $str = trim($str);
        return strip_tags(mysqli_real_escape_string($conn, $str));
    }
}
function userforget($conn)
{
    $emailquery = "SELECT * FROM regi where email='$='";
    $query = mysqli_query($conn, $emailquery);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount) {

        $userdata = mysqli_fetch_array($query);
        $username = $userdata['username'];
        $token = $userdata['token'];
        $subject = "Password Reset";
        $body = "Hi,$username , We heard You just forgotten your passowrd.No worries we are here to help you out. Click here to Reset your password http://localhost/Computer_world/Reset.php?token=$token";
        $sender_email = "From: sauravpoojari65@gmail.com";
    }
}

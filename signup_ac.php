<?php
session_start();
include_once("database/db_conection.php");
//here getting result from the post array after submitting the form.
$user_name = mysqli_real_escape_string($db_conn, $_POST['name']);
$user_pass = md5(mysqli_real_escape_string($db_conn, $_POST['pass']));
$user_email = mysqli_real_escape_string($db_conn, $_POST['email']);

//here query check weather if user already registered so can't register again.
$check_email_query = "select * from temp_users WHERE user_email='$user_email'";
$result = mysqli_query($db_conn, $check_email_query);

$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);

$confirm_code = md5(unixtojd(rand()));

if ($count <= 0){
	mysqli_query($db_conn,"insert into temp_users (confirm_code,user_name,user_pass,user_email) VALUE ('$confirm_code','$user_name','$user_pass','$user_email')")or die(mysqli_error($db_conn));
	$_SESSION['user']=$user_name;
	$_SESSION['user_email']=$user_email;
	include_once("sendmail.php");
}else{
	echo 'false';
}

?>
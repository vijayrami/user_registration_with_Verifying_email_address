<?php
session_start();
include_once("database/db_conection.php");
if(!$_SESSION['user'] && !$_SESSION['user_email'])  
{   
    header("Location: index.php");//redirect to login page to secure the welcome page without login access
} else {
	$user_email = $_SESSION['user_email'];
	$check_registered_user_query = "select * from users WHERE user_email='$user_email'";
	$result = mysqli_query($db_conn, $check_registered_user_query);

	$row = mysqli_fetch_array($result);
	$count = mysqli_num_rows($result);
} 
include_once("header.php");
?>
<body>
<?php if ($count > 0): ?>
	<h1>Welcome</h1><br>  
	<h2><?php  echo $_SESSION['user'];	?></h2> 
<?php else: ?> 
	<h1>You did not activate your account.</h1><br>
	<p>Please check your inbox at <?php echo $_SESSION['user_email']; ?> to activate your account.</p>  
<?php endif; ?>
 
<h2><a href="logout.php?logout">Logout here</a> </h2>  
  
</body>
</html>
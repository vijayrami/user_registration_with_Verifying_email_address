<?php
session_start();
include_once("database/db_conection.php");
if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
// define variables and set to empty values
$nameErr = $emailErr = $passErr = "";
$user_name = $user_pass = $user_email = "";  
if(isset($_POST['login'])){	
    $user_pass=md5(mysqli_real_escape_string($db_conn,$_POST['pass']));//same  
    $user_email=mysqli_real_escape_string($db_conn,$_POST['email']);//same
    $query="SELECT * FROM users WHERE user_email='$user_email'";  
    $result = mysqli_query($db_conn, $query);
    if(!$result) {
        die("Database query failed");
    }
    $row = mysqli_fetch_array($result);
   	//$_SESSION['user'] = $row['user_name'];
    
    if($row['user_pass']== $user_pass)
	 {
	  $_SESSION['user'] = $row['user_name'];
	  $_SESSION['user_email'] = $row['user_email'];
	  header("Location: home.php");
	 }
	 else
	 {
	  echo "<div role='alert' class='alert alert-warning alert-dismissible fade in'><strong>Hey !</strong> You Provided Wrong Details, Please try another one!</div>";
	 }
} 

include_once("header.php");
?>
  <body>

    <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4"> 
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Sign In</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">  
                        <fieldset>  
                              
                            <div class="form-group">  
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="" required>  
                            </div>  
  
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >  
  
                        </fieldset>  
                    </form>  
                    <center><b>New User ?</b> <br></b><a href="register.php">Sign UP Here</a></center><!--for centered text-->  
                </div>  
            </div>  
        </div>  
    </div>  
</div> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="lib/js/bootstrap.min.js"></script>
  </body>
</html>

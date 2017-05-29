<?php session_start();
if (isset($_SESSION['user']) != "") {
	header("Location: home.php");
}
include_once ("header.php");
?>
  <body>		
    <div class="container">
    <div class="row">
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title text-center">Registration</h3>
                </div>  
                <div class="panel-body">  
                    <form enctype="multipart/form-data" id="register_user" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">  
                        <fieldset>  
                            <div class="form-group"> 
                            	<label for="registerusername11">User Name <span class="red">*</span></label> 
                                <input type="text" placeholder="Username" name="name" value="" class="form-control" required autofocus>  
                            </div>  
  
                            <div class="form-group">
                            	<label for="registeremail11">E-mail <span class="red">*</span></label> 
                                <input type="email" placeholder="E-mail" name="email" value="" class="form-control" autofocus required>             
                            </div>  
                            
                            <div class="form-group"> 
                            	<label for="registerpass11">Password <span class="red">*</span></label>  
                                <input class="form-control" placeholder="Password" name="pass" type="password" id="password" value="" required>  
                            </div>  
  							<div class="form-group">  
  								<label for="retypepass11">Re-type Password <span class="red">*</span></label>  
                                <input class="form-control" placeholder="Re-type Password" name="retypepass" type="password" id="retypepassword" value="" required>  
                            </div>
 
                            <button id="register" name="register" class="btn btn-lg btn-success btn-block" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Register</button>
  
                        </fieldset>  
                    </form>  
                    <center><b>Already registered ?</b> <br><a href="index.php">Login here</a></center><!--for centered text-->  
                </div>  
            </div>  
    </div>  
</div> 
	<script>
		jQuery(document).ready(function() {
			jQuery("#register_user").submit(function(e) {
				e.preventDefault();

				var password = jQuery('#password').val();
				var cpassword = jQuery('#retypepassword').val();

				if (password == cpassword) {
					var formData = jQuery(this).serialize();
					$.ajax({
						type : "POST",
						url : "signup_ac.php",
						data : formData,
						beforeSend: function() {
					        $.jGrowl("Please Wait", {
									header : 'Loading..'
								});
					    },
						success : function(html) {
							var finalresult = html.trim();
							if (finalresult == 'true') {
								$.jGrowl("Welcome to User Registration Management System", {
									header : 'Registration Successful'
								});
								var delay = 2000;
								setTimeout(function() {
									window.location = 'home.php'
								}, delay);
							} else if (finalresult == 'false') {
								$.jGrowl("User already exists in our database. Please Sure to Check Your Email ID with which You Belong. ", {
									header : 'Registration Failed'
								});
							}
						}
					});

				} else {
					$.jGrowl("Your confirm password does not match with current password", {
						header : 'Register Failed'
					});
				}
			});
		}); 
	</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.5/jquery.jgrowl.min.js"></script>
  </body>
</html>

<?php

include_once("database/db_conection.php");
$result2 = $result1 = null;
// Passkey that got from link
$passkey=$_GET['passkey'];

$tbl_name1="temp_users";

// Retrieve data from table where row that match this passkey
$sql1="SELECT * FROM $tbl_name1 WHERE confirm_code ='$passkey'";
$result1=mysqli_query($db_conn,$sql1);

// If successfully queried
if($result1){

// Count how many row has this passkey
$count=mysqli_num_rows($result1);

// if found this passkey in our database, retrieve data from table "temp_users"
if($count==1){

$rows=mysqli_fetch_array($result1);
$name=$rows['user_name'];
$email=$rows['user_email'];
$password=$rows['user_pass'];

$tbl_name2="users";

// Insert data that retrieves from "temp_users" into table "users"
$sql2="INSERT INTO $tbl_name2(user_name, user_email, user_pass)VALUES('$name', '$email', '$password')";
$result2=mysqli_query($db_conn,$sql2);
}

// if not found passkey, display message "Wrong Confirmation code"
else {
echo "Wrong Confirmation code";
}

// if successfully moved data from table"temp_users" to table "users" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"
if($result2){

echo "Your account has been activated";

// Delete information of this user from table "temp_members_db" that has this passkey
$sql3="DELETE FROM $tbl_name1 WHERE confirm_code = '$passkey'";
$result3=mysqli_query($db_conn,$sql3);

}

}
?>
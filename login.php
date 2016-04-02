<?php

$response = array();

if (isset($_POST['email']) && isset($_POST['password'])){

	$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
	$email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($con,"select * from user where email = '$email' and password = '$password'");
    if ($result->num_rows > 0 ) {
    	$row = $result->fetch_assoc();
    	$response["email"] = $row["email"];
        $response["name"] = $row["name"];
        $response["password"] = $row["password"];
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
   }else{
    $response["success"] = 0;
    $response["message"] = "Wrong mail or password";
    echo json_encode($response);
   }
}
else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
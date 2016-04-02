<?php

$response = array();

if (isset($_POST['pid'])){

	$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
	$id = (int) $_POST['pid'];
    $result = mysqli_query($con,"delete from pendingrequests where id = '$id'");
    
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
}
else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
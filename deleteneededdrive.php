<?php

$response = array();

if (isset($_POST['pid'])){

    $con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
    $id = (int) $_POST['pid'];
    $response["drive"] = array();
    $result = mysqli_query($con,"delete from pendingrequests where needdriveid = '$id'");
    $result = mysqli_query($con,"delete from aggrements where needdriveid = '$id'");
    $result = mysqli_query($con,"delete from needdrive where id = '$id'");
    if ($result) {
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
   }else{
    $response["success"] = 0;
    $response["message"] = "you send request for this drive or you have aggrement so you can't delete it";
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
<?php

$response = array();
// check for required fields
if (isset($_POST['goingid']) && isset($_POST['needdriveid'])) {
 
    $goingid = (int) $_POST['goingid'];
    $needdriveid = (int) $_POST['needdriveid'];
 
    $con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
    // mysql inserting a new row
    $result = mysqli_query($con,"INSERT INTO pendingrequests(goingid,needdriveid) VALUES('$goingid', '$needdriveid')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "The request is send.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
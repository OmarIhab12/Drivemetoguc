<?php

$response = array();

if (isset($_POST['pid'])){

	$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
	$id = (int) $_POST['pid'];
    $response["drive"] = array();
    $result = mysqli_query($con,"select * from pendingrequests where id = '$id'");
    $row = $result->fetch_assoc() ;
    $needdriveid = $row["needdriveid"];
    $goingid = $row["goingid"];
    $result = mysqli_query($con,"select * from havecar where id = '$goingid'");
    $result2 = mysqli_query($con,"select * from needdrive where id = '$needdriveid'");
    if ($result2->num_rows > 0 ) {
    	
        $row = $result->fetch_assoc();
        $row2 = $result2->fetch_assoc();

        $drive = array();
        $drive["pid"] = $row["id"];
        $drive["email"] = $row["email"];
        $drive["reservation"] = $row["reservation"];
        $drive["reservationtime"] = $row["reservationtime"];
        $drive["lng"] = $row2["lng"];
        $drive["lat"] = $row2["lat"];
        $drive["flag"] = $row["flag"];

            array_push($response["drive"], $drive);
        }
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
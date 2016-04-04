<?php

$response = array();
echo "yes";

if (isset($_POST['email'])){

	$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
	$email = $_POST['email'];
    $response["neededdrives"] = array();
    $result = mysqli_query($con,"select * from havecar where email = '$email'");
    if ($result->num_rows > 0 ) {
    	//$row = $result->fetch_assoc();
        while ($row = $result->fetch_assoc()) {
            $neededdrives = array();
            $neededdrives["pid"] = $row["id"];
            $neededdrives["email"] = $row["email"];
            $neededdrives["reservation"] = $row["reservation"];
            $neededdrives["reservationtime"] = $row["reservationtime"];
            $neededdrives["flag"] = $row["flag"];

            array_push($response["neededdrives"], $neededdrives);
        }
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
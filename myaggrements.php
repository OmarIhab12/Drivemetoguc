<?php

$response = array();

if (isset($_POST['email'])){

	$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
    $count = 0 ;
	$email = $_POST['email'];
    $response["neededdrives"] = array();
    $result = mysqli_query($con,"select * from aggrements ");
    if ($result->num_rows > 0 ) {
    	//$row = $result->fetch_assoc();
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $goingid = $row["goingid"];
            $needdriveid = $row["needdriveid"];
            $result2 = mysqli_query($con,"select * from havecar where id = '$goingid' and email = '$email'");
            if ($result2->num_rows > 0 ) {
        //$row = $result->fetch_assoc();
                while ($row = $result2->fetch_assoc()) {
                    $neededdrives = array();
                    $neededdrives["pid"] = $id;
                    $neededdrives["id"] = $row["id"];
                    $neededdrives["email"] = $row["email"];
                    $neededdrives["reservation"] = $row["reservation"];
                    $neededdrives["flag"] = $row["flag"];

                    array_push($response["neededdrives"], $neededdrives);
                    $count = $count + 1 ;
                }
            }
            $result2 = mysqli_query($con,"select * from needdrive where id = '$needdriveid' and email = '$email'");
            if ($result2->num_rows > 0 ) {
        //$row = $result->fetch_assoc();
                while ($row = $result2->fetch_assoc()) {
                    $neededdrives = array();
                    $neededdrives["pid"] = $id;
                    $neededdrives["id"] = $row["id"];
                    $neededdrives["email"] = $row["email"];
                    $neededdrives["reservation"] = $row["reservation"];
                    $neededdrives["flag"] = $row["flag"];

                    array_push($response["neededdrives"], $neededdrives);
                    $count = $count + 1 ;
                }
            }
        }
        if($count > 0){
            // success
             $response["success"] = 1;
        }
 
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
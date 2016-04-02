<?php

$response = array();

if (isset($_POST['pid'])){

	$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
	$id = (int) $_POST['pid'];
    $response["drive"] = array();
    $result = mysqli_query($con,"select * from pendingrequests where id = '$id'");
    if ($result->num_rows > 0 ) {
        $row = $result->fetch_assoc();
        $goingid = $row["goingid"];
        $needdriveid = $row["needdriveid"];

        $result = mysqli_query($con,"delete from pendingrequests where id = '$id'");
        $result = mysqli_query($con,"INSERT INTO aggrements(goingid,needdriveid) VALUES($goingid,$needdriveid)");
        if ($result){
            $response["success"] = 1;
          echo json_encode($response);
      }else{
    // success
    $response["success"] = 1;
    $response["message"] = "Aggrement already excist";
    echo json_encode($response);
}
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
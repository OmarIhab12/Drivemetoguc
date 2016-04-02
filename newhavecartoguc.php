<?php

$response = array();

if (isset($_POST['email']) && isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day']) && isset($_POST['hour']) && isset($_POST['minute']) 
        && isset($_POST['lng']) && isset($_POST['lat'])){

    $con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
    $email = $_POST['email'];
    $year = (int)$_POST['year'];
    $month = (int)$_POST['month'];
    $day = (int)$_POST['day'];
    $hour = (int)$_POST['hour'];
    $minute = (int)$_POST['minute'];
    $date = $year . "-" . $month . "-" . $day ;
    $time = $hour . ":" . $minute . ": 00";
    $lng = floatval($_POST['lng']);
    $lat = floatval($_POST['lat']);

    if($lng == 31.441782116889954 && $lat == 29.987993426084174 ){
        $response["success"] = 0;
    $response["message"] = "error Happen .. you didn't enter Location";
    echo json_encode($response);

    }else{
    $result = mysqli_query($con,"INSERT INTO havecar(email, reservation,reservationtime,lng,lat,flag) VALUES('$email', '$date','$time','$lng','$lat',0)");
    if ($result) {
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
   }else{
    $response["success"] = 0;
    $response["message"] = "error Happen .. make sure you didn't enter this drive before..";
    echo json_encode($response);
   }
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
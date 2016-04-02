<?php

$response = array();

if (isset($_POST['pid'])){

    $con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
    $id = (int) $_POST['pid'];
    $result = mysqli_query($con,"select * from needdrive where id = '$id'");
    if ($result->num_rows > 0 ) {
        $row = $result->fetch_assoc();
        $reservation = $row["reservation"];
        $reservationtimef = $row["reservationtimef"];
        $reservationtimel = $row["reservationtimel"];
        $lat = $row["lat"];
        $lng = $row["lng"];
        $flag = $row["flag"];
        $result = mysqli_query($con,"select * from havecar where reservation = '$reservation' and reservationtime < '$reservationtimel' 
                                                                 and flag ='$flag'");
        if ($result->num_rows > 0 ) {
            $response["options"] = array();
        while ($row = $result->fetch_assoc()) {
            $options = array();
            $options["pid"] = $row["id"];
            $options["email"] = $row["email"];
            $options["reservation"] = $row["reservation"];
            $options["reservationtime"] = $row["reservationtime"];
            $lng2 = $row["lng"];
            $lat2 = $row["lat"];
            $distance = distance($lat,$lng,$lat2,$lng2);
            $options["flag"] = $row["flag"];

            if($distance < 10){
                 array_push($response["options"], $options);
             }
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
}
else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

function distance($lat1, $lon1, $lat2, $lon2) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
      return ($miles * 1.609344);
  
}
?>
<?php
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
// check for required fields
if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['verifypassword'])) {
 
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $verifypassword = $_POST['verifypassword'];
    $code=substr(md5(mt_rand()),0,15);

    if($verifypassword == $password){
    $con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
 
    // mysql inserting a new row
    $result = mysqli_query($con,"INSERT INTO verify(email, name, password,code) VALUES('$email', '$name', '$password','$code')");

    $message = "Your Activation Code is ".$code."";
    $to=$email;
    $subject="Activation Code For Talkerscode.com";
    $from = 'omar.nada@student.guc.edu.eg';
    $body='Your Activation Code is '.$code.' Please Click On This link <a href="verification.php">http://localhost/DriveMeToGUC/verification.php?id='.$email.'code='.$code.'</a>to activate your account.';
    $headers = "From:".$from;
    mail($to,$subject,$body,$headers);
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully Registered.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "This mail is already used !!";
        
        // echoing JSON response
        echo json_encode($response);
    }
}else{
        $response["success"] = 0;
        $response["message"] = "Password verification is wrong !!";
        
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
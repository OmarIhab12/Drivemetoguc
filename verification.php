<?php

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id=$_GET['id'];
	$code=$_GET['code'];
	$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
    mysqli_select_db($con, "DriveMeToGUC");
	$select=mysql_query("select * from verify where email='$id' and code='$code'");
	if(mysql_num_rows($select)==1)
	{
		while($row=mysql_fetch_array($select))
		{
			$email=$row['email'];
			$password=$row['password'];
			$name = $row['name'];
		}
		$insert_user=mysql_query("INSERT INTO user(email, name, password) VALUES('$email', '$name', '$password'");
		$delete=mysql_query("delete from verify where email='$id' and code='$code'");
	}
}
else{echo "eroooooor";}

?>
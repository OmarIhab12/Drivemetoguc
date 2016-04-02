<?php

$con = mysqli_connect("localhost", "root", "") or die(mysql_error());
mysqli_query($con, "DROP DATABASE DriveMeToGUC");

if( mysqli_query($con, "CREATE DATABASE DriveMeToGUC"))
       	echo "db created";
else echo "error in db";

mysqli_select_db($con, "DriveMeToGUC");
mysqli_query($con,"CREATE TABLE user(email varchar(50) NOT NULL,name varchar(50) NOT NULL,password varchar(50) NOT NULL,lng DOUBLE(5,5),lat DOUBLE(5,5),PRIMARY KEY(email));");

mysqli_query($con,"CREATE TABLE verify(email varchar(50) NOT NULL,name varchar(50) NOT NULL,password varchar(50) NOT NULL,lng DOUBLE(5,5),lat DOUBLE(5,5),code int,PRIMARY KEY(email));");

mysqli_query($con,"CREATE TABLE havecar(id int Not Null AUTO_INCREMENT UNIQUE,email varchar(50) NOT NULL,
	                                       reservation date Not NULL,reservationtime time,  
	                                       lng DOUBLE(15,13),lat DOUBLE(15,13),flag int NOT NULL,
	                                       FOREIGN KEY (email) REFERENCES user(email),PRIMARY KEY (email,reservation,reservationtime));");


mysqli_query($con,"CREATE TABLE needdrive(id int Not Null AUTO_INCREMENT UNIQUE,email varchar(50) NOT NULL,
	                                       reservation date Not NULL,reservationtimef time NOT NULL,
	                                       reservationtimel time NOT NULL,
	                                       lng DOUBLE(15,13),lat DOUBLE(15,13),flag int NOT Null,
	                                       FOREIGN KEY (email) REFERENCES user(email),PRIMARY KEY (email,reservation,reservationtimef,reservationtimel));");

mysqli_query($con,"CREATE TABLE pendingrequests(id int NOT NULL AUTO_INCREMENT UNIQUE,goingid int,needdriveid int,
	                                            FOREIGN KEY (goingid) REFERENCES havecar(id),FOREIGN KEY (needdriveid) REFERENCES needdrive(id),
	                                            PRIMARY KEY (goingid,needdriveid));");


mysqli_query($con,"CREATE TABLE aggrements(id int NOT NULL AUTO_INCREMENT UNIQUE,goingid int,needdriveid int,
	                                            FOREIGN KEY (goingid) REFERENCES havecar(id),FOREIGN KEY (needdriveid) REFERENCES needdrive(id),
	                                            PRIMARY KEY (goingid,needdriveid));");

?>
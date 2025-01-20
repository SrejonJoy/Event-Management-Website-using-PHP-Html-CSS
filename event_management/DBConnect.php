<?php

$servername="localhost";
$username='root';
$password="";
$dbname="event_management";

//creating conenction

$conn=new mysqli($servername,$username,$password);

//check connection
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}
else{
    mysqli_select_db($conn,$dbname);
    // echo "Connection Successful";
    }
?>
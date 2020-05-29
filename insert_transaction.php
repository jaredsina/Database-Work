<?php
	session_start();
?>
<html><?php
$mycode=$_POST['code'];
$mytransaction=$_POST['type'];
$myamount=$_POST['amount'];
$mysource=$_POST['source'];
$mynote = $_POST['notes'];
include "dbconfig.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM CPS3740_2019S.Money_herjared";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$price = $row['amount'];
	$total += $price; 
	$dcode = $row['code'];
	if ($dcode == $mycode){
		echo"That code already exists!";
		exit();
	}
} 

if ($myamount <= 0) {
	echo"Amount must be positive.";
}elseif ($mysource == Null) {
	echo"You must choose a source.";
}elseif ($mytransaction == Null) {
	echo"You must choose a transaction type";
}elseif($myamount > $total and $mytransaction == 'W'){
	$custnames = $_SESSION['name1'];
	echo"Error! Customer $custnames has $$total in the bank, and tried to withdraw $myamount. Not enough money!";
}else{
	if($mytransaction == 'W'){
	$myamount *= -1;
	}
	$cid = $_COOKIE['customer_id'];
	$date = date("Y-m-d h:i:s");
	include "dbconfig.php";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO CPS3740_2019S.Money_herjared (cid,type, note,amount, code,sid,mydatetime)
	VALUES ('$cid', '$mytransaction', '$mynote', '$myamount', '$mycode','$mysource','$date')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

?></html>
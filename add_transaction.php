<?php
	session_start();
?>

<html><?php
if (isset($_COOKIE['customer_id'])) {
	include "dbconfig.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM CPS3740.Sources";
$result = $conn->query($sql);
	echo "<a href='logout.php'>User logout</a>";
	echo "<br>";
	echo "<br>";
	$custname = $_SESSION['name1'];
	$total = $_SESSION['balance'];
	echo "<b>Add Transaction</b>";
	echo "<br>";
	echo "<b>$custname</b> current balance is <b>$total</b>";

	echo "<form action ='insert_transaction.php' method= 'POST'>";
	echo "Transaction code: <input type= 'text' name='code' required='required'>";
	echo "<br>";
	echo "<input type='radio' name='type' value='D'> Deposit";
  	echo "<input type='radio' name='type' value='W'> Withdraw<br>";
  	echo "Amount: <input type= 'text' name='amount' required='required'><br>";
  	echo "Select a Source: <SELECT name='source'>";
  		echo "<option disabled selected value></option>";
		while($row = $result->fetch_assoc()) {
		$id = $row['id'];
		$sname= $row['name'];
		echo "<option value='$id'>$sname</option> ";
    	}
	echo "</SELECT>";
	echo "</br>";
  	echo "Note: <input type= 'text' name='notes' required='required'><br>";
	echo "<input type= 'submit' value = 'Submit'>";
	echo "</form>";
} else {
	echo "Please go back and log in!";
	echo "<br>";
	echo "<a href = 'p2.html'>Home Page</a>";
	
}
?></html>
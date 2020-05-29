<html><?php
    echo "<a href='logout.php'>User logout</a><br>";
	echo "You can only update <b>Note</b> column";
include "dbconfig.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT mid, code, cid, sid, type, amount, mydatetime, note FROM CPS3740_2019S.Money_herjared";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form>";
    echo "<table border =1><tr><th>Mid</th><th>Code</th><th>Type</th><th>Amount</th><th>Date Time</th><th>Note</th><th>Delete</th>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$transactiontype = $row['type'];
    	$price = $row['amount'];
    	$color = "#000000";
        $transcode = $row['code'];
    	if ($transactiontype == 'W'){
    		$color = "#ff0000";
    	}else {
    		$color = "#0000ff";
    	}
    	$total += $price; 
        echo "<tr><td>".$row["mid"]."</td><td>".$row["code"]."</td><td> ".$row["type"]."</td><td style =\"color: $color\">".$row["amount"]."</td><td>".$row["mydatetime"]."</td><td contenteditable='true' style='background-color: #FFFF00'>".$row["note"]."</td><td><input type='checkbox' name='delete' value='$transcode'></td></tr>";
       
    }
    echo "</table>";
    echo "</form>";
    echo "Total balance: $total";
}
?></html>
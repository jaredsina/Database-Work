<HTML><?php

# keep the sensitive information in a separated PHP file.
include "dbconfig.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$mylogin=$_POST['login'];
$mypassword=$_POST['password'];

$sql = "SELECT * FROM CPS3740.Customers where login='$mylogin' and password = '$mypassword'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$login1 = $row['login'];
	$customername = $row['name'];
	$customerstreet = $row['street'];
	$customercity = $row['city'];
	$customerzipcode = $row['zipcode'];
	$dateofbirth = $row['DOB'];
    }
    $sql2 = "SELECT * FROM CPS3740.Customers where login='$mylogin'";
$result2 = $conn->query($sql2);

while($row = $result2->fetch_assoc()) {
	$login1 = $row['login'];
	$customername = $row['name'];
	$customerstreet = $row['street'];
	$customercity = $row['city'];
	$customerzipcode = $row['zipcode'];
	$dateofbirth = $row['DOB'];
    }
//calculate age
$today = date("Y-m-d");
$diff = date_diff(date_create($dateofbirth), date_create($today));
$age = $diff->format('%y');
//lowercase user input
$str = strtolower($mylogin);
if($result->num_rows==1){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
{ $ip = $_SERVER['HTTP_CLIENT_IP']; }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{ $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
else { $ip = $_SERVER['REMOTE_ADDR']; }
$IPv4= explode(".",$ip);
echo "<br>Your IP: $ip\n";

if (($ip == '10.*.*.*') or ($ip == '131.125.*.*')){
	echo "<br>You are from Kean University\n";
}else {
	echo "<br>You are NOT from Kean University\n";
}

echo "<br>Welcome Customer: $customername";
echo "<br>Age: $age";
echo "<br>Address: $customerstreet, $customercity, $customerzipcode";
echo "<hr>The transactions for customer $customername are:";
	
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

    echo "<table border =1><tr><th>Mid</th><th>Code</th><th>Cid</th><th>Sid</th><th>Type</th><th>Amount</th><th>Date Time</th><th>Note</th>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$transactiontype = $row['type'];
    	$price = $row['amount'];
    	$color = "#000000";
    	if ($transactiontype == 'W'){
    		$color = "#ff0000";
    	}else {
    		$color = "#0000ff";
    	}
    	$total += $price; 
        echo "<tr><td>".$row["mid"]."</td><td>".$row["code"]."</td><td>".$row["cid"]."</td><td>".$row["sid"]."</td><td> ".$row["type"]."</td><td style =\"color: $color\">".$row["amount"]."</td><td>".$row["mydatetime"]."</td><td>".$row["note"]."</td></tr>";
       
    }
    echo "</table>";
    echo "Total balance: $total";
} else {
    echo "0 results";
}
}
elseif ($str == $login1){
		echo "User $mylogin is in the database, but wrong password was entered";
		echo "<br>
		<a href='index.html'>project home page</a>";
	}else{
		echo "Your login $mylogin does not exist in database!";
		echo "<br><a href='index.html'>project home page</a>";
	}
$conn->close();
?></HTML>
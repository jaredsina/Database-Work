<html><?php
if (isset($_COOKIE['customer_id'])) {
    $cookie_value = $_COOKIE['customer_id'];
	# keep the sensitive information in a separated PHP file.
	include "dbconfig.php";
// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    } 
	$mykeyword=$_GET['keyword'];

	$sql3 = "SELECT * FROM CPS3740.Customers where id='$cookie_value'";
    $result3 = $conn->query($sql3);

while($row = $result3->fetch_assoc()) {
    $login1 = $row['login'];
    $customername = $row['name'];
    $customerstreet = $row['street'];
    $customercity = $row['city'];
    $customerzipcode = $row['zipcode'];
    $dateofbirth = $row['DOB'];
    $customerid= $row['id'];

    }

//Display table if user enters *
    $mykeyword=$_GET['keyword'];


    if ($mykeyword == "*"){
        include "dbconfig.php";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    
        $sql2 = "SELECT CPS3740_2019S.Money_herjared.mid, CPS3740_2019S.Money_herjared.code, CPS3740_2019S.Money_herjared.type, CPS3740_2019S.Money_herjared.amount, CPS3740_2019S.Money_herjared.mydatetime, CPS3740_2019S.Money_herjared.note, CPS3740.Sources.name FROM CPS3740_2019S.Money_herjared LEFT JOIN CPS3740.Sources  on CPS3740_2019S.Money_herjared.sid = CPS3740.Sources.id;";
        $result2 = $conn->query($sql2);
    
         if ($result2->num_rows > 0) {

        echo "The transactions in customer $customername records that matched keyword $mykeyword are:";
        echo "<table border =1><tr><th>Mid</th><th>Code</th><th>Type</th><th>Amount</th><th>Date Time</th><th>Note</th><th>Sources</th>";
        // output data of each row
        while($row = $result2->fetch_assoc()) {
            $type = $row['type'];
            $price = $row['amount'];
            $color = "#000000";
            if ($type == 'W'){
                $color = "#ff0000";
            }else {
                $color = "#0000ff";
            } 
            $total += $price;
            echo "<tr><td>".$row["mid"]."</td><td>".$row["code"]."</td><td> ".$row["type"]."</td><td style =\"color: $color\">".$row["amount"]."</td><td>".$row["mydatetime"]."</td><td>".$row["note"]."</td><td>".$row["name"]."</td></tr>";
           
        }
        echo "</table>";
        echo "Total balance: $total";
    }
        else{
            echo "0 results";
        }

    }
       //display table if user keyword matches notes
    $sql = "SELECT CPS3740_2019S.Money_herjared.mid, CPS3740_2019S.Money_herjared.code, CPS3740_2019S.Money_herjared.type, CPS3740_2019S.Money_herjared.amount, CPS3740_2019S.Money_herjared.mydatetime, CPS3740_2019S.Money_herjared.note, CPS3740.Sources.name FROM CPS3740_2019S.Money_herjared LEFT JOIN CPS3740.Sources  on CPS3740_2019S.Money_herjared.sid = CPS3740.Sources.id where note LIKE '%$mykeyword%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "The transactions in customer $customername records that matched keyword $mykeyword are:";
        echo "<table border =1><tr><th>Mid</th><th>Code</th><th>Type</th><th>Amount</th><th>Date Time</th><th>Note</th><th>Source</th>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $type = $row['type'];
            $price = $row['amount'];
            $color = "#000000";
            if ($type == 'W'){
                $color = "#ff0000";
            }else {
                $color = "#0000ff";
            } 
            $total += $price;
            echo "<tr><td>".$row["mid"]."</td><td>".$row["code"]."</td><td> ".$row["type"]."</td><td style =\"color: $color\">".$row["amount"]."</td><td>".$row["mydatetime"]."</td><td>".$row["note"]."</td><td>".$row["name"]."</td></tr>";
           
        }
        echo "</table>";
        echo "Total balance: $total";
    }else if ($result->num_rows == 0 and $mykeyword != "*"){
            echo "There is no transactions in customer $customername records that matched the keyword: $mykeyword.";
        }

} else {
	echo "Please go back and log in!";
	echo "<br>";
	echo "<a href = 'p2.html'>Home Page</a>";
	
}
?></html>
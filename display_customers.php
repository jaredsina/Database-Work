<?php
echo "The following customers are in the bank system:";
# keep the sensitive information in a separated PHP file.
include "dbconfig.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, name, gender, login, password, DOB, street, city, state, zipcode FROM CPS3740.Customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border =1><tr><th>ID</th><th>Login</th><th>Password</th><th>Name</th><th>Gender</th><th>DOB</th><th>Street</th><th>City</th><th>State</th><th>Zipcode</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["login"]."</td><td>".$row["password"]."</td><td>".$row["name"]."</td><td> ".$row["gender"]."</td><td>".$row["DOB"]."</td><td>".$row["street"]."</td><td>".$row["city"]."</td><td>".$row["state"]."</td><td>".$row["zipcode"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
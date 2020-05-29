
<?php
if (isset($_COOKIE['customer_id'])) {
    unset($_COOKIE['customer_id']);
    setcookie('customer_id', null, -1, '/');
    echo "You have successfully logged out";
} else {
	echo "You have failed to log out!";
}
session_destroy();
?>

<html>
	<br>
	<a href="index.html">Return to project home page</a>
</html>
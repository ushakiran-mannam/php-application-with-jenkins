<?php
$servername = "dockerstack3_mysql:3306";
$username = rtrim(file_get_contents("/run/secrets/DB_USERNAME"));
$password = rtrim(file_get_contents("/run/secrets/DB_PASSWORD"));
$db="organisation";

echo "Connecting to MySQL<br>";
// Create connection
var_dump(function_exists('mysqli_connect'));
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT name FROM member";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo " Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

?>

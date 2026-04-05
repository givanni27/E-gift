<?php
$host = getenv('mysql.railway.internal');
$user = getenv('root');
$pass = getenv('pYTBAlaxErAlOwXxdoKDmJkJGnratqWD');
$db   = getenv('railway');

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Database connected ✅";

<?php
$host = getenv('mysql.railway.internal');
$user = getenv('root');
$pass = getenv('pYTBAlaxErAlOwXxdoKDmJkJGnratqWD');
$db   = getenv('railway');
$port = getenv('3306');

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Database connected ✅";

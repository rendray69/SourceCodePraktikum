<?php

session_start();

$host="localhost";
$user="root";
$pass="";
$dbname="muslimz";

$con = mysqli_connect($host, $user, $pass, $dbname);

if (!$con) {
	die("koneksi gagal : ".mysqli_connect_error());
}

// <?php

// session_start();

// $host="sql104.epizy.com";
// $user="epiz_28205489";
// $pass="DsOZYOedvXi2vt";
// $dbname="epiz_28205489_muslimzData";

// $con = mysqli_connect($host, $user, $pass, $dbname);

// if (!$con) {
// 	die("koneksi gagal : ".mysqli_connect_error());
// }


?>

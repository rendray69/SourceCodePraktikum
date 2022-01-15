<?php
	include "../config.php";

	$kk = $_GET['nama'];
	$sql="SELECT * FROM musnad_syafii WHERE terjemah LIKE '%$kk%'";
	$tampil = mysqli_query($con,$sql);
	if (mysqli_num_rows($tampil) > 0) {
	$no=1;
	$response = array();
	 $response["data"] = array();
	while ($r = mysqli_fetch_array($tampil)) {
	 $h['id'] = $r['id'];
	 $h['kitab'] = $r['kitab'];
	 $h['arab'] = $r['arab'];
	 $h['terjemah'] = $r['terjemah'];
	 array_push($response["data"], $h);
	 }
	 echo json_encode($response);
	}
	else {
	 $response["message"]="tidak ada data";
	 echo json_encode($response);
	 }
?>
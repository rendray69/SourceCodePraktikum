<?php
	include "../config.php";
	header('Content-Type: text/xml');

	$kk = $_GET['nama'];
	$query = "SELECT * FROM musnad_syafii WHERE terjemah LIKE '%$kk%'";
	$hasil = mysqli_query($con,$query);
	$jumField = mysqli_num_fields($hasil);
	echo "<?xml version='1.0'?>";
	echo "<data>";
	while ($data = mysqli_fetch_array($hasil))
	{
	 echo "<hadith>";
	 echo"<id>",$data['id'],"</id>";
	 echo"<kitab>",$data['kitab'],"</kitab>";
	 echo"<arab>",$data['arab'],"</arab>";
	 echo"<terjemah>",$data['terjemah'],"</terjemah>";
	 echo "</hadith>";
	}
	echo "</data>";
?>
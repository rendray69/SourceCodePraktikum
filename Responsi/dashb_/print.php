<?php
	// memanggil library FPDF
	require('../fpdf/fpdf.php');
	// intance object dan memberikan pengaturan halaman PDF
	$pdf = new FPDF('l','mm','A5');
	// membuat halaman baru
	$pdf->AddPage();
	// setting jenis font yang akan digunakan
	$pdf->SetFont('Arial','B',16);
	// mencetak string
	$pdf->Cell(190,7,'MUSLIMS HABIT TRACKER',0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,7,'YOUR PROGRESS',0,1,'C');
	// Memberikan space kebawah agar tidak terlalu rapat
	$pdf->Cell(10,7,'',0,1);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,6,'NO',1,0);
	$pdf->Cell(30,6,'TRIGGER',1,0);
	$pdf->Cell(45,6,'YOUR NEW HABIT',1,0);
	$pdf->Cell(25,6,'INTENTION',1,0);
	$pdf->Cell(50,6,'REWARD',1,0);
	$pdf->Cell(30,6,'PROGRESS',1,1);
	$pdf->SetFont('Arial','',10);

	$id = $_GET['akun_id'];

	include 'config.php';
	$mahasiswa = mysqli_query($con, "select * from tracker where akun_ID = '".$id."'");
	$no = 0;

	while ($row = mysqli_fetch_array($mahasiswa)){
		$no++;
		$pdf->Cell(10,6,$no,1,0);
		$pdf->Cell(30,6,$row['tracker_trigger'],1,0);
		$pdf->Cell(45,6,$row['tracker_habit'],1,0);
		$pdf->Cell(25,6,$row['tracker_intention'],1,0);
		$pdf->Cell(50,6,$row['tracker_reward'],1,0);
		$check = $row['tracker_check'];
		$done = "cek";
		if($check==1)$done = "Done";
		else $done = "Unfinished";
		$pdf->Cell(30,6,$done,1,1);
	}
	$pdf->Output();
?>

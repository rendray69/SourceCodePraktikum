<?php

    include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    // $user = $_SESSION['loginUser'];
    // $pass = $_SESSION['loginPass'];
    $id = $_SESSION['loginid'];
    // $nadep = $_SESSION['loginNadep'];
    // $nabel = $_SESSION['loginNabel'];
    // $tgl = $_SESSION['loginTgl'];
    // $jk = $_SESSION['loginJenkel'];
    // $ema = $_SESSION['loginEmail'];
    // $hp = $_SESSION['loginNohp'];
    // $desk = $_SESSION['loginDesk'];
    // $wp = $_SESSION['loginWP'] ;
    // //$ = $_SESSION['loginFP'];
    // $namfot = $_SESSION['login'];

    $nd = $_GET['nd'];
    $nb = $_GET['nb'];
    $tl = $_GET['tl'];
    $jk = $_GET['jk'];
    $bi = $_GET['bi'];
    $wp = $_GET['wp'];
    $em = $_GET['em'];
    $hp = $_GET['hp'];

    $sql_update = "UPDATE account SET akun_namaDepan = '$nd', akun_namaBelakang = '$nb',
    akun_email = '$em', akun_noHP = '$hp', akun_tanggalLahir = '$tl', akun_webProfil = '$wp',
    akun_jenisKelamin = '$jk', akun_deskripsi = '$bi' WHERE akun_id = '$id'";
    mysqli_query($con, $sql_update);

    $check_sqlPoin=mysqli_query($con,"SELECT condi.detaildata, condi.condition_id FROM condi JOIN account ON account.condition_ID = condi.condition_id WHERE account.condition_id = '$id'");
    $row2 = mysqli_fetch_array($check_sqlPoin, MYSQLI_ASSOC);
    $idd2 = $row2['detaildata'];
    if ($idd2 == '0') {
        $check_sqlPoin3=mysqli_query($con,"SELECT MAX(point_id) AS id FROM point");
        $row3 = mysqli_fetch_array($check_sqlPoin3, MYSQLI_ASSOC);
        $idd3 = $row3['id'];
        $idd3++;
        
        $date= date("Y-m-d");
        $time=date("H:m:s");
        $dd=$date." ".$time;
        //cek total point
        $check_sqlPoin4 = "SELECT * FROM point WHERE akun_ID = '$id' ORDER BY point_id DESC LIMIT 1";
        $result4 = mysqli_query($con, $check_sqlPoin4);
        $rowq = mysqli_fetch_array($result4, MYSQLI_ASSOC);
        $tot = 150;

        $tot += $rowq['point_total'];

        //jenis_id = 3 : detail data
        $sql_tambahPoin = "INSERT INTO point VALUES ('$idd3', '150', '$dd', '$tot', '3', '$id')";
        mysqli_query($con, $sql_tambahPoin);

        $idc = $row2['condition_id'];
        $sql_editCondi = "UPDATE condi SET detaildata = '1' WHERE condition_id = '$idc'";
        mysqli_query($con, $sql_editCondi);
    }
?>

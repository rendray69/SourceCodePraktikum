<?php

    include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];

    
    $tr = $_GET['tr'];
    $hb = $_GET['hb'];
    $it = $_GET['it'];
    $rw = $_GET['rw'];

    $check_sql=mysqli_query($con,"SELECT MAX(tracker_id) AS id FROM tracker");
    $row1 = mysqli_fetch_array($check_sql, MYSQLI_ASSOC);
    $idd1 = $row1['id'];
    if (is_null($idd1)) {
        $idd1 = 1;
    }else{
        $idd1++;
    }

    $sql_tambah = "INSERT INTO tracker VALUES ('$idd1', '$tr', '$hb', '$it', '$rw','0','$id')";
    mysqli_query($con, $sql_tambah);

    $sqlCheck = "SELECT * FROM tracker WHERE akun_ID = '$id'";
    $result = mysqli_query($con, $sqlCheck);

    $check_sqlPoin=mysqli_query($con,"SELECT condi.habit, condi.condition_id FROM condi JOIN account ON account.condition_ID = condi.condition_id WHERE account.condition_id = '$id'");
    $row2 = mysqli_fetch_array($check_sqlPoin, MYSQLI_ASSOC);
    $idd2 = $row2['habit'];
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
        $tot = 250;

        $tot += $rowq['point_total'];
        //jenis_id = 1 : point sign up
        $sql_tambahPoin = "INSERT INTO point VALUES ('$idd3', '250', '$dd', '$tot', '2', '$id')";
        mysqli_query($con, $sql_tambahPoin);

        $idc = $row2['condition_id'];
        $sql_editCondi = "UPDATE condi SET habit = '1' WHERE condition_id = '$idc'";
        mysqli_query($con, $sql_editCondi);
    }

?>

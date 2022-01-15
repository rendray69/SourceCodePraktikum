<?php


    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }


    if(isset($_GET['tracker_id'])){
        include('config.php');

        $ida = $_SESSION['loginid'];
        $id = $_GET['tracker_id'];

        $sql_update = "UPDATE tracker SET tracker_check = '1' WHERE tracker_id = '$id'";
        mysqli_query($con, $sql_update);

        //tambah ke table point
        $check_sqlPoin3=mysqli_query($con,"SELECT MAX(point_id) AS id FROM point");
        $row3 = mysqli_fetch_array($check_sqlPoin3, MYSQLI_ASSOC);
        $idd3 = $row3['id'];
        $idd3++;
        
        $date= date("Y-m-d");
        $time=date("H:m:s");
        $dd=$date." ".$time;

        //cek total point
        $check_sqlPoin4 = "SELECT * FROM point WHERE akun_ID = '$ida' ORDER BY point_id DESC LIMIT 1";
        $result4 = mysqli_query($con, $check_sqlPoin4);
        $rowq = mysqli_fetch_array($result4, MYSQLI_ASSOC);
        $tot = 5;

        $tot += $rowq['point_total'];

        //jenis_id = 5 : finish habit
        $sql_tambahPoin = "INSERT INTO point VALUES ('$idd3', '5', '$dd', '$tot', '5', '$ida')";
        mysqli_query($con, $sql_tambahPoin);

        header('Location: test.php?home=1');
    }

    if(isset($_GET['id'])){
        require_once('config.php');

        $id = $_GET['id'];

        $sql_hapus = "DELETE FROM tracker WHERE tracker_id = '$id'";
        mysqli_query($con, $sql_hapus);

        header('Location: test.php?habit=1');
    }

?>

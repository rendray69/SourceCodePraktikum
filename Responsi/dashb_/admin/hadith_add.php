<?php

    include('../config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../../index.php');
    }

    $id = $_SESSION['loginid'];

    
    $kit = $_GET['kit'];
    $dal = $_GET['dal'];
    $ter = $_GET['ter'];

    $check_sql=mysqli_query($con,"SELECT MAX(id) AS id FROM musnad_syafii");
    $row1 = mysqli_fetch_array($check_sql, MYSQLI_ASSOC);
    $idd1 = $row1['id'];
    if (is_null($idd1)) {
        $idd1 = 1;
    }else{
        $idd1++;
    }

    $sql_tambah = "INSERT INTO musnad_syafii VALUES ('$idd1', '$kit', '$dal', '$ter')";
    mysqli_query($con, $sql_tambah);

?>

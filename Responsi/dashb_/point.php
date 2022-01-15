<?php

    // include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];

    $sqlCheck = "SELECT * FROM jenispoint INNER JOIN point ON jenispoint.jenis_id = point.jenis_ID WHERE point.akun_ID = '$id' ORDER BY point.point_id DESC";
    $result = mysqli_query($con, $sqlCheck);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    //cek total point
    $check_sqlPoin4 = "SELECT point_total AS tot FROM point WHERE akun_ID = '$id' ORDER BY point_id DESC LIMIT 1";
    $result4 = mysqli_query($con, $check_sqlPoin4);
    $rowq = mysqli_fetch_array($result4, MYSQLI_ASSOC);

    //cek gambar
    $query = "SELECT akun_namaFoto FROM account WHERE akun_id = '$id'";
    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    // $q = 0;
?>

<head>
    <title>MUSLIMZ | My Points</title>
</head>

        <table class="table1">
            <tr>
                <td style="background-color: seagreen;color:white" colspan="2">Total Point</th>
                <td style="background-color: salmon;"><b><?=$rowq['tot'];?></b></th>
            </tr>
            <tr>
                <th style="width:30%">Date & Time</th>
                <th style="width:25%">Point History</th>
                <th style="width:20%">Points</th>
            </tr>
            <?php
                foreach ($result as $hasil) :
            ?>
            <tr>
                <td><?=$hasil['point_tanggal'];?></td>
                <td><?=$hasil['jenis_keterangan'];?></td>
                <td><?=$hasil['point_temp'];?></td>
            </tr>
            <?php
                endforeach;
            ?> 
        </table>

    <script>
        var q = "<?php echo $q; ?>";

        if(q==1){
            myFunction();
        }
    </script>

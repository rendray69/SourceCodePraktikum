<?php

    // include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];

    $sqlCheck = "SELECT * FROM notif WHERE akun_ID = '$id' ORDER BY notif_id DESC";
    $result = mysqli_query($con, $sqlCheck);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    //cek gambar
    $query = "SELECT akun_namaFoto FROM account WHERE akun_id = '$id'";
    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    //update notif
    $sql_update = "UPDATE notif SET notif_check = '1' WHERE akun_ID = '$id'";
    mysqli_query($con, $sql_update);
    
    $q = 0;
?>

<head>
    <title>MUSLIMZ | Notification</title>
</head>

        <table class="table1">
            <tr>
                <th style="width:15%">Date & Time</th>
                <th style="width:85%">Message</th>
            </tr>
            <?php
                foreach ($result as $hasil) :
            ?>
            <tr>
                <td><?=$hasil['notif_tanggal'];?></td>
                <td><?=$hasil['notif_isi'];?></td>
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

<?php
    //include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];
    $condi_id = $_SESSION['condi'];

    //cek notif
    $check_notif=mysqli_query($con,"SELECT MAX(notif_id) AS id FROM notif");
    $row5 = mysqli_fetch_array($check_notif, MYSQLI_ASSOC);
    $idd5 = $row5['id'];
    if (is_null($idd5)) {
        $idd5 = 1;
    }else{
        $idd5++;
    }

    //cek quotes
    $check_quote=mysqli_query($con,"SELECT MAX(quotes_id) AS id FROM quotes");
    $row6 = mysqli_fetch_array($check_quote, MYSQLI_ASSOC);
    $idd6 = $row6['id'];
    if (is_null($idd6)) {
        $idd6 = 1;
    }else{
        $idd6++;
    }
    //cek gambar
    $check_quote=mysqli_query($con,"SELECT MAX(id) AS id FROM tbl_product");
    $row7 = mysqli_fetch_array($check_quote, MYSQLI_ASSOC);
    $idd7 = $row7['id'];
    if (is_null($idd7)) {
        $idd7 = 1;
    }else{
        $idd7++;
    }

    //tambah point
    $check_sqlPoin3=mysqli_query($con,"SELECT MAX(point_id) AS id FROM point");
    $row3 = mysqli_fetch_array($check_sqlPoin3, MYSQLI_ASSOC);
    $idd3 = $row3['id'];
    $idd3++;

    $test = $_SESSION['loginNadep'];

    $date=date("Y-m-d");
    $time=date("H:m:s");
    $dd=$date." ".$time;

    //add point & notif
    if(isset($_POST['addPoint'])){
        $bnkPnt = $_POST['tri'];
        $notifi = $_POST['rew'];

        $tot = $bnkPnt;

        $sqlCheck = "SELECT akun_id AS id FROM account";
        $hasil = mysqli_query($con, $sqlCheck);
        $count = mysqli_num_rows($hasil);
        
        for($x=1; $x <= $count; $x++){
            $check_sqlPoin4 = "SELECT * FROM point WHERE akun_ID = '$x' ORDER BY point_id DESC LIMIT 1";
            $result4 = mysqli_query($con, $check_sqlPoin4);
            $rowq = mysqli_fetch_array($result4, MYSQLI_ASSOC);
            $tot += $rowq['point_total'];
            //tambah ke table point
            $sql_tambahPoin = "INSERT INTO point VALUES ('$idd3', '$bnkPnt', '$dd', '$tot', '6', '$x')";
            mysqli_query($con, $sql_tambahPoin);
            //tambah ke table notif
            $tambah_notif = "INSERT INTO notif VALUES ('$idd5', '$dd','$notifi','0','$x')";
            mysqli_query($con, $tambah_notif);
            $idd5++;
            $idd3++;
        }
    }

    //tambah quote
    if(isset($_POST['addQuotes'])){
        $sur = $_POST['sur'];
        $ver = $_POST['ver'];
        $quo = $_POST['quo'];
        $tra = $_POST['tra'];

        $tambah_quot = "INSERT INTO quotes VALUES ('$idd6', '$sur','$ver','$quo','$tra')";
        mysqli_query($con, $tambah_quot);
    }

    //tambah gambar
    if(isset($_POST['addPic'])){
        $nam = $_POST['nam'];
        $pri = $_POST['pri'];
        $fot = $_FILES['fot']['name'];

        $tambah_pic = "INSERT INTO tbl_product VALUES ('$idd7', '$nam','$fot','$pri')";
        mysqli_query($con, $tambah_pic);

        $lokasi_file = $_FILES['fot']['tmp_name'];
        $direktori = "D:/Education/Hosting/htdocs/!Kuliah/PRPL/img/$fot";
        move_uploaded_file($lokasi_file, $direktori);
    }

    // $q = 0;//untuk menampilkan badge merah di notiv
?>
    <!-- main  -->
<div class="float-kanan">
    <a href="test.php?hadis=1">
        <input id="hadis" type="submit" name="cari" value="Add Hadith"  class="btn btn-outline-secondary bts" >
    </a>    
    <input id="poin" type="button" name="cari" data-bs-toggle="modal" data-bs-target="#notifikasi_modal" value="Give Point To All Member"  class="btn btn-outline-secondary bts" >
    
    <input id="quot" type="submit" name="cari" value="Add Quotes" data-bs-toggle="modal" data-bs-target="#quotes_modal" class="btn btn-outline-secondary bts" >

    <form method="post">
        <input id="quot" type="submit" name="userXML" value="Show Users in XML" class="btn btn-outline-secondary bts" >
    </form>
    <input id="quot" type="submit" name="cari" value="Add Picture" data-bs-toggle="modal" data-bs-target="#gambar_modal" class="btn btn-outline-secondary bts" >
    
</div>
<br/>
<?php

    if(isset($_POST['userXML'])){
        $url = "https://1900018014praktikum.000webhostapp.com/dashb_/admin/get_users.php";
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        $resulti = json_decode($response);
        foreach ($resulti as $r) :
            echo "<p>";
            echo "Nama Depan : " . $r->akun_namaDepan . "<br />";
            echo "Nama Belakang : " . $r->akun_namaBelakang . "<br />";
            echo "jenis kelamin : " . $r->akun_jenisKelamin . "<br />";
            echo "Alamat E-mail : " . $r->akun_email . "<br />";
            echo "Tanggal Lahir : " . $r->akun_tanggalLahir . "<br />";
            echo "</p>";
        endforeach;

    }


?>
<div class="modal fade" id="notifikasi_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Give Point To All Member</h5>
            </div>

            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tri">How Much Point</label>
                            <input type="text" id="tri" class="form-control" autocomplete="off" name="tri" onkeyup="success()">
                        </div>
                        <div class="col-md-6">
                            <label for="int">Date</label>
                            <input type="text" id="int" class="form-control" name="int" value="<?=$dd;?>" disabled="disabled">
                        </div>
                    </div>
                    <label for="rew">Notification</label>
                    <input type="text" class="form-control" autocomplete="off" name="rew" id="rew" onkeyup="success()" ><br/>
                    <input type="hidden" name="edi" value="<?=$idd5;?>">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#notifikasi_modal">Cancel</button>
                    <input name="addPoint" id="ss" value="Send" type="submit" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#notifikasi_modal" disabled="disabled">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quotes_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Quotes</h5>
            </div>

            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sur">Surah</label>
                            <input type="text" autocomplete="off" id="sur" onkeyup="success()" class="form-control" name="sur">
                        </div>
                        <div class="col-md-6">
                            <label for="ver">Verse</label>
                            <input type="text" autocomplete="off" id="ver" onkeyup="success()" class="form-control" name="ver">
                        </div>
                    </div>
                    <label for="quo">Quotes</label>
                    <div data-tip="English Translate for the Verse">
                        <input type="text" autocomplete="off" id="quo" onkeyup="success()" class="form-control" name="quo">
                    </div>
                    <label for="tra">Translate</label>
                    <div data-tip="Indonesian Translate">
                        <input type="text" autocomplete="off" id="tra" onkeyup="success()" class="form-control" name="tra">
                    </div>
                    <br/>
                    <input type="hidden" name="edi" value="<?=$idd5;?>">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#quotes_modal">Cancel</button>
                    <input name="addQuotes" id="sb" value="Save" type="submit" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#quotes_modal" disabled="disabled">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gambar_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Picture For the Store</h5>
            </div>

            <div class="modal-body">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nam">Name</label>
                            <input type="text" class="form-control" autocomplete="off" onkeyup="success()" id="nam" name="nam">
                        </div>
                        <div class="col-md-6">
                            <label for="pri">Price</label>
                            <input type="text" class="form-control" autocomplete="off" onkeyup="success()" id="pri" name="pri">
                        </div>
                    </div><br/>
                    <input type="file" class="form-control" id="fot" name="fot"><br/>
                    <input type="hidden" name="edi" value="<?=$idd7;?>">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#gambar_modal">Cancel</button>
                    <input name="addPic" id="sp" value="Save" type="submit" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#gambar_modal" disabled="disabled">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/main.js"></script>
<script>   
    function success() {
        var w, x, y, z, a, b, c, d, e; 
        w = document.getElementById("tri").value;
        x = document.getElementById("rew").value;
        if (w == "" || x == "") {
            document.getElementById('ss').disabled = true; 
        } else { 
            document.getElementById('ss').disabled = false;
        }

        a = document.getElementById("sur").value;
        b = document.getElementById("ver").value;
        y = document.getElementById("quo").value;
        z = document.getElementById("tra").value;
        if (a == "" || b == "" || y == "" || z == "") {
            document.getElementById('sb').disabled = true; 
        } else { 
            document.getElementById('sb').disabled = false;
        }

        c = document.getElementById("nam").value;
        d = document.getElementById("pri").value;
        e = document.getElementById("fot").value;
        if (c == "" || d == "") {
            document.getElementById('sp').disabled = true; 
        } else { 
            document.getElementById('sp').disabled = false;
        }

    }
</script>
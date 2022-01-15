<?php

    // include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];
    //menampilkan barang dagang yang telah dibeli
    $query = "SELECT * from tbl_product JOIN transaksi on transaksi.product_ID = tbl_product.id Where transaksi.akun_ID = '$id' ORDER BY transaksi.transaksi_tanggal ASC";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //cek gambar
    $query = "SELECT akun_namaFoto FROM account WHERE akun_id = '$id'";
    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    //tampil barang yg belum dibeli
    $sql_cekbarang = "SELECT * FROM tbl_product where id NOT IN (select transaksi.product_ID from transaksi where transaksi.akun_ID = '$id')";
    $result4 = mysqli_query($con, $sql_cekbarang);
    $roww = mysqli_fetch_array($result4, MYSQLI_ASSOC);

    //cekk point
    $mkn_sql = "SELECT * FROM point WHERE akun_ID = '$id'";
    $cekk = mysqli_query($con, $mkn_sql);
    $rowi = mysqli_fetch_array($cekk, MYSQLI_ASSOC);

    //hitung tot point
    $tot = 0;
    foreach($cekk as $po) : 
        $tot += (int)$po['point_temp'];
    endforeach;

    //form - kalo barang dibeli
    if (isset($_POST['purchase'])) {
        $id_bar = $_POST['idd'];
        $hargaa = $_POST['hrg'];

        //buat tanggal jam
        $date=date("Y-m-d");
        $time=date("H:m:s");
        $dd=$date." ".$time;

        //cek id
        $check_sqlBool=mysqli_query($con,"SELECT MAX(transaksi_id) AS id FROM transaksi");
        $row3 = mysqli_fetch_array($check_sqlBool, MYSQLI_ASSOC);
        $idd3 = $row3['id'];
        if (is_null($idd3)) {
            $idd3 = 1;
        }else{
            $idd3++;
        }

        //cek id point
        $check_sqlPoin3=mysqli_query($con,"SELECT MAX(point_id) AS id FROM point");
        $row4 = mysqli_fetch_array($check_sqlPoin3, MYSQLI_ASSOC);
        $idd4 = $row4['id'];
        $idd4++;

        //cek max point
        $check_sqlPoin4 = "SELECT point_total AS tot FROM point WHERE akun_ID = '$id' ORDER BY point_ID DESC LIMIT 1";
        $result5 = mysqli_query($con, $check_sqlPoin4);
        $rowq = mysqli_fetch_array($result5, MYSQLI_ASSOC);

        $tott = $rowq['tot'];

        $tott -= (int)$hargaa;
        $hargaa *= -1;
        //menambahkan history
        $sql_tambahPoin = "INSERT INTO point VALUES ('$idd4', '$hargaa', '$dd', '$tott', '4', '$id')";
        mysqli_query($con, $sql_tambahPoin);

        //masukin data ke table trasaksi
        $sql_transaksi = "INSERT INTO transaksi VALUES ('$idd3','$id', '$id_bar', '$dd', '1')";
        mysqli_query($con, $sql_transaksi);
        echo "<script>window.history.pushState('', 'ntol', 'test.php?store=1');location.reload();</script>";
    }
    //form - kalo barang dipake
    if (isset($_POST['equip'])) {
        $nafoo = $_POST['nafo'];

        $sql_update = "UPDATE account SET akun_namaFoto='$nafoo' WHERE akun_id='$id'";
        mysqli_query($con, $sql_update);
        echo "<script>window.history.pushState('', 'ntol', 'test.php?store=1');location.reload();</script>";
    }

    $check_sqlPoin6 = "SELECT * from account ORDER BY akun_id ASC";
    $result6 = mysqli_query($con, $check_sqlPoin6);
    $roww = mysqli_fetch_array($result6, MYSQLI_ASSOC);

    // $q = 0;
?>

<head>
    <title>MUSLIMZ | Explore</title>
</head>
        <div class="container">
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">

                <!-- tab1 -->
                <div class="tab-content p-4 p-md-5 uy" id="stores">
                    <h3 class="mb-4">Muslimz Store</h3>
                    <div class="cards">
                        <?php
                            foreach ($result as $hasil) :
                        ?>

                        <div class="card">
                            <img src="../img/<?=$hasil['image'];?>" alt="Avatar" style="width:100%">
                            <br>
                            <h5 class="mt-2"><b><?=$hasil['name'];?></b></h5>
                            <p></p>
                            <form action="#" method="post">
                            <input type="hidden" name="nafo" value="<?=$hasil['image'];?>">
                            <?php
                                if($row2['akun_namaFoto'] == $hasil['image']){
                                    echo '<input type="submit" value="Used" name="equip" class="btn btn-success" disabled="disabled">';
                                }else{
                                    echo '<input type="submit" value="Use" name="equip" class="btn btn-outline-success">';
                                }
                            ?>
                            </form>
                        </div>

                        <?php
                            endforeach;
                            foreach ($result4 as $tes) :
                        ?>

                        <div class="card">
                            <img src="../img/<?=$tes['image'];?>" alt="Avatar" style="width:100%">
                            <h5 class="mt-2"><b><?=$tes['name'];?></b></h5> 
                            <p>Price : <?=$tes['price'];?> Points</p>
                            <?php
                                if($tot < $tes['price']){
                                    echo '<input type="button" value="Not enough point"class="btn btn-secondary" disabled="disabled">';
                                }else{
                                    echo '<input id="submit" type="button" value="Purchase" data-bs-toggle="modal" data-bs-target="#beli_btn'.$tes['id'].'" class="btn btn-outline-secondary">';
                                }
                            ?>
                        </div>

                        <!-- modal -->
                        <div class="modal fade" id="beli_btn<?php echo $tes['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                    </div>

                                    <div class="modal-body">
                                        <h5 style="text-align: center;">Are you sure want to purchase : </h5>
                                        <h6 style="text-align: center; color: green;"><?=$tes['name']; ?> for <?=$tes['price']; ?> points</h6>
                                        <br/>
                                        <form action="#" method="post">
                                            <input type="hidden" name="idd" value="<?=$tes['id']; ?>">
                                            <input type="hidden" name="hrg" value="<?=$tes['price']; ?>">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#beli_btn<?php echo $tes['id']; ?>">Cancel</button>
                                            <input name="purchase" value="Purchase" type="submit" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#beli_btn<?php echo $tes['id']; ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>

                <!-- tab2 -->
                <div class="tab-content p-4 p-md-5 uy" id="members" style="display: none">
                    <h3 class="mb-4">Muslimz Members</h3>
                    <div class="cardis">
                    <?php
                        $no = 1;
                        foreach($result6 as $rank) : 
                            echo '<div class="cardi">';
                            if($rank['akun_namaDepan'] == NULL){
                                
                                echo '<div class="imgg">'.$no.'<img src="../img/'.$rank['akun_namaFoto'].'" alt="" class="rank__img  mx-4"></div>';
                                echo "(Hamba Allah)</div>";
                            }else{
                                echo '<div class="imgg">'.$no;
                    ?>
                    <img src="../img/<?php echo $rank['akun_namaFoto']; ?>" alt="" class="rank__img mx-4"></div><?=$rank['akun_namaDepan'];?><br><div class="gnd"><b><?=$rank['akun_deskripsi'];?></b></div>
                    </div>
                    <?php
                            }
                            $no++;
                        endforeach;
                    ?>
                    </div>
                </div>

            </div>
        </div>

    <script src="../js/main.js"></script>
    <script type="text/javascript">
        var q = "<?php echo $q; ?>";

        if(q==1){
            myFunction();
        }

        //hidden tab
        function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("uy");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }
    </script>
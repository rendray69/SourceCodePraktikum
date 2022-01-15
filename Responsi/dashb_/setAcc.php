<?php

    // include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $user = $_SESSION['loginUser'];
    $pass = $_SESSION['loginPass'];

    $sqlLogin = "SELECT * FROM account WHERE akun_username = '$user' AND akun_password = '$pass'";
    $result = mysqli_query($con, $sqlLogin);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $id = $row['akun_id'];
        $nd = $row['akun_namaDepan'];
        $nb = $row['akun_namaBelakang'];
        $tl = $row['akun_tanggalLahir'];
        $jk = $row['akun_jenisKelamin'];
        $em = $row['akun_email'];
        $hp = $row['akun_noHP'];
        $bi = $row['akun_deskripsi'];
        $wp = $row['akun_webProfil'];
        // $ = $data8;
        $nf = $row['akun_namaFoto'];
    }

    //cek gambar
    $query = "SELECT akun_namaFoto FROM account WHERE akun_id = '$id'";
    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    //cek password
    $queryPass = "SELECT akun_password FROM account WHERE akun_id = '$id'";
    $result3 = mysqli_query($con, $queryPass);
    $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);

    if (isset($_POST['updt'])) {

    }

    // $q = 0;
?>

<head><title>MUSLIMZ | Account Settings</title></head>

    <main>
    <section class="py-2 my-3">
        <div class="container">
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">

                <!-- tab1 -->
                <div class="tab-content p-4 p-md-5 uy" id="profiles">
                    <h3 class="mb-4">Public Profile Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" id="namadepan" class="form-control" value="<?= $nd; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" id="namabelakang" class="form-control" value="<?= $nb; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Birth Date</label><div data-tip="Format : YEAR-MONTH-DATE">
                                <input type="text" id="tgllahir" class="form-control" value="<?= $tl; ?>"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label><div data-tip="No options, just type your gender">
                                <input type="text" id="jeniskelamin" class="form-control" value="<?= $jk; ?>"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="form-control" id="biografi" maxlength="30" placeholder="Max characters : 30" rows="3"><?= $bi; ?></textarea>
                            </div>
                        </div>
                        <div id="responsefield"></div>
                        <div class="d-flex justify-content-end">
                            <button type="button" onclick="submitText()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update_btn">Update</button>
                        </div>
                    </div>
                </div>

                <!-- tab2 -->
                <div class="tab-content p-4 p-md-5 uy" id="accounts" style="display: none">
                    <h3 class="mb-4">Account Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" disabled="true" value="<?= $user; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" id="email" class="form-control" value="<?= $em; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="text" id="nohp" class="form-control" value="<?= $hp; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Personal Website</label>
                                <input type="text" id="website" class="form-control" value="<?= $wp; ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" onclick="submitText()" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#update_btn">Update</button>
                        </div>
                    </div>
                </div>

                <!-- tab3 -->
                <div class="tab-content p-4 p-md-5 uy" id="passwords" style="display: none">
                    <h3 class="mb-4">Account Settings</h3>
                    <div class="row">
                        <div class="row-md-6">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" onkeyup="success()" id="oldpass" class="form-control" value="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" onkeyup="success()" id="newpass" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" onkeyup="success()" id="pass" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="ss" type="button" onclick="" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#pass_btn" disabled="disabled">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>

<!-- Modal -->
    <div class="modal fade" id="update_btn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Assalamu 'alaykum</h5>
              </div>
              <div class="modal-body">Your profile data has been saved successfully.</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Alhamdulillah</button>
              </div>
            </div>
        </div>
    </div>

    <!-- Modal password-->
    <div class="modal fade" id="pass_btn" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Assalamu 'alaykum</h5>
                </div>
                <div class="modal-body">Pardon me Yaa Akh, but this function is being built</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Understand</button>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/main.js"></script>
    <script type="text/javascript">
        function submitText(){
            var url = "setAcc_edit.php?nd="+document.getElementById("namadepan").value+
            "&nb="+document.getElementById("namabelakang").value+
            "&tl="+document.getElementById("tgllahir").value+
            "&jk="+document.getElementById("jeniskelamin").value+
            "&bi="+document.getElementById("biografi").value+
            "&wp="+document.getElementById("website").value+
            "&em="+document.getElementById("email").value+
            "&hp="+document.getElementById("nohp").value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, false);
            xhr.send(null);
            var response = xhr.response;
            responsefield.innerHTML = response;
        }

        //cek text kosong
        function success() {
            var w, x, y, z; 
            w = document.getElementById("oldpass").value;
            x = document.getElementById("newpass").value;
            y = document.getElementById("pass").value;
            if (w == "" || x == "" || y == "") {
                document.getElementById('ss').disabled = true; 
            } else { 
                document.getElementById('ss').disabled = false;
            }
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

        var q = "<?php echo $q; ?>";

        if(q == 1){
            myFunction();
        }
    </script>
</body>
</html>

<?php

    // include('config.php');
    require_once('sched_done.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];
    $qwe = 1;

    if(isset($_POST['editt'])){
        $id = $_POST['edi'];
        $tr = $_POST['tri'];
        $hb = $_POST['hab'];
        $rw = $_POST['rew'];

        $sql_update = "UPDATE tracker SET tracker_trigger = '$tr', tracker_habit = '$hb', tracker_reward = '$rw' WHERE tracker_id = '$id'";
        mysqli_query($con, $sql_update);
        echo "<script>window.history.pushState('', 'ntol', 'test.php?habit=1');location.reload();</script>";
    }

    //cek gambar
    $query = "SELECT akun_namaFoto FROM account WHERE akun_id = '$id'";
    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    $sqlCheck = "SELECT * FROM tracker WHERE akun_ID = '$id'";
    $result = mysqli_query($con, $sqlCheck);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // $q = 0;
?>

<head>
    <title>MUSLIMZ | Add Hadith</title>
</head>
    <section class="py-2 my-3">
        <div class="container">
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="tab-content p-4 p-md-5 uy">
                    <h3 class="mb-4">Add New Hadith</h3><form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kitab / Book</label>
                                <select id="kitab" class="form-select form-select-md">
                                    <option value="musnad_syafii" selected>Musnad Syafii</option>
                                    <option value="shahih_muslim">Shahih Muslim</option>
                                    <option value="muwatta_malik">Muwatta Malik</option>
                                </select>
                            </div>
                        </div>
                        <div class="row-md-6">
                            <div class="form-group">
                                <label>Arabic</label>
                                <div data-tip="Dalil with Arabic Texts">
                                   <textarea class="form-control" autocomplete="off" id="dalil" onkeyup="success()"  rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row-md-6">
                            <div class="form-group">
                                <label>Translate</label>
                                <div data-tip="Indonesian Translate">
                                    <textarea class="form-control" autocomplete="off" id="terjemah" onkeyup="success()"  rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="button" id="ss" class="btn btn-primary" onclick="submitText()"  data-bs-toggle="modal" data-bs-target="#tambah_sched" disabled="disabled">Add</button> <!--  -->
                    </div></form>
                </div>
                    
                    <div id="responsefield"></div>
                </div>
            </div>
        </div>
    </section>

<!-- Modal -->
    <div class="modal fade" id="tambah_sched" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Assalamu 'alaykum</h5>
              </div>
              <div class="modal-body">A new Hadith added to the database.</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="location.reload();" data-bs-dismiss="modal">Alhamdulillah</button>
              </div>
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script>      
        function submitText(){
            var url = "admin/hadith_add.php?kit="+document.getElementById("kitab").value+
            "&dal="+document.getElementById("dalil").value+
            "&ter="+document.getElementById("terjemah").value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, false);
            xhr.send(null);
            var response = xhr.response;
            responsefield.innerHTML = response;
        }

        function success() {
            var w, x, y, z; 
            w = document.getElementById("kitab").value;
            x = document.getElementById("dalil").value;
            y = document.getElementById("terjemah").value;
            if (w == "" || x == "" || y == "") {
                document.getElementById('ss').disabled = true; 
            } else { 
                document.getElementById('ss').disabled = false;
            }
        }

        var q = "<?php echo $q; ?>";

        if(q==1){
            myFunction();
        }

    </script>

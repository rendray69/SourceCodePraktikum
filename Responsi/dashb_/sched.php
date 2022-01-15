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
    <title>MUSLIMZ | Schedule</title>
</head>
    <section class="py-2 my-3">
        <div class="container">
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="tab-content p-4 p-md-5 uy">
                    <h3 class="mb-4">Habit Tracker</h3><form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trigger</label>
                                <div data-tip="Trigger that would remind you of the habit">
                                    <input type="text" autocomplete="off" onkeyup="success()" id="trigger" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Habit</label>
                                <div data-tip="What a habit like?">
                                    <input type="text" autocomplete="off" onkeyup="success()" id="habit" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Intention</label>
                                <select id="intention" class="form-select form-select-md">
                                    <option value="Spiritual" selected>Spiritual</option>
                                    <option value="Physical">Physical</option>
                                    <option value="Social">Social</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Reward</label>
                                <div data-tip="How will you celebrate if you do this new habit?">
                                    <input type="text" autocomplete="off" onkeyup="success()" id="reward" class="form-control">
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
            <!-- <div class="bg-white shadow rounded-lg d-block d-sm-flex"> -->
                <div class="tab-content py-4 p-md-10 uy" style="overflow:hidden;">
                    <h4 class="mb-1">Update or Delete your habit</h4>
                <?php
                    echo "<div class='xx'>
                <table class='table1' style='margin:auto; width:100%;'>
                    <tr>
                        <th style='width:5%;'>No</th>
                        <th>Trigger</th>
                        <th>Habit</th>
                        <th>Intention</th>
                        <th>Reward</th>
                        <th style='width:20%;'>Action</th>
                    </tr>";
                        $no = 1;
                        foreach ($result as $hasil) :
                    echo "
                        <tr><form id='form1' method='post'>
                            <td>".$no."</td>
                            <td>".$hasil['tracker_trigger']."</td>
                            <td>".$hasil['tracker_habit']."</td>
                            <td>".$hasil['tracker_intention']."</td>
                            <td>".$hasil['tracker_reward']."</td>
                            <td><button type='button' style='outline:none;border: 0;background: none; box-shadow: none;' data-bs-toggle='modal' data-bs-target='#edit_sched".$hasil['tracker_id']."'>
                            <i class='fa fa-pencil' aria-hidden='true'></i></button>
                            <a href='sched_done.php?id=".$hasil['tracker_id']."' class='btn btn-default input-group-addon' role='button'><i class='fa fa-trash' aria-hidden='true'></i></a></td>
                            </div>
                        </tr>";
                        echo '
                        <div class="modal fade" id="edit_sched'.$hasil['tracker_id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update your habit</h5>
                                    </div>

                                    <div class="modal-body">
                                        <form action="#" method="post"><label for="tri">Trigger</label>
                                            <input type="text" class="form-control" name="tri" value="'.$hasil['tracker_trigger'].'"><label for="hab">Habit</label>
                                            <input type="text" class="form-control" name="hab" value="'.$hasil['tracker_habit'].'"><label for="int">Intention</label>
                                            <input type="text" class="form-control" name="int" value="'.$hasil['tracker_intention'].'" disabled="disabled"><label for="rew">Reward</label>
                                            <input type="text" class="form-control" name="rew" value="'.$hasil['tracker_reward'].'"><br/>
                                            <input type="hidden" name="edi" value="'.$hasil['tracker_id'].'">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_sched'.$hasil['tracker_id'].'">Cancel</button>
                                            <input name="editt" value="Update" type="submit" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit_sched'.$hasil['tracker_id'].'">
                                        </form>
                                    </div>
                                </div>
                           
                        </div>';

                    $no++;
                    endforeach;
                    echo "</table></div></div>";
                    // if($qwe == 0)
                    //     include "sched_edit.php";
                  ?>
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
              <div class="modal-body">Your new habit is ready to track.</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="location.reload();" data-bs-dismiss="modal">Alhamdulillah</button>
              </div>
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script>      
        function submitText(){
            var url = "sched_add.php?tr="+document.getElementById("trigger").value+
            "&hb="+document.getElementById("habit").value+
            "&it="+document.getElementById("intention").value+
            "&rw="+document.getElementById("reward").value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, false);
            xhr.send(null);
            var response = xhr.response;
            responsefield.innerHTML = response;
        }

        function success() {
            var w, x, y, z; 
            w = document.getElementById("trigger").value;
            x = document.getElementById("habit").value;
            y = document.getElementById("intention").value;
            z = document.getElementById("reward").value;
            if (w == "" || x == "" || y == "" || z == "" ) {
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

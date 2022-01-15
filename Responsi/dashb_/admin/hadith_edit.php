
<?php

    $count = 501;
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['cari'])){
        $kk = $_POST['katakunci'];

        $cektot = "SELECT COUNT(*) AS tot FROM musnad_syafii where terjemah like '%$kk%'";
        $result1 = mysqli_query($con, $cektot);
        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

        $sqlCheck = "SELECT * FROM musnad_syafii where terjemah like '%$kk%'";
        $result = mysqli_query($con, $sqlCheck);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        mysqli_query($con, "set character_set_server='utf8'");
        mysqli_query($con, "set names 'utf8'");
    }

    if(isset($_POST['editt'])){
        $id = $_POST['edi'];
        $tr = $_POST['tri'];
        $hb = $_POST['hab'];
        $rw = $_POST['rew'];

        $sql_update = "UPDATE musnad_syafii SET kitab = '$tr', arab = '$hb', terjemah = '$rw' WHERE id = '$id'";
        mysqli_query($con, $sql_update);
    }
?>

<!-- <meta http-equiv="content-type" content="text/html; charset=utf-8" /> -->
<div class='form-group mx-sm-3 mb-2 float-kanan'>
    <form action="" method="post">
        <div class="row">
            <label for="katakunci">Search hadith by keywords : </label>
            <div class="col-md-10">
                <input type="text" id="katakunci" onkeyup="cek()" name="katakunci" placeholder="Type Keywords" class="form-control" >
            </div>
            <div class="col-md-2">
                <input id="cari" type="submit" name="cari" onclick="cek()" value="Search"  class="btn btn-secondary" disabled="disabled">
            </div>
        </div>
    </form>
</div>

<?php
    if ($count == 0) {
        echo '<div class="text" style="float:left;"><br><h5>About '.$row1['tot'].' results found</h5></div>';
    }if($count > 0 && $count < 501){        
?>
<div class="ooo">
    <table class="table1">
        <tr>
            <td><div class="text" style="float:left;">Show in <a target="_blank" href="admin/hadis_xml.php?nama=<?=$kk;?>">XML</a> / <a target="_blank" href="admin/hadis_json.php?nama=<?=$kk;?>">JSON</a><br><h5>About <?=$row1['tot'];?> results found</h5></div></td>
            <br>
        </tr> 
        <tr>
            <th class="wid10" style="width:70%;">Book</th>
            <th style="width:10px;">Arabic</th>
            <th>Translate</th>
            <th style='width:20%;'>Action</th>
        </tr>

        <?php
            $no = 1;
            foreach ($result as $hasil) :
        ?>
        <tr style='text-align: justify;'>
            <td><?=$hasil['kitab'];?></td>
            <td><?=$hasil['arab'];?></td>
            <td><?=$hasil['terjemah'];?></td>
            <td><button type="button" style="outline:none;border: 0;background: none; box-shadow: none;" data-bs-toggle="modal" data-bs-target="#edit_sched<?=$hasil['id'];?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i></button>
                            <a href="admin/hadith_del.php?kitab_id=<?=$hasil['id'];?>" class="btn btn-default input-group-addon" role="button"><i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
        </tr>
        <div class="modal fade" id="edit_sched<?=$hasil['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Hadith</h5>
                    </div>

                    <div class="modal-body">
                        <form action="#" method="post"><label for="tri">Kitab / Book</label>
                            <input type="text" class="form-control" name="tri" value="<?=$hasil['kitab'];?>"><label for="hab">Dalil in Arabic</label>
                            <input type="text" class="form-control" name="hab" value="<?=$hasil['arab'];?>"><label for="rew">Translate</label>
                            <input type="text" class="form-control" name="rew" value="<?=$hasil['terjemah'];?>"><br/>
                            <input type="hidden" name="edi" value="<?=$hasil['id'];?>">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_sched<?=$hasil['id'];?>">Cancel</button>
                            <input name="editt" value="Update" type="submit" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit_sched<?=$hasil['id'];?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $no++;
            endforeach;
    }
        ?>   
    </table>
</div>

<script>
    function cek() {
            var w; 
            w = document.getElementById("katakunci").value;
            btn = document.getElementById("cari");
            if (w == "") {
                document.getElementById('cari').disabled = true; 
                btn.classList.remove("btn-outline-success");
                btn.classList.add("btn-secondary");
            } else { 
                document.getElementById('cari').disabled = false;
                btn.classList.add("btn-outline-success");
                btn.classList.remove("btn-secondary");
            }
        }

  element.classList.remove("mystyle");
</script>
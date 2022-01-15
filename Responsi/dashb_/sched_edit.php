
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
        echo '<div class="text" style="float:left;"><br><h5>'.$row1['tot'].' Results related to found</h5></div>';
    }if($count > 0 && $count < 501){        
?>
<div class="ooo">
    <table class="table1">
        <tr>
            <td><div class="text" style="float:left;"><br><h5>About <?=$row1['tot'];?> Results</h5></div></td>
            <br>
        </tr> 
        <tr>
            <th class="wid10" style="width:1%;">Book</th>
            <th style="width:1%;">Arabic</th>
            <th>Translate</th>
        </tr>

        <?php
            $no = 1;
            foreach ($result as $hasil) :
        ?>
        <tr style='text-align: justify;'>
            <td><?=$hasil['kitab'];?></td>
            <td><?=$hasil['arab'];?></td>
            <td><?=$hasil['terjemah'];?></td>
        </tr>
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
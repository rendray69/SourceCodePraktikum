<?php
    // include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];
    $condi_id = $_SESSION['condi'];


    //track habit
    $sqlCheck = "SELECT * FROM tracker WHERE akun_ID = '$id'";
    $result = mysqli_query($con, $sqlCheck);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $test = $_SESSION['loginNadep'];


    // $q = 0;//untuk menampilkan badge merah di notiv
?>

<head>
    <title>MUSLIMZ | Dashboard</title>
</head>
    <!-- main  -->
            
                <?php
                if ($count == 0) {
                    
                        echo "<p class='buatP'>No data yet, <a href='test.php?habit=1'>create a new one</a></p><div class='form-group mx-sm-3 mb-2'>";
                        //include 'sched_edit.php'; 
                        echo "</div>";
                    }
                    else{
                echo "
                <div class='ooo'>
                   <div class='text'><h1>Track Your Habit</h1>
                    Do it for your good, not the points</div>
                   <table class='table1'>
                      <tr>
                         <th style='width:5%;'>No</th>
                         <th>Trigger</th>
                         <th>Habit</th>
                         <th>Intention</th>
                         <th>Reward</th>
                         <th>Check*</th>
                      </tr>";

                        $no = 1;
                        foreach ($result as $hasil) :
                  echo "
                  <tr>
                     <td>".$no."</td>
                     <td>".$hasil['tracker_trigger']."</td>
                     <td>".$hasil['tracker_habit']."</td>
                     <td>".$hasil['tracker_intention']."</td>
                     <td>".$hasil['tracker_reward']."</td>
                     <td>
                     "; 
                     if ($hasil['tracker_check'] == 1) {
                         echo "
                         <div>
                            <a class='btn btn-secondary btn-sm disabled' href='sched_done.php?tracker_id=".$hasil['tracker_id']."' role='button'>&#10004</a>
                        </div>";
                     } else {
                        echo "
                        <div>
                            <a class='btn btn-primary btn-sm' href='sched_done.php?tracker_id=".$hasil['tracker_id']."' role='button'>&#10004</a>
                        </div>";
                     }
                    "
                    </td>
                </tr>";
                        $no++;
                        endforeach;
                        echo "</table>";
                        if ($hasil['tracker_id'] != NULL) {
                            echo '<div class="text"><br>*Reset daily</div>';
                            echo '<div class="link"><a href="print.php?akun_id='.$id.'">Print to PDF file</a></div><br><br>';
                        }
                        //include "sched_edit.php";
                    }
                  ?>
            </div>
            

    <!-- js needed -->
    <script src="../js/main.js"></script>
    <script>
        var q = "<?php echo $q; ?>";
        var w = "<?php echo $quot; ?>";
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

        if(q == 1){
            myFunction();
        }

        if(w == 0){
            myModal.show();
        }
    </script>

    <?php
        $sql_edit = "UPDATE condi SET login_quotes = '1' WHERE condition_id = '$condi_id'";
        mysqli_query($con, $sql_edit);
    ?>
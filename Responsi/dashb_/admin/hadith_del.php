<?php
    if(isset($_GET['kitab_id'])){
        require_once('../config.php');

        $id = $_GET['kitab_id'];

        $sql_hapus = "DELETE FROM musnad_syafii WHERE id = '$id'";
        mysqli_query($con, $sql_hapus);

        header('Location: ../test.php?home=1');
    }
?>
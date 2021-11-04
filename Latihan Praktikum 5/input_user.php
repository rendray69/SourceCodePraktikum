<?php
    include "koneksi.php";
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $sql = "INSERT INTO users(id_user, password, nama_lengkap, email) VALUES ('$id_user', '$pass','$nama','$email')";
    $query=mysqli_query($con, $sql);
    mysqli_close($con);
    var_dump($id_user);
    var_dump($nama);
    var_dump($password);
    var_dump($email);
    header('location:tampil_user.php');
?>
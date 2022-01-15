<?php

    include('dashb_/config.php');

    if (isset($_POST['login'])) {
        $myusername = mysqli_real_escape_string($con, $_POST['username']);
        $mypassword = mysqli_real_escape_string($con, $_POST['password']);

        if ($myusername != "" && $mypassword != "") {
            if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) {
                $sqlLogin = "SELECT * FROM account WHERE akun_username = '$myusername' AND akun_password = '$mypassword'";
                $result = mysqli_query($con, $sqlLogin);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    $_SESSION['loginUser'] = $myusername;
                    $_SESSION['loginPass'] = $mypassword;
                    $_SESSION['loginid'] = $row['akun_id'];
                    $_SESSION['loginNadep'] = $row['akun_namaDepan'];
                    $_SESSION['loginNabel'] = $row['akun_namaBelakang'];
                    $_SESSION['loginTgl'] = $row['akun_tanggalLahir'];
                    $_SESSION['loginJenkel'] = $row['akun_jenisKelamin'];
                    $_SESSION['loginEmail'] = $row['akun_email'];
                    $_SESSION['loginNohp'] = $row['akun_noHP'];
                    $_SESSION['loginDesk'] = $row['akun_deskripsi'];
                    $_SESSION['loginWP'] = $row['akun_webProfil'];
                    // $_SESSION['loginFP'] = $data8;
                    $_SESSION['login'] = $row['akun_namaFoto'];
                    $_SESSION['condi'] = $row['condition_id'];
                    $_SESSION['status'] = $row['status'];

                    echo "<script>window.history.pushState('', 'ntol', 'dashb_/test.php?home=1');location.reload();</script>";

                    var_dump($count);
                }else{
                    echo '<script>';
                    echo 'alert("Username / Password incorrect");';
                    echo '</script>';
                }
            }
        }
    }

    if (isset($_POST['signup'])) {
        $user = $_POST['username2'];
        $pass = $_POST['password2'];
        $ema = $_POST['email'];

        if ($user != "" && $pass != "") {
            $sqlCek = "SELECT * FROM account WHERE akun_username = '$user' OR akun_password = '$pass'";
            $result = mysqli_query($con, $sqlCek);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                echo '<script>';
                echo 'alert("data sudah ada");';
                echo '</script>';
            }else{
                //membuat kondisi
              $check_sqlBool=mysqli_query($con,"SELECT MAX(condition_id) AS id FROM condi");
              $row3 = mysqli_fetch_array($check_sqlBool, MYSQLI_ASSOC);
              $idd3 = $row3['id'];
              if (is_null($idd3)) {
                $idd3 = 1;
              }else{
                $idd3++;
              }
              //jenis_id = 1 : point sign up
              $sql_tambahPoin = "INSERT INTO condi VALUES ('$idd3', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
              mysqli_query($con, $sql_tambahPoin);
              //membuat akun
              $check_sql=mysqli_query($con,"SELECT MAX(akun_id) AS id FROM account");
              $row1 = mysqli_fetch_array($check_sql, MYSQLI_ASSOC);
              $idd1 = $row1['id'];
              if (is_null($idd1)) {
                  $idd1 = 1;
              }else{
                  $idd1++;
              }

              $sql_tambah = "INSERT INTO account (akun_id, akun_username, akun_password, akun_email, akun_namaFoto, condition_ID) VALUES ('$idd1', '$user', '$pass', '$ema', '1.png', $idd3)";
              mysqli_query($con, $sql_tambah);

              $date=date("Y-m-d");
              $time=date("H:m:s");
              $dd=$date." ".$time;

              // header("Location:tampilData.php");
              //untuk menambah point
              $check_sqlPoin=mysqli_query($con,"SELECT MAX(point_id) AS id FROM point");
              $row2 = mysqli_fetch_array($check_sqlPoin, MYSQLI_ASSOC);
              $idd2 = $row2['id'];
              if (is_null($idd2)) {
                $idd2 = 1;
              }else{
                $idd2++;
              }

              //jenis_id = 1 : point sign up
              $sql_tambahPoin = "INSERT INTO point VALUES ('$idd2', '500', '$dd', '500', '1', '$idd1')";
              mysqli_query($con, $sql_tambahPoin);

              //cek avatar
              $check_sqlPoint=mysqli_query($con,"SELECT MAX(transaksi_id) AS id FROM transaksi");
              $row4 = mysqli_fetch_array($check_sqlPoint, MYSQLI_ASSOC);
              $idd4 = $row4['id'];
              if (is_null($idd4)) {
                $idd4 = 1;
              }else{
                $idd4++;
              }

              //tambah notif
              $check_notif=mysqli_query($con,"SELECT MAX(notif_id) AS id FROM notif");
              $row5 = mysqli_fetch_array($check_notif, MYSQLI_ASSOC);
              $idd5 = $row5['id'];
              if (is_null($idd5)) {
                  $idd5 = 1;
              }else{
                  $idd5++;
              }

              $tambah_notif = "INSERT INTO notif VALUES ('$idd5', '$dd','Welcome to the Muslimz, thank you for joining us. We will give you 500 points for creating your first account','0','$idd1')";
              mysqli_query($con, $tambah_notif);

              //tambah avatar
              $sql_tambahAvatar = "INSERT INTO transaksi VALUES ('$idd4', '$idd1', '1', '$dd', '1')";
              mysqli_query($con, $sql_tambahAvatar);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css" />
    <title>Muslimz - Sign Up/Sign In</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="#" method="POST" class="sign-in-form" onsubmit="return checkInputs(this)">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <i class="r fas fa-check-circle"></i>
              <i class="r fas fa-exclamation-circle"></i>
              <input type="text" id="usernamee" name="username" autocomplete="off" placeholder="Username" />
              <small>Error Message</small>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <i class="r fas fa-check-circle"></i>
              <i class="r fas fa-exclamation-circle"></i>
              <input type="password" id="passworde" name="password" placeholder="Password" />
              <small>Error Message</small>
            </div>
              <img src='captcha.php'/>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <i class="r fas fa-check-circle"></i>
              <i class="r fas fa-exclamation-circle"></i>
              <input name='captcha_code' id='captchaa' type='text' placeholder="type the captcha here" autocomplete="off">
              <small>Error Message</small>
            </div>


            <input type="submit" name="login" value="Login" class="btn solid" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="#" method="POST" class="sign-up-form" onsubmit="return checkInputse(this)">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <i class="r fas fa-check-circle"></i>
              <i class="r fas fa-exclamation-circle"></i>
              <input type="text" id="usernameee" name="username2" autocomplete="off" placeholder="Username" />
              <small>Error Message</small>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <i class="r fas fa-check-circle"></i>
              <i class="r fas fa-exclamation-circle"></i>
              <input type="email" id="emaile" name="email" placeholder="Email" />
              <small>Error Message</small>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <i class="r fas fa-check-circle"></i>
              <i class="r fas fa-exclamation-circle"></i>
              <input type="password" id="passwordee" name="password2" placeholder="Password" />
              <small>Error Message</small>
            </div>
            <input type="submit" name="signup" class="btn" value="Sign up" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Plan and Track your own prayers and be a productive Muslim by joining us
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Login - Track your worship - Claim rewards <br>Do it Now! Don't procrastinate
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>

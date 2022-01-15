<?php
    include('config.php');

    if (!isset($_SESSION['loginUser'])) {
        header('Location: ../index.php');
    }

    $id = $_SESSION['loginid'];
    $condi_id = $_SESSION['condi'];
    $status = $_SESSION['status'];

    // tampil quote
    $sqlquot = "SELECT login_quotes FROM condi INNER JOIN account ON account.condition_id = condi.condition_id WHERE account.akun_id = '$id'";
    $query_cetak=mysqli_query($con,$sqlquot);
    $hasil=mysqli_fetch_assoc($query_cetak);
    $quot = $hasil['login_quotes'];

    // me-random quote
    $randlog = "SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
    $result1 = mysqli_query($con, $randlog);
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

    //cek gambar
    $query = "SELECT akun_namaFoto FROM account WHERE akun_id = '$id'";
    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    //untuk menampilkan badge merah di notiv
    $notif = "SELECT * FROM notif WHERE notif_check = '0' AND akun_ID = '$id'";
    $cek_notif = mysqli_query($con, $notif);
    $row3 = mysqli_fetch_array($cek_notif, MYSQLI_ASSOC);
    $count2 = mysqli_num_rows($cek_notif);
    if($count2 > 0)
        $q = 1;
    else
        $q = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f6e7b48ce0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styleindex.css">
</head>
<body>
    <!-- header -->
    <header class="header">
        <div class="header__container">
            <!-- <img src="../img/monke.jpg" alt="" class="header__img"> -->
            <img src="../img/<?php echo $row2['akun_namaFoto']; ?>" alt="" class="header__img">

            <a href="#" class="header__logo">MUSLIMZ</a>

            <!-- <div class="header__search">
                <input type="search" placeholder="Search" class="header__input">
                <i class='bx bx-search header__icon'></i>
            </div> -->

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header>

    <!-- navigation bar -->
    <div class="navi" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="#" class="nav__link nav__logo">
                    <!-- <i class='bx bxs-disc nav__icon' ></i> -->
                    <i class="fas fa-mosque nav__icon"></i>
                    <span class="nav__logo-name">MUSLIMZ</span>
                </a>

                <div class="nav__list">
                    <div class="nav__items">
                        <h3 class="nav__subtitle">Profile</h3>

                        <a href="test.php?home=1" class="nav__link">
                            <i class='bx bxs-home nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <a href="test.php?habit=1" class="nav__link">
                            <i class='bx bx-task nav__icon'></i>
                            <span class="nav__name">Habit Tracker</span>
                        </a>

                        <div class="nav__dropdown">
                            <a class="nav__link"> <!--class= active -->
                                <i class='bx bxs-user nav__icon' ></i>
                                <span class="nav__name">Profile</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon' ></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="test.php?profile=1" class="nav__dropdown-item">Public</a>
                                    <a href="test.php?account=1" class="nav__dropdown-item">Account</a>
                                    <a href="test.php?password=1" class="nav__dropdown-item">Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav__list">
                    <div class="nav__items">
                        <h3 class="nav__subtitle">Menu</h3>

                        <!-- <div class="nav__dropdown"> -->
                        <a href="test.php?notif=1" class="nav__link ">
                            <i class='bx bxs-bell nav__icon notification' >
                                <span id="notif"> </span>
                            </i>
                            <span class="nav__name">Notifications</span>
                            <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon' ></i> -->
                        </a>

                           <!--  <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">Blocked</a>
                                    <a href="#" class="nav__dropdown-item">Silenced</a>
                                    <a href="#" class="nav__dropdown-item">Publish</a>
                                    <a href="#" class="nav__dropdown-item">Program</a>
                                </div>
                            </div> 
                        </div> -->

                        <a href="test.php?point=1" class="nav__link">
                            <i class='fas fa-coins nav__icon' ></i>
                            <span class="nav__name">Points</span>
                        </a>
                        <div class="nav__dropdown">
                            <a class="nav__link">
                                <i class="fas fa-compass nav__icon"></i>
                                <span class="nav__name">Explore</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon' ></i>
                            </a>
                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="test.php?store=1" class="nav__dropdown-item"><button onclick="openCity('stores')" >Store</button></a>
                                    <a href="test.php?member=1" class="nav__dropdown-item"><button onclick="openCity('members')" >Members</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="logout.php" class="nav__link nav__logout">
                <i class='bx bx-log-out nav__icon' ></i>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

<!-- modal -->
    <div class="modal fade" id="Dquote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daily Quotes</h5>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 style="text-align: center;"><?=$row1['quotes_content'];?></h5>
                    <p style="text-align: center;"><?=$row1['quotes_surah'];?> : <?=$row1['quotes_verse'];?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- main  -->
    <main>
        <section>

        <?php
            if($status == "admin"){
                if(isset($_GET['home'])){
                    include "admin.php";
                    include "index.php";
                    include "admin/hadith_edit.php";
                    
                }
                if(isset($_GET['hadis'])){
                    include "admin/hadith.php";
                }
            }else{
                if(isset($_GET['home'])){
                    include "index.php";
                    include "sched_edit.php";
                }
            }
            if(isset($_GET['habit'])){
                include "sched.php";
            }
            if(isset($_GET['profile'])){
                include "setAcc.php";
                echo"<script>openCity('profiles')</script>";
            }
            if(isset($_GET['account'])){
                include "setAcc.php";
                echo"<script>openCity('accounts')</script>";
            }
            if(isset($_GET['password'])){
                include "setAcc.php";
                echo"<script>openCity('passwords')</script>";
            }
            if(isset($_GET['notif'])){
                include "notif.php";
            }
            if(isset($_GET['point'])){
                include "point.php";
            }
            if(isset($_GET['store'])){
                include "explore.php";
                echo"<script>openCity('stores')</script>";
            }
            if(isset($_GET['member'])){
                include "explore.php";
                echo"<script>openCity('members')</script>";
            }
            
        ?>

        </section>
    </main>

    <!-- js needed -->
    <script src="../js/main.js"></script>
    <script>
        var q = "<?php echo $q; ?>";
        var w = "<?php echo $quot; ?>";
        var myModal = new bootstrap.Modal(document.getElementById('Dquote'));

        function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("uy");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }

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
</body>
</html>
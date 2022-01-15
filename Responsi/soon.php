<?php
if (isset($_POST['subs'])) {

    $headers = "From: YOUR_NAME <yudadiningrat1900018014@webmail.uad.ac.id> \r\n";

    $to = $_POST['email'];
    var_dump($to);

    $subject = "sending emails with php";

    $message = "Sending emails using php\n\n";
    $message .= "Even send custom multi line emails? Tell me more!";

    if (mail($to, $subject, $message, $headers))
    {
        $message = "success";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else
    {
        $message = "usuccessful";
        echo "<script type='text/javascript'>alert('$message');</script>";
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | MUSLIMZ</title>
    <link rel="stylesheet" href="css/soon.css">
</head>
<body>
    <div class="overlay">
    </div>
    <img>
    <div class="wrapper">
        <div class="title">Our Website is <span>Coming soon</span>, follow us <br>for update now!</div>
        <form action="#" class="form" method="POST">
            <div class="email-field">
                <input type="email" autocomplete="off" name="email" placeholder="Enter Email">
                <input class="button" type="submit" name="subs" value="Subscribe">
            </div>
        </form>
        <div class="count-down">
            <div class="timer day">
                <div class="count">
                    <div class="numb">00</div>
                    <div class="text">Days</div>
                </div>
            </div>
            <div class="clone">:</div>
            <div class="timer hour">
                <div class="count">
                    <div class="numb">00</div>
                    <div class="text">Hours</div>
                </div>
            </div>
            <div class="clone">:</div>
            <div class="timer min">
                <div class="count">
                    <div class="numb">00</div>
                    <div class="text">Minutes</div>
                </div>
            </div>
            <div class="clone">:</div>
            <div class="timer sec">
                <div class="count">
                    <div class="numb">00</div>
                    <div class="text">Seconds</div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const day = document.querySelector(".day .numb");
        const hour = document.querySelector(".hour .numb");
        const min = document.querySelector(".min .numb");
        const sec = document.querySelector(".sec .numb");
        var timer = setInterval(() => {
            var currentDate = new Date().getTime();
            var launchDate = new Date('Jun 10, 2021 13:00:00').getTime();
            var duration = launchDate - currentDate;
            var days = Math.floor(duration / (1000 * 60 * 60 * 24));
            var hours = Math.floor((duration % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((duration % (1000 * 60 )) / 1000);
            day.innerHTML = days;
            hour.innerHTML = hours;
            min.innerHTML = minutes;
            sec.innerHTML = seconds;
            if(days < 10){
                day.innerHTML = '0'+ days;
            }
            if(hours < 10){
                hour.innerHTML = '0'+ hours;
            }
            if(minutes < 10){
                min.innerHTML = '0'+ minutes;
            }
            if(seconds < 10){
                sec.innerHTML = '0'+ seconds;
            }
            if (duration < 0) {
                clearInterval(timer);
            }
        });
    </script>
</body>
</html>

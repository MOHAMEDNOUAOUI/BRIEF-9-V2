<?php
require '../CONTROLER/SCORE_CONTROLER.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <!-- <div class="videocontainer">
        <video autoplay loop muted plays-inline type="video/mp4" controls class="background-video">
            <source src="./IMGS/Sea of Stars - PlayStation Demo Now Available!.mp4">
        </video>
    </div> -->

    <div></div>

    <!--PROGRESS BAR -->
    <div class="BIG d-flex justify-content-center align-items-center">
      <div id="text" class="position-absolute">QUIZZ <br>CODE X</div>
        <div id="topbar" class="topbar position-relative d-flex justify-content-center d-none">
            <div id="progress" class="pro postion-relative">
            <h2 id="score" class="score position-absolute">score : 0</h2>
              <h2 class="progress-title position-absolute">QUIZZ PROGRESS</h2>
                <div class="progress">
                    <div class="progress-fill"></div>
                    <h5 class="progress-text text-black">0%</h5>
                </div>
                <div id="page" class="page position-absolute">1/10</div>
            </div>

            
        </div>


        <main class="main d-flex flex-column justify-content-center align-items-center">

            <div class="reply h-75 d-flex position-relative d-flex flex-column align-items-center">
                <h3 class="position-absolute text-center d-flex align-items-center justify-content-center QUIZZ">QUIZZ GAME</h3>
                

                <div class="right w-75">
                    <img src="./IMGS/X9Yj.gif" class="w-100" alt="quizzer profile">
                </div>


                <div class="left d-flex flex-column w-75 px-0 mx-0 align-items-center justify-content-center">
                    <form action="" id="myForm" class="d-flex flex-column justify-content-center align-items-center"> 
                    <div class="marquee-placeholder">
                        <input type="text" class="text-center" required name="PLAYERNAME" style="width:17rem;height:2rem" id="PLAYERNAME" placeholder="Player Name">
                        <marquee class="img" direction="right">
                            <img width="30px" src="./IMGS/cristian-resendiz-run-rhyme-run-big.gif" alt="">
                        </marquee>
                    </div>


                    <div class="d-flex w-100 mt-1 gap-1 align-items-center justify-content-center">
        <!-- <img type="submit" id="ENTER"  name="ENTER" style="width:8rem" src="./IMGS/START2.png" alt="">
        <img type="submit" src="./IMGS/SCOREBOARD2.png" class="scoreboard" onclick="scoreboard ()" style="width:14rem" alt=""> -->
        <div type="submit" id="ENTER"  name="ENTER" style="width:8rem" class="btn enter btn-dark">START</div>
        <div type="submit" onclick="scoreboard ()" style="width:8.5rem" class="btn scoreboard btn-dark">SCOREBOARD</div>
        </div> 

                    </form> 
                </div> 
            </div>

        </main>
    </div>




    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
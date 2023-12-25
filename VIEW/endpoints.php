<?php
require '../CONTROLER/QUEST_controler.php';
require '../CONTROLER/SCORE_CONTROLER.php';
if(isset($_SESSION['score'])) {
    if(isset($_SESSION['WRONGQUESTIONSID'])) {
        $wronganswer = count($_SESSION['WRONGQUESTIONSID']);
    }
    else {
        $wronganswer = 0;
    }

    $scoreclass = $score_player_id->scoreclass();
    $scoreclass->last_id_insert_score ();

    $totalcorrect = 10 - count($_SESSION['WRONGQUESTIONSID']);

    $percentage =($totalcorrect/10) * 100;

    if($percentage >= 70) {
        ?>
        <div class="d-flex flex-column">
        <h1><?php echo $percentage."%"?></h1>
        <h3>CONGRATULATIONSS <?php echo $_SESSION['name']?></h3>
        <p>YOU HAVE COMPLETED THE QUIZZ</p>
        </div>
        <?php
    }
    else {
            ?>
            <div class="d-flex flex-column">
            <h1><?php echo $percentage."%"?></h1>
            <h3>SORRY <?php echo $_SESSION['name']?>!!!</h3>
            <h4>BETTER LUCK NEXT TIME</h4>
            </div>
            <?php
    }

    ?>
        <div class="d-flex">
        <img src="./IMGS/PLAY.png" class="PLAY" style="width:6.4rem" onclick="load ()" type="submit" alt="">
        <img type="submit" src="./IMGS/SCOREBOARD.png" class="scoreboard" onclick="scoreboard ()" style="width:10rem" alt="">
        <img src="./IMGS/CORRECTION.png" class="correction" onclick="correction()" style="width:10rem" alt="">
        </div>
    <?php

}
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
            <div class="d-flex flex-column align-items-center justify-content-center">
            
            <h2 class="d-flex align-items-center justify-content-center" style="background:white;width:200px;height:200px;border-radius:1000px;font-size:5rem"><?php echo $percentage."%"?></h2>
            <div class="py-2 d-flex flex-column align-items-center justify-content-center" style="width:40vw;background:white">
            <h2>SCORE : <?php echo $_SESSION['score']?></h2>
            <h3>SORRY <?php echo $_SESSION['name']?>!!!</h3>
            <h4>BETTER LUCK NEXT TIME</h4>
            </div>
            </div>
            
    
            <?php
    }

    ?>
        <div class="d-flex gap-3 mt-2">
        <div type="submit" onclick="load()" style="width:8rem" class="pt btn enter btn-light">START</div>
        <div type="submit" onclick="scoreboard ()" style="width:8.5rem" class="pt btn scoreboard btn-light">SCOREBOARD</div>
        <div type="submit" class="pt scoreboard btn btn-dark correction" onclick="correction()">CORRECTION</div>
        </div>
    <?php

}
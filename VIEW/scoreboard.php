<?php
require '../MODULES/SCORE.php';
$scoreclass = new SCORE();
$scoreclass->setUserId(session_id());
$scores = $scoreclass->get_all_user_scores();
?>
<div class="d-flex flex-column w-100 align-items-center justify-content-center">
<table class="table w-50">
<thead>
    <tr>
        <th scope="col">USERNAME</th>
        <th scope="col">SCORE</th>
    </tr>
</thead>
<tbody>
<?php

foreach($scores as $score) {
    ?>
    <tr>
        <th scope="col"><?php echo $score->getUserName()?></th>
        <th><?php echo $score->getUserScore()." POINT"?></th>
    </tr>
    <?php
 }
?>
</tbody>
</table>
<div class="d-flex gap-2">
<div type="submit" id="ENTER"  name="ENTER" onclick="load()" style="width:8rem" class="pt btn enter btn-light">START</div>
<?php
if(isset($_SESSION['WRONGQUESTIONSID'])) {
    ?>
     <div type="submit" onclick="correction()" style="width:8rem" class="pt btn enter btn-light">CORRECTION</div>
     <div type="submit" onclick="endpoint()" style="width:8rem" class="pt btn enter btn-light">RESULT</div>
    <?php
}
?>
</div>
</div>

<?php


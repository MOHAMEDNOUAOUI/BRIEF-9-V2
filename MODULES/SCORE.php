<?php
require_once 'CONNECTION.php';

class SCORE {
    private $db;
    private $user_id;
    private $user_name;
    private $user_score;

    public function __construct() {
        $this->db = DATABASE::getconnection();
    }

    // Setter methods (mutators)
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setUserName($user_name) {
        $this->user_name = $user_name;
    }

    public function setUserScore($user_score) {
        $this->user_score = $user_score;
    }

    // Getter methods (accessors)
    public function getUserId() {
        return $this->user_id;
    }

    public function getUserName() {
        return $this->user_name;
    }
    public function getUserScore() {
        return $this->user_score;
    }


    public function insert_score () {
        $inser = $this->db->prepare("INSERT INTO score (user_id,user_name) VALUES (:userID,:userNAME)");
        $inser->bindValue(':userID' , $this->getUserId() , PDO::PARAM_STR);
        $inser->bindValue(':userNAME' , $this->getUserName() , PDO::PARAM_STR);
        $inser->execute();

        $_SESSION['iduser'] = $this->db->lastInsertId();
    }

    public function get_all_user_scores() {
        $iduser = $this->getUserId();
        $fetch = $this->db->prepare('SELECT * FROM score ORDER BY ID DESC LIMIT 5');
        $fetch->execute();
        $result = $fetch->fetchAll(PDO::FETCH_ASSOC);
        $array = [];
        foreach($result as $row) {
            $score = new SCORE();
            $score->setUserId($row['user_id']);
            $score->setUserName($row['user_name']);
            $score->setUserScore($row['user_score']);
            $array [] = $score;
        }
        return $array;
    } 

    public function last_id_insert_score () {
        $lastid = $_SESSION['iduser'];
        $update = $this->db->prepare("UPDATE score SET user_score = :score WHERE ID = :id AND user_name = :name");
        $update->bindValue(':score' , $_SESSION['score'] , PDO::PARAM_INT);
        $update->bindValue(':id' , $lastid , PDO::PARAM_STR);
        $update->bindValue(':name' , $_SESSION['name'] , PDO::PARAM_STR);
        $update->execute();
    }

}


?>
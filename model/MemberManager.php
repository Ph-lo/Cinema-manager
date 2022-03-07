<?php

require_once('model/Manager.php');

class MemberManager extends Manager {

    public function getMembers($search, $limit = null, $page = null) {
        $array = [];
        $likeName = "%" . $search . "%";

        if(empty($limit) || $limit == 0 || $limit == null){
            $limit = 20;
        }

        if (empty($page) || $page == 0 || $page == null) {
		    $page = 1;
		}

        $db = $this->dbConnect();
        $pagination =  $db->prepare('SELECT COUNT(*) AS total_nbr FROM user u INNER JOIN membership m ON u.id = m.id_user INNER JOIN subscription s ON m.id_subscription = s.id AND (CONCAT(u.firstname, " ", u.lastname) LIKE :searchedName OR CONCAT(u.lastname, " ", u.firstname) LIKE :searchedName)');
        $pagination->execute(array('searchedName' => $likeName));
        $read = $pagination->fetch();
        $page_nbr = ceil($read['total_nbr'] / $limit);
        $array[] = $page_nbr;

        $query = $db->prepare(
            'SELECT u.id AS userId, u.firstname, u.lastname, u.email, u.birthdate, u.address, u.country, m.id AS mId, s.name, s.duration 
            FROM user u 
            INNER JOIN membership m ON u.id = m.id_user 
            INNER JOIN subscription s ON m.id_subscription = s.id 
            WHERE (CONCAT(u.firstname, " ", u.lastname) LIKE :searchedName OR CONCAT(u.lastname, " ", u.firstname) LIKE :searchedName) 
            ORDER BY u.firstname 
            LIMIT ' . ($page-1)*$limit .','. $limit);
        $query->execute(array('searchedName' => $likeName));

        array_push($array, $query, $search, $limit);

        return $array;
    }

    public function getUsers($search, $limit = null, $page = null){
        $likeName = '%' . $search . '%';
        $array = [];
        if(empty($limit) || $limit == 0 || $limit == null){
            $limit = 20;
        }

        if (empty($page) || $page == 0 || $page == null) {
		    $page = 1;
		}

        $db = $this->dbConnect();

        // $req = "SELECT u.firstname FROM user u LEFT JOIN membership m ON u.id = m.id_user WHERE m.id_user is null ORDER BY u.firstname";

        $pagination =  $db->prepare(
            'SELECT COUNT(*) AS total_nbr 
            FROM user u 
            LEFT JOIN membership m ON u.id = m.id_user
            WHERE m.id_user is null
            AND (CONCAT(u.firstname, " ", u.lastname) 
            LIKE :searchedName 
            OR CONCAT(u.lastname, " ", u.firstname) 
            LIKE :searchedName)');
        $pagination->execute(array('searchedName' => $likeName));
        $read = $pagination->fetch();
        $page_nbr = ceil($read['total_nbr'] / $limit);
        $array[] = $page_nbr;
        $query = $db->prepare(
            'SELECT u.id, u.firstname, u.lastname, u.email, u.birthdate, u.address, u.city, u.country 
            FROM user u 
            LEFT JOIN membership m ON u.id = m.id_user
            WHERE m.id_user is null
            AND (CONCAT(u.firstname, " ", u.lastname) 
            LIKE :searchedName 
            OR CONCAT(u.lastname, " ", u.firstname) 
            LIKE :searchedName) ORDER BY u.firstname 
            LIMIT ' . ($page-1)*$limit .','. $limit);
        $query->execute(array('searchedName' => $likeName));
        array_push($array, $query, $search, $limit);

        return $array;
    }

    public function getUserInfos($uid){
        $db = $this->dbConnect();
        $query = $db->prepare('SELECT u.id, u.firstname, u.lastname, u.email, u.birthdate, u.address, u.city, u.country FROM user u WHERE u.id = :userId');
        $query->execute(array('userId' => $uid));

        return $query;
    }

    public function getMemberInfos($uid){
        $db = $this->dbConnect();
        $query = $db->prepare('SELECT u.id AS userId, u.firstname, u.lastname, u.email, u.birthdate, u.address, u.country, s.name, s.price, s.duration, s.reduction FROM user u INNER JOIN membership m ON u.id = m.id_user INNER JOIN subscription s ON m.id_subscription = s.id AND u.id = :userId');
        $query->execute(array('userId' => $uid));

        return $query;
    }

    public function modifyMembership($type, $price, $duration, $reduction, $uid){
        if($type == 'VIP'){
            $idSub = 1;
        } elseif($type == 'GOLD'){
            $idSub = 2;
        } elseif($type == 'Classic'){
            $idSub = 3;
        } elseif($type == 'Pass Day'){
            $idSub = 4;
        }

        $db = $this->dbConnect();
        // $sql = 'UPDATE s SET s.name = :mType, s.price = :price, s.duration = :duration, s.reduction = :reduction FROM subscription s INNER JOIN membership m ON m.id_subscription = s.id INNER JOIN user u ON u.id = m.id_user WHERE u.id = :userId';
        $query = $db->prepare("UPDATE subscription AS s INNER JOIN membership AS m ON m.id_subscription = s.id INNER JOIN user AS u ON u.id = m.id_user SET s.name = :mType, s.price = :price, s.duration = :duration, s.reduction = :reduction WHERE u.id = :userId");
        // $query = $db->prepare('UPDATE s SET s.name = :mType, s.price = :price, s.duration = :duration, s.reduction = :reduction FROM subscription s INNER JOIN membership m ON m.id_subscription = s.id INNER JOIN user u ON u.id = m.id_user WHERE u.id = :userId');
        $query->execute(array('mType' => $type, 'price' => $price, 'duration' => $duration, 'reduction' => $reduction, 'userId' => $uid));

        $query = $db->prepare("UPDATE membership AS m INNER JOIN subscription AS s ON m.id_subscription = s.id INNER JOIN user AS u ON u.id = m.id_user SET m.id_subscription = :idSub WHERE u.id = :userId");
        $query->execute(array('idSub' => $idSub, 'userId' => $uid));
        // return $query;
    }

    public function deleteMembership($uid){
        $db = $this->dbConnect();
        
        $query = $db->prepare('DELETE m FROM membership m INNER JOIN subscription s ON s.id = m.id_subscription WHERE m.id_user = :userId');
        $query->execute(array('userId' => $uid));
        
    }

    public function addMembership($uid, $membership, $price, $duration, $reduction){
        if($membership == 'vip'){
            $subId = 1;
            $descSub = 'Le mois tout compris';
        } elseif($membership == 'gold'){
            $subId = 2;
            $descSub = "L'annee complete";
        } elseif($membership == 'classic'){
            $subId = 3;
            $descSub = 'Abonnement mensuel classique';
        } elseif($membership == 'passday'){
            $subId = 4;
            $descSub = 'Pass valable une journee';
        }

        $db = $this->dbConnect($uid, $membership, $price, $duration, $reduction);

        $query = $db->prepare('INSERT INTO membership(id_user, id_subscription, date_begin) VALUES (:userId, :idSub, NOW())');
        $query->execute(array('userId' => $uid, 'idSub' => $subId));

        $query = $db->prepare('INSERT INTO subscription(name, description, price, duration, reduction) VALUES (:subName, :descSub, :price, :duration, :reduction');
        $query->execute(array('subName' => $membership, 'descSub' => $descSub, 'price' => $price, 'duration' => $duration, 'reduction' => $reduction));
    }

}
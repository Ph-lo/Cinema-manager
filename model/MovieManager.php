<?php

require_once('model/Manager.php');

class MovieManager extends Manager {

    public function getMovieResults($title = null, $genre = null, $distributor = null, $limit = null, $page = null) {
        $array = [];
        $likeTitle = "%" . $title . "%";
        $likeDistrib = "%" . $distributor . "%";
        $likeGenre = "%" . $genre . "%";

        if(empty($limit) || $limit == 0 || $limit == null){
            $limit = 20;
        }

        if (empty($page) || $page == 0 || $page == null) {
		    $page = 1;
		}

        if(empty($distributor) || (!empty($distributor) && !empty($title))){
            $firstSort = 'm.title';
            $secondSort = 'd.name';
        } else {
            $firstSort = 'd.name';
            $secondSort = 'm.title';
        }

        $db = $this->dbConnect();
        $pagination =  $db->prepare('SELECT COUNT(*) AS total_nbr FROM movie m INNER JOIN movie_genre a ON m.id = a.id_movie INNER JOIN genre g ON g.id = a.id_genre INNER JOIN distributor d ON m.id_distributor = d.id AND g.name LIKE :genre AND m.title LIKE :title AND d.name LIKE :distrib');
        $pagination->execute(array('genre' => $likeGenre, 'title' => $likeTitle, 'distrib' => $likeDistrib));
        $read = $pagination->fetch();
        $page_nbr = ceil($read['total_nbr'] / $limit);
        $array[] = $page_nbr;

        $query = $db->prepare('SELECT m.id AS movieId, m.id_distributor, m.title, m.director, m.duration, m.release_date, m.rating, a.id_movie, a.id_genre, g.id, g.name AS genre_name, d.id, d.name 
        FROM movie m 
        INNER JOIN movie_genre a ON m.id = a.id_movie 
        INNER JOIN genre g ON g.id = a.id_genre 
        INNER JOIN distributor d ON m.id_distributor = d.id 
        AND g.name LIKE :genre AND m.title LIKE :title 
        AND d.name LIKE :distrib 
        ORDER BY ' . $firstSort . ', ' . $secondSort . ' LIMIT ' . ($page-1)*$limit .','. $limit);
        $query->execute(array('genre' => $likeGenre, 'title' => $likeTitle, 'distrib' => $likeDistrib));

        array_push($array, $query, $title, $genre, $distributor, $limit);
        return $array;

    }

    public function getMovieSchedule($date, $limit = null, $page = null){
        $likeDate = '%' . $date . '%';

        if(empty($limit) || $limit == 0 || $limit == null){
            $limit = 20;
        }

        if (empty($page) || $page == 0 || $page == null) {
		    $page = 1;
		}

        $db = $this->dbConnect();
        $pagination =  $db->prepare('SELECT COUNT(*) AS total_nbr FROM room r INNER JOIN movie_schedule s ON r.id = s.id_room INNER JOIN movie m ON m.id = s.id_movie AND s.date_begin LIKE :dateSearched');
        $pagination->execute(array('dateSearched' => $likeDate));
        $read = $pagination->fetch();
        $page_nbr = ceil($read['total_nbr'] / $limit);
        $array[] = $page_nbr;

        $query = $db->prepare('SELECT m.title, m.director, m.duration, m.rating, r.name AS roomName, s.id AS schId, s.date_begin, g.name AS genreName FROM room r INNER JOIN movie_schedule s ON r.id = s.id_room INNER JOIN movie m ON m.id = s.id_movie INNER JOIN movie_genre a ON m.id = a.id_movie INNER JOIN genre g ON g.id = a.id_genre AND s.date_begin LIKE :dateSearched ORDER BY s.date_begin LIMIT ' . ($page-1)*$limit .','. $limit);
        $query->execute(array('dateSearched' => $likeDate));
        $array[] = $query;
        $array[] = $date;
        $array[] = $limit;

        return $array;

    }

    public function setSchedule($id, $room, $time) {
        $db = $this->dbConnect();
        $query = $db->prepare('INSERT INTO movie_schedule (id_movie, id_room, date_begin) VALUES (:id, :room, :schedule)');
        $query->execute(array('id' => $id, 'room' => $room, 'schedule' => $time));
    }

    public function getMemberHistory($uid, $page = null, $limit = 20) {
        if (empty($page) || $page == 0 || $page == null) {
		    $page = 1;
		}
        
        $db = $this->dbConnect();
        $pagination = $db->prepare('SELECT COUNT(*) AS total_nbr FROM membership_log ml INNER JOIN movie_schedule ms ON ml.id_session = ms.id INNER JOIN membership m ON ml.id_membership = m.id INNER JOIN user u ON m.id_user = u.id INNER JOIN movie mo ON ms.id_movie = mo.id WHERE u.id = :userId');
        $pagination->execute(array('userId' => $uid));
        $read = $pagination->fetch();
        $page_nbr = ceil($read['total_nbr'] / $limit);
        $array[] = $page_nbr;

        $query = $db->prepare('SELECT ms.date_begin, mo.title, mo.duration, mo.rating FROM membership_log ml INNER JOIN movie_schedule ms ON ml.id_session = ms.id INNER JOIN membership m ON ml.id_membership = m.id INNER JOIN user u ON m.id_user = u.id INNER JOIN movie mo ON ms.id_movie = mo.id WHERE u.id = :userId LIMIT ' . ($page-1)*$limit .','. $limit);
        $query->execute(array('userId' => $uid));
        $array[] = $query;
        $array[] = $uid;

        return $array;
    }

    public function addToHistory($membershipId, $scheduleId) {
        $db = $this->dbConnect();
        $query = $db->prepare('INSERT INTO membership_log (id_membership, id_session) VALUES (:membershipId, :sessionId)');
        $query->execute(array('membershipId' => $membershipId, 'sessionId' => $scheduleId));
    }
}
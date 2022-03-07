<?php

require_once('model/MovieManager.php');
require_once('model/MemberManager.php');
require_once('model/AdminManager.php');

function searchMoviesPage() {
    require('view/search_movies_view.php');
}
function searchMembersPage() {
    require('view/search_members_view.php');
}
function addSchedulePage() {
    require('view/add_schedule_view.php');
}

function searchMovie($title = null, $genre = null, $distributor = null, $limit = null, $page = null) {
    $cinemaManager = new MovieManager;
    
    $movies = $cinemaManager->getMovieResults($title, $genre, $distributor, $limit, $page);

    require('view/movieResultsView.php');
}

function searchMovieSchedule($date, $limit = null, $page = null) {
    $cinemaManager = new MovieManager;
    $movies = $cinemaManager->getMovieSchedule($date, $limit, $page);

    require('view/movieScheduleView.php');
}

function searchMember($search, $limit = null, $page = null) {
    $memberManager = new MemberManager;
    $members = $memberManager->getMembers($search, $limit, $page);

    require('view/memberResultsView.php');
}

function searchUser($search, $limit = null, $page = null) {
    $memberManager = new MemberManager;
    $users = $memberManager->getUsers($search, $limit, $page);
    // var_dump($users);
    require('view/userResultsView.php');
}

function getMemberForm($uid) {
    $memberManager = new MemberManager;
    $member = $memberManager->getMemberInfos($uid);

    require('view/memberView.php');
}

function getUserForm($uid) {
    $memberManager = new MemberManager;
    $user = $memberManager->getUserInfos($uid);

    require('view/userView.php');
}

function sendMembershipModif($type, $price, $duration, $reduction, $uid) {
    $memberManager = new MemberManager;
    $memberManager->modifyMembership($type, $price, $duration, $reduction, $uid);
    $member = $memberManager->getMemberInfos($uid);
    // var_dump($type);
    header('Location: index.php?page=modifyMember&uid='.$uid.'&modified=true');   
}

function deleteMbrship($uid) {
    $memberManager = new MemberManager;
    $memberManager->deleteMembership($uid);
    // echo $uid;
    header('Location: index.php?page=members');
}

function addUserMembership($uid, $membership, $price, $duration, $reduction) {
    $memberManager = new MemberManager;
    $memberManager->addMembership($uid, $membership, $price, $duration, $reduction);

    header('Location: index.php?page=modifyMember&uid='.$uid.'&modified=true');
}

function getScreeningForm($id, $title) {
    require('view/scheduleView.php');
}

function addScreening($id, $room, $time) {
    $movieManager = new MovieManager;
    $movieManager->setSchedule($id, $room, $time);

    header('Location: index.php');
}

function memberHistory($uid, $page = null) {
    $movieManager = new MovieManager;
    $members = $movieManager->getMemberHistory($uid, $page);
    // echo $uid;

    require('view/memberHistoryView.php');
}

function getHistoryForm($uid) {
    require('view/addToHistory.php');
}

function addEntryToHistory($memberId, $scheduleId) {
    $movieManager = new MovieManager;
    $movieManager->addToHistory($memberId, $scheduleId);

    // echo $memberId . ' ' . $scheduleId;
    header('Location: index.php?page=memberHistory&mid='. $_GET['mid'] .'&sid='. $_GET['schId'] .'&uid='. $_GET['uid'] .'&f='. $_GET['f'] .'&l='.$_GET['l']);
}

function connection() {
    require('view/connection.php');
}

function connect($login, $pass) {
    $adminManager = new AdminManager;
    $adminManager->adminConnect($login, $pass);

    require('view/adminView.php');
}

function farewell() {
    $adminManager = new AdminManager;
    $adminManager->bye();
}
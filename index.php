<?php
session_start();

require('controller/controller.php');

try {
    if(isset($_GET['page'])){
        if($_GET['page'] == 'movies'){
            searchMoviesPage();
        } elseif($_GET['page'] == 'members'){
            searchMembersPage();
        } elseif($_GET['page'] == 'schedule'){
            addSchedulePage();
        } elseif($_GET['page'] == 'searchMovie'){
            
            searchMovie($_POST['movie_input'], $_POST['genre_input'], $_POST['distributor_input'], $_POST['number_limit']);
            
        } elseif($_GET['page'] == 'searchByDate'){
            searchMovieSchedule($_POST['date_input'],$_POST['nbr_limit']);
        } elseif($_GET['page'] == 'searchMember'){
            searchMember($_POST['member_input'], $_POST['number_limit']);
        } elseif($_GET['page'] == 'modifyMember'){
            getMemberForm($_GET['uid']);
        } elseif($_GET['page'] == 'applyModification'){
            sendMembershipModif($_POST['subName'], $_POST['subPrice'], $_POST['subDuration'], $_POST['subReduction'], $_GET['uid']);
        } elseif($_GET['page'] == 'deleteMembership') {
            deleteMbrship($_GET['uid']);
        } elseif($_GET['page'] == 'searchUser'){
            searchUser($_POST['user_input'], $_POST['nbr_limit'], $_POST['page']);
        } elseif($_GET['page'] == 'addMembership') {
            getUserForm($_GET['uid']);
        } elseif($_GET['page'] == 'setMembership') {
            addUserMembership($_GET['uid'], $_POST['membership'], $_POST['subPrice'], $_POST['subDuration'], $_POST['subReduction']);
        } elseif($_GET['page'] == 'addScreening'){
            getScreeningForm($_GET['id'], $_GET['title']);
        } elseif($_GET['page'] == 'newScreening'){
            addScreening($_GET['id'], $_POST['rooms'], $_POST['datetime']);
        } elseif($_GET['page'] == 'memberHistory'){
            memberHistory($_GET['uid']);
        } elseif($_GET['page'] == 'addToHistory'){
            getHistoryForm($_GET['uid']);
        } elseif($_GET['page'] == 'addEntry') {
            addEntryToHistory($_GET['mid'], $_GET['sid']);
        } elseif($_GET['page'] == 'connection') {
            connection();
        } elseif($_GET['page'] == 'connect') {
            connect($_POST['login'], $_POST['password']);
        } elseif($_GET['page'] == 'adios' && isset($_SESSION['admin'])) {
            farewell();
        } 
    } elseif(isset($_GET['p'], $_GET['title'], $_GET['genre'], $_GET['distributor'], $_GET['limit'])) {
        searchMovie($_GET['title'], $_GET['genre'], $_GET['distributor'], $_GET['limit'], $_GET['p']);
    } elseif(isset($_GET['ps'], $_GET['search'], $_GET['limit'])){
        searchMovieSchedule($_GET['search'], $_GET['limit'], $_GET['ps']);
    } elseif(isset($_GET['pm'], $_GET['search'], $_GET['limit'])){
        searchMember($_GET['search'], $_GET['limit'], $_GET['pm']);
    } elseif($_GET['pu']) {
        searchUser($_GET['search'], $_GET['limit'], $_GET['pu']);
    } elseif($_GET['ph']){
        memberHistory($_GET['uid'], $_GET['ph']);
    } else {
        searchMoviesPage();
    }

} catch(Exception $e) {
    echo 'Error : ' . $e->getMessage();
}
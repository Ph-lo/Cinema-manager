<?php

ob_start();
?>

<form class="forms" action="index.php?page=searchMovie" method="POST">
    <div class="search_title">
        <img src="public/icons/film-reel.png" alt="film-reel icon" />
        <h4>By title, genre or distributor</h4>
    </div>
    <label for="movie_input">Title : </label>
    <input type="text" name="movie_input" id="movie_input" /><br />
    <label for="genre_input">Genre : </label>
    <select name="genre_input" id="genre_input">
        <option value="">--</option>
        <option value="action">Action</option>
        <option value="adventure">Adventure</option>
        <option value="animation">Animation</option>
        <option value="biography">Biography</option>
        <option value="comedy">Comedy</option>
        <option value="crime">Crime</option>
        <option value="drama">Drama</option>
        <option value="family">Family</option>
        <option value="fantasy">Fantasy</option>
        <option value="horror">Horror</option>
        <option value="mystery">Mystery</option>
        <option value="romance">Romance</option>
        <option value="scifi">Sci-Fi</option>
        <option value="thriller">Thriller</option>
    </select><br />
    <label for="distributor_input">Distributor : </label>
    <input type="text" name="distributor_input" id="distributor_input" /><br />
    <label for="4">Number per page : </label>
    <input type="number" value="20" name="number_limit" id="4" class="number_limit" min="1" /><br />
    <input type="submit" class="search_submit searchMovie" value="Search" /><br />
</form>
<hr>
<form class="forms" action="index.php?page=searchByDate" method="POST">
    <div class="search_title">
        <img src="public/icons/calendar.png" alt="screening calendar icon" />
        <h4>By scheduled screening date</h4>
    </div>
    <label for="date_input">Screening date : </label>
    <input type="date" name="date_input" id="date_input" /><br />
    <label for="3">Number per page : </label>
    <input type="number" value="20" name="nbr_limit" id="3" class="number_limit" min="1" /><br />
    <input type="submit" class="search_submit searchByDate" value="Search" />
</form>

<?php

$content = ob_get_clean();

require('view/template.php');

?>
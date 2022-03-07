<?php

ob_start();

if(isset($_GET['uid'])){
    echo '
    <h3 id="name">Add to '.$_GET['f'] . ' ' . $_GET['l'] .' history</h3>
    ';
}

?>
<nav>
    <a href="index.php"><img id="home" src="public/icons/home.png" alt="home icon" /> Home</a>
</nav>
<table>
    <thead>
        <tr class="header">
            <th>Scheduled screening</th>
            <th>Room</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Director</th>
            <th>Duration</th>
            <!-- <th>Release date</th> -->
            <!-- <th>Distributor</th> -->
            <th>Rating</th>
            <?php echo (isset($_GET['f'])) ? '<th>Choose schedule</th>' : null ?>
        </tr>
    </thead>
    <tbody>

<?php

while ($result = $movies[1]->fetch()) {

?>
        <tr class="body">
            <td><?= $result['date_begin'] ?></td>
            <td><?= $result['roomName'] ?></td>
            <td><?= $result['title'] ?></td>
            <td><?= $result['genreName'] ?></td>
            <td><?= $result['director'] ?></td>
            <td><?= $result['duration'] ?></td>
            <td><?= $result['rating'] ?></td>
            <?php echo (isset($_GET['f'])) ? '<td><a href="index.php?page=addEntry&mid='. $_GET['mid'] .'&sid='. $result['schId'] .'&uid='. $_GET['uid'] .'&f='. $_GET['f'] .'&l='.$_GET['l'] .'">Choose entry <img id="small_add" src="public/icons/add.png" alt="add icon" /></a></td>' : null ?>
        </tr>
        
        <?php

}

?>

</tbody>
</table>

<?php


if(!isset($_GET['ps'])){
    $currentPage = 1;
} else {
    $currentPage = $_GET['ps'];
}

if(isset($_GET['uid'])){
    echo '<div class="pagination"><a class="pages" id="first" href="index.php?ps=1&search='.$movies[2].'&limit='.$movies[3].'&mid='. $_GET['mid'] .'&sid='. $result['schId'] .'&uid='. $_GET['uid'] .'&f='. $_GET['f'] .'&l='.$_GET['l'] .'"> first</a>';
    for($pages=max($currentPage-5, 1) ; $pages<=max(1, min($movies[0], $currentPage+5)) ; $pages++){    
        echo '<a class="pages" href="index.php?ps='. $pages . '&search='.$movies[2].'&limit='.$movies[3].'&mid='. $_GET['mid'] .'&sid='. $result['schId'] .'&uid='. $_GET['uid'] .'&f='. $_GET['f'] .'&l='.$_GET['l'] .'">' . $pages . ' </a>';
    }
    echo '<a class="pages" id="last" href="index.php?ps='. $movies[0] . '&search='.$movies[2].'&limit='.$movies[3].'&mid='. $_GET['mid'] .'&sid='. $result['schId'] .'&uid='. $_GET['uid'] .'&f='. $_GET['f'] .'&l='.$_GET['l'] .'"> last </a></div>';
} else {
    echo '<div class="pagination"><a class="pages" id="first" href="index.php?ps=1&search='.$movies[2].'&limit='.$movies[3].'"> first</a>';
    for($pages=max($currentPage-5, 1) ; $pages<=max(1, min($movies[0], $currentPage+5)) ; $pages++){    
        echo '<a class="pages" href="index.php?ps='. $pages . '&search='.$movies[2].'&limit='.$movies[3].'">' . $pages . ' </a>';
    }
    echo '<a class="pages" id="last" href="index.php?ps='. $movies[0] . '&search='.$movies[2].'&limit='.$movies[3].'"> last </a></div>';
}

$content = ob_get_clean();

require('view/results_template.php');

?>
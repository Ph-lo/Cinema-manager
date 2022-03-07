<?php

ob_start();


?>
<nav>
    <a href="index.php"><img id="home" src="public/icons/home.png" alt="home icon" /> Home</a>
</nav>
<table>
    <thead>
        <tr class="header">
            <th>Title</th>
            <th>Genre</th>
            <th>Director</th>
            <th>Duration</th>
            <th>Release date</th>
            <th>Distributor</th>
            <th>Rating</th>
            <th>Add schedule</th>
        </tr>
    </thead>
    <tbody>
<?php

while ($result = $movies[1]->fetch()) {

?>
    
        <tr class="body">
            <td><?= $result['title'] ?></td>
            <td><?= $result['genre_name'] ?></td>
            <td><?= $result['director'] ?></td>
            <td><?= $result['duration'] ?></td>
            <td><?= $result['release_date'] ?></td>
            <td><?= $result['name'] ?></td> 
            <td><?= $result['rating'] ?></td>
            <td><a href="index.php?page=addScreening&id=<?= $result['movieId'] ?>&title=<?= $result['title'] ?>">Add screening</a></td>
        </tr>
        
        <?php

}

?>
</tbody>

</table>

<?php

// if($movies[0] !== 0) {

// }
// echo $movies[0];
// for($pages=1 ; $pages<= $movies[0] ; $pages++){    
//     echo '<a class="pages" href="index.php?p='. $pages . '&title='.$movies[2].'&genre='.$movies[3].'&distributor='.$movies[4].'&limit='.$movies[5].'">' . $pages . ' </a>';
// }
if(!isset($_GET['p'])){
    $currentPage = 1;
} else {
    $currentPage = $_GET['p'];
}

echo '<div class="pagination"><a class="pages" id="first" href="index.php?p=1&title='.$movies[2].'&genre='.$movies[3].'&distributor='.$movies[4].'&limit='.$movies[5].'"> first</a>';

for($pages=max($currentPage-5, 1) ; $pages<=max(1, min($movies[0], $currentPage+5)) ; $pages++){    
    echo '<a class="pages" href="index.php?p='. $pages . '&title='.$movies[2].'&genre='.$movies[3].'&distributor='.$movies[4].'&limit='.$movies[5].'">' . $pages . ' </a>';
}

echo '<a class="pages" id="last" href="index.php?p='. $movies[0] . '&title='.$movies[2].'&genre='.$movies[3].'&distributor='.$movies[4].'&limit='.$movies[5].'"> last </a></div>';

$content = ob_get_clean();

require('view/results_template.php');

?>
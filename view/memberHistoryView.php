<?php

ob_start();

?>
<h3 id="name"><?= $_GET['f'] ?> <?= $_GET['l'] ?> <em>history</em></h3>
<table>
    <nav class="history_nav">
        <a href="index.php?page=members"><img id="home" src="public/icons/home.png" alt="home icon" /></a>
        <a href="index.php?ps=1&search=&limit=20&uid=<?= $_GET['uid'] ?>&f=<?= $_GET['f'] ?>&l=<?= $_GET['l'] ?>&mid=<?= $_GET['mid'] ?>">Add entry <img id="add" src="public/icons/add.png" alt="add icon"></a>
    </nav>
    

    <?php
    if($members[1]->rowCount() <= 0) {
        echo '
            <div id="noHistory">
                <p>'. $_GET['f'] .' '. $_GET['l'] .' has no history</p>
            </div>
        ';
    } else {
        ?>
        <thead>
            <tr class="header">
                <th>Session</th>
                <th>Title</th>
                <th>Duration</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
        <?php
    }
while ($result = $members[1]->fetch()) {
    
?>
        <tr class="body">
            <td><?= $result['date_begin'] ?></td>
            <td><?= $result['title'] ?></td>
            <td><?= $result['duration'] ?></td>
            <td><?= $result['rating'] ?></td>
        </tr>
        
        <?php

}

?>

</tbody>
</table>

<?php

if(!isset($_GET['ph'])){
    $currentPage = 1;
} else {
    $currentPage = $_GET['ph'];
}
echo '<div class="pagination"><a class="pages" id="first" href="index.php?ph=1&f='. $_GET['f'] .'&l='. $_GET['l'] .'&uid='. $members[2] .'"> first</a>';
for($pages=max($currentPage-5, 1) ; $pages<=max(1, min($members[0], $currentPage+5)) ; $pages++){    
    echo '<a class="pages" href="index.php?ph='. $pages .'&f='. $_GET['f'] .'&l='. $_GET['l'] .'&uid='. $members[2] .'">' . $pages . ' </a>';
}
echo '<a class="pages" id="last" href="index.php?ph='. $members[0] .'&f='. $_GET['f'] .'&l='. $_GET['l'] .'&uid='. $members[2] .'"> last </a></div>';

$content = ob_get_clean();

require('view/results_template.php');

?>
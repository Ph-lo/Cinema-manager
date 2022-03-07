<?php

ob_start();


?>
<nav>
    <a href="index.php?page=members"><img id="home" src="public/icons/home.png" alt="home icon" /> Home</a>
</nav>

<table>
    <thead>
        <tr class="header">
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Membership</th>
            <th>Duration</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>Address</th>
            <th>Country</th>
            <th>History</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>

<?php

while ($result = $members[1]->fetch()) {

?>
        <tr class="body">
            <td><?= $result['firstname'] ?></td>
            <td><?= $result['lastname'] ?></td>
            <td><?= $result['name'] ?></td>
            <td><?= $result['duration'] ?></td>
            <td><?= $result['email'] ?></td>
            <td><?= $result['birthdate'] ?></td>
            <td><?= $result['address'] ?></td>
            <td><?= $result['country'] ?></td>
            <td><a href="index.php?page=memberHistory&uid=<?= $result['userId'] ?>&f=<?= $result['firstname'] ?>&l=<?= $result['lastname'] ?>&mid=<?= $result['mId'] ?>">See history</a></td>
            <td><a href="index.php?page=modifyMember&uid=<?= $result['userId'] ?>">modify</a> <a href="index.php?page=deleteMembership&uid=<?= $result['userId'] ?>">Delete</a></td>
        </tr>
        
        <?php

}

?>

</tbody>
</table>

<?php

if(!isset($_GET['pm'])){
    $currentPage = 1;
} else {
    $currentPage = $_GET['pm'];
}
echo '<div class="pagination"><a class="pages" id="first" href="index.php?pm=1&search='.$members[2].'&limit='.$members[3].'"> first</a>';
for($pages=max($currentPage-5, 1) ; $pages<=max(1, min($members[0], $currentPage+5)) ; $pages++){    
    echo '<a class="pages" href="index.php?pm='. $pages . '&search='.$members[2].'&limit='.$members[3].'">' . $pages . ' </a>';
}
echo '<a class="pages" id="last" href="index.php?pm='. $members[0] . '&search='.$members[2].'&limit='.$members[3].'"> last </a></div>';
$content = ob_get_clean();

require('view/results_template.php');

?>
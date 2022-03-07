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
            <th>Email</th>
            <th>Birthdate</th>
            <th>Address</th>
            <th>Country</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>

<?php

while ($result = $users[1]->fetch()) {

?>
        <tr class="body">
            <td><?= $result['firstname'] ?></td>
            <td><?= $result['lastname'] ?></td>
            <td><?= $result['email'] ?></td>
            <td><?= $result['birthdate'] ?></td>
            <td><?= $result['address'] . ' ' . $result['city'] ?></td>
            <td><?= $result['country'] ?></td>
            <td><a href="index.php?page=addMembership&uid=<?= $result['id'] ?>">Add Membership</a></td>
        </tr>
        
        <?php

}

?>
</tbody>
</table>

<?php

if(!isset($_GET['pu'])){
    $currentPage = 1;
} else {
    $currentPage = $_GET['pu'];
}
echo '<div class="pagination"><a class="pages" id="first" href="index.php?pu=1&search='.$users[2].'&limit='.$users[3].'"> first</a>';
for($pages=max($currentPage-5, 1) ; $pages<=max(1, min($users[0], $currentPage+5)) ; $pages++){    
    echo '<a class="pages" href="index.php?pu='. $pages . '&search='.$users[2].'&limit='.$users[3].'">' . $pages . ' </a>';
}
echo '<a class="pages" id="last" href="index.php?pu='. $users[0] . '&search='.$users[2].'&limit='.$users[3].'"> last </a></div>';
$content = ob_get_clean();

require('view/results_template.php');

?>
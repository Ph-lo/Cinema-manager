<?php

ob_start(); ?>

<h3 id="name">Add to <?= $_GET['f'] . ' ' . $_GET['l'] ?> history</h3>

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
        </tr>
    </thead>

<?php

while ($result = $movies[1]->fetch()) {

?>
    <tbody>
        <tr class="body">
            <td><?= $result['date_begin'] ?></td>
            <td><?= $result['roomName'] ?></td>
            <td><?= $result['title'] ?></td>
            <td><?= $result['genreName'] ?></td>
            <td><?= $result['director'] ?></td>
            <td><?= $result['duration'] ?></td>
            <td><?= $result['rating'] ?></td>
        </tr>
    </tbody>

<?php

}

?>

</table>


<?php $content = ob_get_clean();

require('view/results_template.php');

?>
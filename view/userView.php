<?php

ob_start();

$result = $user->fetch();

// while ($result = $members[1]->fetch()) {
if(isset($_GET['modified']) && $_GET['modified'] == 'true'){
    ?>
    <div id="modified">
        <p>Membership modified !</p>
    </div>
    <?php
}

?>    
    <div id="user_infos">
        <nav id="member_nav">
            <a href="index.php?page=members"><img id="home" src="public/icons/home.png" alt="home icon" /></a>
        </nav>
        <div id="ticket_container">
            <div id="ticket">
                <h3><?= $result['firstname'] . ' ' . $result['lastname'] ?></h3>
                <ul>
                    <li><a href="#"><?= $result['email'] ?></a></li>
                    <li><?= $result['birthdate'] ?></li>
                    <li><?= $result['address'] ?></li>
                    <li><?= $result['country'] ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="user_form">
        <form class="forms" id="modify_form" action="index.php?page=setMembership&uid=<?= $_GET['uid'] ?>" method="POST">
            <label for="subName">Membership :</label>
            <select name="membership" id="membership">
                <option value="vip">VIP</option>
                <option value="gold">GOLD</option>
                <option value="classic">Classic</option>
                <option value="passday">Pass Day</option>
            </select>
            <br />
            <input id="modify_btn" class="search_submit" type="submit" value="Add membership" />
        </form>
    </div>

<?php

// }

$content = ob_get_clean();

require('view/results_template.php');

?>
<?php

ob_start();

$result = $member->fetch();

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
        <div id="ticker_container">
            <div id="ticket">
                <h3><?= $result['firstname'] . ' ' . $result['lastname'] ?></h3>
                <ul>
                    <li><a href="#"><?= $result['email'] ?></a></li>
                    <li><?= $result['birthdate'] ?></li>
                    <li><?= $result['address'] ?></li>
                    <li><?= $result['country'] ?></li>
                </ul>
            </div>
            <div id="ticket_part">
                <h5>- <?= $result['name'] ?> -</h5>
                <h5><?= $result['price'] ?> $</h5>
                <h5><?= $result['duration'] ?> day(s)</h5>
            </div>
        </div>
    </div>
    <div id="user_form">
        <form class="forms" id="modify_form" action="index.php?page=applyModification&uid=<?= $_GET['uid'] ?>" method="POST">
            <label for="subName">Membership :</label>
            
            <select name="subName" id="subName">
                <option <?php echo ($result['name'] == 'VIP') ? 'selected="selected"' : null ?> value="VIP">VIP</option>
                <option <?php echo ($result['name'] == 'GOLD') ? 'selected="selected"' : null ?> value="GOLD">GOLD</option>
                <option <?php echo ($result['name'] == 'Classic') ? 'selected="selected"' : null ?> value="Classic">Classic</option>
                <option <?php echo ($result['name'] == 'Pass Day') ? 'selected="selected"' : null ?> value="Pass Day">Pass Day</option>
            </select><br />
            
            <label for="subPrice">Price :</label>
            <input type="text" name="subPrice" id="subPrice" value="<?= $result['price'] ?>" placeholder="<?= $result['price'] ?>" required="required" /><p class="form_p">&dollar;</p><br />
            <label for="subDuration">Duration :</label>
            <input type="text" name="subDuration" id="subDuration" value="<?= $result['duration'] ?>" placeholder="<?= $result['duration'] ?>" required="required" /><p class="form_p">Day(s)</p><br />
            <label for="subReduction">Reduction :</label>
            <input type="text" name="subReduction" id="subReduction" value="<?= $result['reduction'] ?>" placeholder="<?= $result['reduction'] ?>" required="required" /><p class="form_p">%</p><br />
            
            <input id="modify_btn" class="search_submit" type="submit" value="modify" />
        </form>
    </div>

<?php

// }

$content = ob_get_clean();

require('view/results_template.php');

?>
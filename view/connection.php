<?php

ob_start();


?>
<section id="connection_section">
    <nav>
        <a href="index.php"><img id="home" src="public/icons/home.png" alt="home icon" /> Home</a>
    </nav>
    <div id="connection">
        <form class="forms" action="index.php?page=connect" method="POST">
            <label for="login">Login :</label>
            <input type="text" name="login" id="login" autocomplete="off" required /><br />
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" required /><br />
            <input id="modify_btn" class="search_submit" type="submit" value="Connection" />
    
        </form>
    </div>
</section>

<?php




$content = ob_get_clean();

require('view/results_template.php');

?>
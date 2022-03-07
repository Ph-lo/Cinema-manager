<?php

ob_start();

if($_SESSION['admin'] == 'porcupine'){

    ?>
    <section id="connection_section">
        <nav>
            <a href="index.php"><img id="home" src="public/icons/home.png" alt="home icon" /> Home</a>
        </nav>
        <div id="beware">
            <p>Pressing this button will delete all script files and drop the database</p>
        </div>
        <div id="alert_container">
            <a href="index.php?page=adios">FINISH IT</a>
        </div>
    </section>

    <?php

} else {
    header('Location: index.php');
}





$content = ob_get_clean();

require('view/results_template.php');

?>
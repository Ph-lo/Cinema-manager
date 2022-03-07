<?php

ob_start(); ?>

<div id="calendar_container">
    <div id="calendar">
        <div id="form_container">

            <form id="calendar_form" class="forms" action="index.php?page=newScreening&id=<?= $_GET['id'] ?>" method="POST">
                <h3>Add movie schedule</h3>
                <h4>Title : <?= $title ?></h4>
                <label for="rooms">Room : </label>
                <select name="rooms" id="rooms">
                    <option value="1">Montana</option>
                    <option value="2">Highscore</option>
                    <option value="3">Salle 3</option>
                    <option value="4">Astek</option>
                    <option value="5">Gecko</option>
                    <option value="6">Azure</option>
                    <option value="7">Toshiba</option>
                    <option value="8">Salle 14</option>
                    <option value="9">Asus</option>
                    <option value="10">Salle 16</option>
                    <option value="11">Microsoft</option>
                    <option value="12">VIP</option>
                    <option value="13">Golden</option>
                    <option value="14">Salle 23</option>
                    <option value="15">Lenovo</option>
                    <option value="16">Salle 31</option>
                    <option value="17">Huawei</option>
                </select><br />
                <label for="datetime">Schedule on : </label>
                <input type="datetime-local" name="datetime" id="datetime" /><br />
                <input type="submit" id="modify_btn" class="search_submit schedule" value="Submit" />
            </form>
        </div>
    </div>
</div>


<?php $content = ob_get_clean();

require('view/results_template.php');

?>
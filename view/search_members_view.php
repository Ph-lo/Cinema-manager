<?php

ob_start();
?>

<form class="forms" action="index.php?page=searchMember" method="POST">
    <div class="search_title">
        <img src="public/icons/membership.png" alt="member card icon" />
        <h4>Members</h4>
    </div>
    <label for="member_input">Members : </label>
    <input type="text" name="member_input" id="member_input" /><br />
    <label for="2">Number per page : </label>
    <input type="number" value="20" name="number_limit" id="2" class="number_limit" min="1" /><br />
    <input type="submit" class="search_submit member" value="Search" />
</form>
<hr />
<form class="forms" action="index.php?page=searchUser" method="POST">
    <div class="search_title">
        <img src="public/icons/user.png" alt="user icon" />
        <h4>Users</h4>
    </div>    
    <label for="user_input">Users : </label>
    <input type="text" name="user_input" id="user_input" /><br />
    <label for="2">Number per page : </label>
    <input type="number" value="20" name="nbr_limit" id="2" class="number_limit" min="1" /><br />
    <input type="submit" class="search_submit member" value="Search" />
</form>

<?php

$content = ob_get_clean();

require('view/template.php');

?>
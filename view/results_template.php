<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/style.css" />
    <title>My Cinema</title>
</head>

<body>
    <div id="container_results">
        <?= $content ?>
    </div>
    <script src="../public/script.js"></script>
</body>

</html>
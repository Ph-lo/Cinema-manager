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
    <div id="tabs">
        <div class="tab"><a href="index.php?page=movies"> Search movies</a></div>
        <div class="tab"><a href="index.php?page=members">Search customers</a></div>
    </div>
    <div id="container">
        <?= $content ?>
    </div>
    <footer>
        <a href="index.php?page=connection">connection</a>
    </footer>
    <script src="../public/script.js"></script>
</body>

</html>
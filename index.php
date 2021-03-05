<?php
require_once 'app/init.php';

$itemsQuery = $db->prepare("
    SELECT id, name, done
    FROM items
    WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];


 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>To do</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="list">


        <h1 class="header">To do.</h1>

        <?php if(!empty($items)): ?>

        <ul class="items">
   
            <?php 
            foreach ($items as $item): ?>
                <li>
                <span class="item">

            <?php    echo $item['name']; ?>
        </span>
        <a href="#" class="done-button">Mark as done</a>
        </li>
            <?php endforeach; ?>
        
        </ul>
        <?php else: ?>
            <p>You haven't added any item.</p>
        <?php endif; ?>
        <form class="item-add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit">
    </div>
</body>
</html>
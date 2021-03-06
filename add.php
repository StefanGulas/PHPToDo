<?php

require_once 'app/init.php';

$name = ($_POST['name']);
if(isset($name)){
    $name = trim($name);
    if(!empty($name)){
        $addedQuery = $db->prepare("
            INSERT INTO items (name, user, done, created)
            VALUES(:name, :user, 0, NOW())
        ");

        $addedQuery->execute([
            'name' => $name,
            'user' => $_SESSION['user_id']
        ]);
    }
}

header('Location: index.php');
?>
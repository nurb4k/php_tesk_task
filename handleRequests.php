<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['text'];

    if ($name && $email && $text) {
        include 'db.php';
        addFeedback($name, $email, $text);
    }



}
?>


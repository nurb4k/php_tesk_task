<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['user']['role_id'] == 3 ) {
    $id = $_POST['fb_id'];

    if ($id) {
        include 'db.php';
        acceptFb($id);
        header("Location: AdminPanel.php");
    }

}
?>


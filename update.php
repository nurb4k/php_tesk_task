<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $text = $_POST['new_text'];
    $id = $_POST['fbUp_id'];

    if ($text && $id) {
        include 'db.php';
        updateFb($text, $id);
        header("Location: adminPanel.php");
    } else {
        echo "ERROR";
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include 'headerLinks.php' ?>
    <title>update</title>
</head>
<body>
<?php session_start();include 'navbar.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    include "db.php";
    $fb = getFbById($_GET['id']);
    if ($fb != null) {

        ?>

        <div class="container">
            <form class="form" action="update.php" method="post">
                <div class="form-group">
                    <label for="exampleInputText">user name</label>
                    <input type="text" disabled class="form-control" value="<?php echo $fb['name'] ?>"
                           id="exampleInputText">
                </div>
                <div class="form-group">
                    <label for="exampleInputText">user email</label>
                    <input type="text" disabled class="form-control" value="<?php echo $fb['email'] ?>"
                           id="exampleInputText">
                </div>
                <div class="form-group">
                    <label for="exampleInputText">Text</label>
                    <input type="text" class="form-control" value="<?php echo $fb['text'] ?>" name="new_text"
                           id="exampleInputText">
                    <input type="hidden"  value="<?php echo $fb['id'] ?>" name="fbUp_id"
                        >
                </div>
                <div class="form-group">
                    <label for="">Image</label><br>
                    <img src="<?php echo $fb['image'] ?>" width="160px" height="150px"
                         alt="Red dot"/>
                </div>

                <button type="submit" class="btn btn-success">Save changes</button>
            </form>
        </div>


        <?php

    }
}


?>


</body>
</html>
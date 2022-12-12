<?php
session_start();
if (isset($_SESSION['user']['role_id']) != 3) {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel</title>
    <?php  include 'headerLinks.php'?>
</head>
<body>
<?php  include 'navbar.php'?>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">user name</th>
            <th scope="col">image</th>
            <th scope="col">text</th>
            <th scope="col">status</th>
            <th scope="col">accept/reject</th>
            <th scope="col">update</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include 'db.php';
        $feedbacks = getAllFeedbacksForAdm();
        for ($i = 0;
             $i < count($feedbacks);
             $i++) { ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td><?php echo $feedbacks[$i]['name'] ?></td>
                <td>
                    <img src="<?php echo $feedbacks[$i]['image'] ?>" width="120px" height="100px"
                         alt=""/>
                </td>
                <td>
                    <?php echo $feedbacks[$i]['text'] ?>
                </td>
                <td><?php
                    if ($feedbacks[$i]['status']) {
                        ?>
                        <span style="color: green;font-weight: bold">Accepted</span>
                        <?php
                    } else {
                        ?>
                        <span style="color: red;font-weight: bold">Rejected</span>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($feedbacks[$i]['status']) {
                        ?>
                        <form action="reject.php" method="post">
                            <input  value="<?php echo $feedbacks[$i]['id'] ?>" name="fb_id" hidden>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                        <?php
                    } else {
                        ?>
                        <form action="accept.php" method="post">
                            <input value="<?php echo $feedbacks[$i]['id'] ?>" name="fb_id" hidden>
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>

                        <?php
                    }
                    ?>

                </td>
                <td>
                    <div class="action">
                        <button type="button" class="btn btn-primary btn" title="Approved">
                            <span class="glyphicon glyphicon-ok"> <a href="update.php?id=<?php echo $feedbacks[$i]['id'] ?>" class="text-light">update</a></span>
                        </button>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
session_start();
if(isset( $_SESSION['user'])){
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty( $_SESSION['user'])) {
    $email = $_POST['email'];
    $pw = $_POST['password'];

    if ($email && $pw) {
        include 'db.php';
        $user = getUser($email);
        if ($user != null && $user['password'] == $pw) {
            session_start();
            $_SESSION['user'] = $user;
        }

        header("Location: index.php");
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nurbek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand  text-light " style="margin-left: 25px;" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-light" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-light" href="index.php">Feedbacks </a>
            </li>
            <li class="nav-item my-2 my-lg-0">
                <a class="nav-link text-light" href="login.php">Login</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container w-25 mt-5" style="background-color: lightgoldenrodyellow;border-radius: 12px">
    <form action="login.php" method="post">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Email address</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<body>

</body>
</html>
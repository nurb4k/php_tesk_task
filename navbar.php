
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand  text-light " style="margin-left: 25px;" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-light" id="navbarSupportedContent">
        <div class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-light" href="index.php">Feedbacks </a>
            </li>

            <?php
//            session_start();
            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']['role_id'] == 3) { ?>
                    <li class="nav-item active">
                        <a class="nav-link text-light" href="adminPanel.php">Admin panel</a>
                    </li>
                <?php } ?>

                <div class="dropdown">
                    <button class="btn btn-lg btn-secondary dropdown-toggle bg-dark lr" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['user']['name'] ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <li class="nav-item my-2 my-lg-0">
                    <a class="nav-link text-light" href="login.php">LOGIN</a>
                </li>

            <?php } ?>

            </ul>
        </div>
</nav>

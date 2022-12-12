<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nurbek</title>
    <?php include 'headerLinks.php' ?>


    <script>
        function checkQuery(query, text) {
            return query == "?" ? text : "&" + text;
        }

        function getData() {
            let formEL = document.forms.multi_filter;
            let formData = new FormData(formEL);
            let query = "?";
            var search = formData.get('search');
            var searchByEmail = formData.get('searchByEmail');
            var search_date = formData.get('search_date');


            if (search !== "") {
                query = query + checkQuery(query, "search=") + search;
            }
            if (searchByEmail !== "") {
                query = query + checkQuery(query, "searchByEmail=") + searchByEmail;
            }
            if (search_date !== "") {
                query = query + checkQuery(query, "search_date=") + search_date;
            }

            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("feedbacks").innerHTML = this.responseText;
                }
            };
            if (query === "?") {
                query = "";
            }
            xmlhttp.open("GET", "search.php" + query, true);
            xmlhttp.send();
        }


    </script>


</head>
<body onload="getData()">
<?php
session_start();
include 'navbar.php';
include 'db.php';
$feedbacks = getAllFeedbacks();
?>
<div class="container">
    <?php
    if (isset($_GET['error'])) {
        ?>
        <div class="alert alert-danger" roles="alert">
            <h5>Name required and only alphabets and whitespace are allowed</h5>
            <h5>Email required</h5>
            <h5>Image required and size less than 1 mb</h5>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($_GET['success'])) {
        ?>
        <div class="alert alert-success" roles="alert">
            <h5>Thank for you feedback! Admin will check your review after it will be published.</h5>
        </div>
        <?php
    }
    ?>

    <div class="row">
        <div class="panel panel-default widget">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Feedbacks <span class="label label-info"> <?php echo count($feedbacks) ?></span></h3>

            </div>
            <article class="filter-group">
                <header class="card-header">
                    <p data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                        <i class="icon-control fa fa-chevron-down"></i>
                    <h6 style="color: #3F5EFB" class="title">Фильтр</h6>
                    </p>
                </header>
                <div class="filter-content collapse show" id="collapse_1">
                    <form action="" id="multi_filter">
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" name="search" onkeyup="getData()" class="form-control w-50"
                                       placeholder="Search by name author">
                                <input type="text" name="searchByEmail" placeholder="Search by email"
                                       onkeyup="getData()" class="form-control w-50">
                                <input type="hidden" name="multifilter">

                            </div>
                            <label for="">Search by date</label>
                            <select name="search_date"  onchange="getData()">
                                <option selected value="">Default</option>
                                <option value="desc">Newest</option>
                                <option value="asc">Oldest</option>
                            </select>
                        </div>
                    </form>
                </div>
            </article>
            <div class="panel-body">
                <ul class="list-group" id="feedbacks">


                </ul>

            </div>
        </div>
    </div>
</div>


<div class="container w-25" style="background-color: lightgoldenrodyellow">
    <h3 class="text-center">Leave your feedback</h3>
    <form action="handleRequests.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="exampleInputName">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1">
        </div>

        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Text</label>
            <textarea name="text" rows="4" class="form-control" id="exampleInputText">
            </textarea>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">file</label>
            <input type="file" class="form-control" name="image" id="exampleInputEmail1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>
<?php
include 'db.php';
$sql = "SELECT * from php_task.feedbacks where status = 1 ";
$sql_short = "";
if (isset($_GET["search"]) && $_GET["search"] != "") {
    $sql = $sql . " AND ";
    $search = $_GET["search"];
    $sql_short = "name LIKE '%$search%'";
    $sql = $sql . $sql_short;

}
if (isset($_GET["searchByEmail"]) && $_GET["searchByEmail"] != "") {
    $sql = $sql . " AND ";
    $searchByEmail = $_GET["searchByEmail"];
    $sql_short = "email LIKE '%$searchByEmail%'";
    $sql = $sql . $sql_short;
}
if(isset($_GET["search_date"]) && $_GET["search_date"]!= ""){
    $type = $_GET["search_date"];
    $sql_short = " order by created_at $type ";
    $sql = $sql . $sql_short;
}

global $conn;
$query = $conn->prepare($sql);
$query->execute();
$feedbacks = array();
$feedbacks = $query->fetchAll();

//echo $sql;
$responce = "";
$i = 0;
foreach ($feedbacks as $fb) {

    $responce = ' <li class="list-group-item"  >          
                        <div>
                            <div class="mic-info">
                                By: <a href="#">
                                    ' . $fb['name'] . '</a> at
                                ' . $fb['created_at'] . '
                            </div>
                            Email: ' . $fb['email'] . '
                            
                        </div>
                        
                        <div class="comment-text">
                            <h4>
                               ' . $fb['text'] . '
                            </h4>
                        </div>
                        <div class="col-xs-2 col-md-1">
                            <img src="' . $fb['image'] . '" width="160px" height="150px"
                                 alt="Red dot"/>
                        </div>
                        <hr style="margin-top: 190px;border-top: 5px solid black;" >    
                           
                          
    </li>
     ' ?>

    <?php
    if ($fb['isAdminEdited'] == 1) {
        ?>
        <span style="color:darkorange">
            edited by admin
        </span>
        <?php

    }

    ?>


    <?php
    echo $responce;
}


?>

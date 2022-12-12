<?php
try {
    $conn = new PDO("mysql:localhost;dbname=php_task", "root", "nurbek");
} catch (Exception $e) {
    echo $e->getMessage();
}
function getAllFeedbacks()
{
    global $conn;
    $query = $conn->prepare(
          "select name,email,image,text,created_at,isAdminEdited 
                from php_task.feedbacks 
                where status = '1'
                order by created_at desc ");
    $query->execute();

    $result = $query->fetchAll();
    return $result;
}

function addFeedback($n, $e, $t)
{
    global $conn;
    $name = $_FILES['image']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "png", "gif");
    if (($_FILES["image"]["size"] <= 1000000) && filter_var($e, FILTER_VALIDATE_EMAIL) && preg_match("/^[a-zA-z]*$/", $n)){
        if (in_array($imageFileType, $extensions_arr)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $name)) {
                $image_base64 = base64_encode(file_get_contents('upload/' . $name));
                $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
                $query = $conn->prepare("insert into php_task.feedbacks(name,email,text,image) values(?,?,?,?)");
                $query->execute([$n, $e, $t, $image]);
                header("Location: index.php");
            }
        }
    } else {
        header("Location: index.php?error");
    }

}

function getUser($email)
{
    global $conn;
    $query = $conn->prepare("select * from php_task.users where email = ?");
    $query->execute([$email]);
    $result = $query->fetch();
    return $result;

}

function getAllFeedbacksForAdm()
{
    global $conn;
    $query = $conn->prepare("select * from php_task.feedbacks  order by created_at desc");
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

function rejectFb($id)
{
    global $conn;
    $query = $conn->prepare("update php_task.feedbacks set status = '0' where id = ?");
    $query->execute([$id]);
}

function acceptFb($id)
{
    global $conn;
    $query = $conn->prepare("update php_task.feedbacks set status = '1' where id = ? ");
    $query->execute([$id]);
}

function getFbById($id)
{
    global $conn;
    try {
        $query = $conn->prepare("select * from php_task.feedbacks where id = ?");
        $query->execute([$id]);
        $result = $query->fetch();

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $result;
}

function updateFb($text, $id)
{
    global $conn;

    try {

        $query = $conn->prepare("update php_task.feedbacks set text = ?, isAdminEdited = '1'  where id = ?");
        $query->execute([$text, $id]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}

?>
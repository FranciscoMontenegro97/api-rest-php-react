<?php 

include 'db/database.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $query = "SELECT * FROM product WHERE id=".$_GET['id'];
        $result = methodGet($query);
        echo json_encode($result -> fetch(PDO::FETCH_ASSOC));
    }else{
        $query = "SELECT * FROM product";
        $result = methodGet($query);
        echo json_encode($result -> fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD'] == 'POST'){
    unset($_POST['METHOD']);
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $query = "INSERT INTO product (name, amount, price) VALUES ('$name', '$amount', '$price')";
    $queryAutoIncrement = "SELECT MAX(id) AS id FROM product";
    $result = methodPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD'] == 'PUT'){
    unset($_POST['METHOD']);
    $id = $_GET['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $query = "UPDATE product SET name = '$name', amount = '$amount', price = '$price' WHERE id = '$id'";
    $result = methodPut($query);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD'] == 'DELETE'){
    unset($_POST['METHOD']);
    $id = $_GET['id'];
    $query = "DELETE FROM product WHERE id = '$id'";
    $result = methodDelete($query);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");

?>
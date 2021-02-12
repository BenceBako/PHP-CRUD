<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$status = '';
$feladat = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $status = $_POST['status'];
    $feladat = $_POST['feladat'];

    $mysqli->query("INSERT INTO data (name, status, feladat) VALUES ('$name', '$status', '$feladat')") or
            die($mysqli->error);

    $_SESSION['message'] = "A rekord mentésre került!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "A rekord törlölve lett!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if ($result->num_rows){
        $row = $result->fetch_array();
        $name = $row['name'];
        $status = $row['status'];
        $feladat = $row['feladat'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $feladat = $_POST['feladat'];

    $mysqli->query("UPDATE data SET name='$name', status='$status', feladat='$feladat' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "A rekord frissítésre került!";
    $_SESSION['msg-type'] = "warning";

    header('location: index.php');
 }
?>
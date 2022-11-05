<?php

session_start();
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'kinoo'
    );
    $sql = "SELECT * FROM `rezerwacje` WHERE `id_seansu` = $id";
    $result=mysqli_query($conn, $sql);
    $response = array();

     while($row = mysqli_fetch_assoc($result))
     {
        $response[] = $row;
    }
    $jsonstring = json_encode($response);
    echo $jsonstring;
}



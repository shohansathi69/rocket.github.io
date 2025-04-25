<?php

include "connect.php"; // Using database connection file here

$sql="SELECT * FROM offers WHERE status	= '0'";
$result=mysqli_query($link,$sql);

$user = array();

while($raw = mysqli_fetch_assoc($result)){
    $index['id'] = $raw['id'];
    $index['image'] = $raw['image'];
    $index['title'] = $raw['title'];
    $index['sub'] = $raw['sub'];
    $index['offer_name'] = $raw['offer_name'];
    $index['status'] = $raw['status'];
    $index['type'] = $raw['type'];


    array_push($user,$index);
}

echo json_encode($user);




?>
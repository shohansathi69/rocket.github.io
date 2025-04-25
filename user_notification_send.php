<?php

    include 'connect.php';
    extract($_REQUEST);
    $sql = mysqli_query($link,"SELECT * FROM tbl_admin");
    $res = mysqli_fetch_assoc($sql);
     
    $date = date("Y-m-d");
     $no = mysqli_query($link,"INSERT INTO notifications SET title='$title',message='$message', date='$date'");
     $update = mysqli_query($link,"UPDATE users SET badge=badge+1");
    
 function sendMessage($message,$image,$small,$title,$app_id,$rest){
    
    $content = array(
        "en" =>"$message"
        
        );
        $heading = array(
   "en" => "$title"
);

  

    $fields = array(
        'app_id' => $app_id,
        'included_segments' => array('All'),
        'data' => array("foo" => "bar"),
        'big_picture' =>$image,
        'large_icon' =>$small,
        'contents' => $content,
        'heading' => "$heading"
    );

    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
  'Authorization: Basic '.$rest));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
    
}

 $sql = "SELECT os_app_id,os_rest_api FROM settings";
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $rest =$row['os_rest_api'];
   $app_id =$row['os_app_id'];
  }

$response = sendMessage($message,$image,$small,$title,$app_id,$rest);
header("Location: user_notification.php");

   
 ?>

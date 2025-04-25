<?php

include "db.php"; // Using database connection file here
//extract($_REQUEST);

if(isset($_POST['id']))
{
$sql="SELECT * FROM ref_achi";
$result=mysqli_query($link,$sql);

$user = array();

while($raw = mysqli_fetch_assoc($result)){
    $index['id'] = $raw['id'];
    $index['invites'] = $raw['invites'];
    $index['points'] = $raw['points'];
    
    $check_sql="SELECT * FROM ref_claim WHERE achi_id =".$raw['id'];
    $check_result=mysqli_query($link,$check_sql);
    if(mysqli_num_rows($check_result)>0) {
		    $index['check'] = "true";
    }else
    {
        $index['check'] = "false";
    }
    
    array_push($user,$index);
}

echo json_encode($user);

}


?>
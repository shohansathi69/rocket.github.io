<?php

function c()
{
    global $link;
    $get_reward = "SELECT * FROM `license`";
	$send_reward = mysqli_query($link,$get_reward);
		if(mysqli_num_rows($send_reward)>0) {
		    $raw = mysqli_fetch_assoc($send_reward);
		    if($raw['is_blocked']=='true'){
		        return false;
		    }elseif($raw['is_blocked']=='false' || $raw['is_blocked']==''){
		        return true;
		    }
		    
		}  else {
		        return false;
		        
		    }
}


?>
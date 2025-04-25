<?php include('connect.php');
include('offerwallpostback.php');

  function ip_details() {
         if (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }

            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $json = file_get_contents("http://ipinfo.io/{$ip}");
            $details = json_decode($json);
            return $details;
}

if(isset($_SERVER['HTTP_REFERER']))
{
 return false;
 exit;
}


$key = "432432432";

extract($_REQUEST);
$COIN = 100;
if($link){
   // echo "hi";
}

function cal_percentage($num_amount, $num_total) {
  $count1 = $num_amount / $num_total;
  $count2 = $count1 * 100;
  $count = number_format($count2, 0);
  return $count;
}
date_default_timezone_set('Asia/Kolkata');
$time = date("h:i a");

if(isset($user_signup) && isset($access_key)) {
    $response = array();
    	$UserCountry=$_REQUEST['UserCountry'];
    	
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$check_exits_user_query = "SELECT username FROM users WHERE username='$username'";
	$send_sql = mysqli_query($link,$check_exits_user_query);

	if(mysqli_num_rows($send_sql)==1){
		$response['error'] = "true";
		$response['message'] = "User already registered! Please Choose Different";
		print_r(json_encode($response));
	    return false;
	}

    $check_device = "SELECT device,email FROM users WHERE device='$device'";
	$send_dev = mysqli_query($link,$check_device);

		if(mysqli_num_rows($send_dev)>=2){
		$response['error'] = "true";
		$get = mysqli_fetch_assoc($send_dev);
		$response['message'] = "Already registered on this device with email: ".$get['email'];
		print_r(json_encode($response));
	    return false;
	}

	$register_user = "INSERT INTO users (phone,image,username,name,refer,email,device,UserCountry) VALUES ('$phone','$image','$username','$name','$refer','$email','$device','$UserCountry')";
	$send_server= mysqli_query($link,$register_user);

	if($send_server){
	    $response['error'] = false;
		$response['message'] = "User Registered successfully";
	}else{
	    $response['error'] = true;
	    $response['message'] = "Something Gone Wrong try Again";
	}
	print_r(json_encode($response));
}else

if(isset($user_login) && isset($access_key)) {

    $response = array();


    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

	$user_query = "SELECT * FROM users WHERE email='$phone'";
	$sql = mysqli_query($link,$user_query);
	$data = mysqli_fetch_assoc($sql);
	$username = $data['username'];
	$id = $data['id'];
	if(mysqli_num_rows($sql)==1){

				if(isset($refer) && !empty($refer)) {
    			    $refer_query = mysqli_query($link, "SELECT * FROM users WHERE refer='$refer' and username!='$username'");
    			    $get_refer_status = mysqli_fetch_assoc($refer_query);
    			        if(mysqli_num_rows($refer_query)==1){
    			            $check_status = mysqli_query($link, "SELECT refer_status FROM users WHERE username = '$username'");
    			            $get_refered = mysqli_fetch_assoc($check_status);
    			            if($get_refered['refer_status']==0) {
    			            $response['refer_code_status'] = "Referral code is valid";
    						$response['refer_code_error'] = "false";
    						$response['refer_id'] = $get_refer_status['id'];
    						$response['refer_username'] = $get_refer_status['username'];

    						  $get_settings = mysqli_query($link, "SELECT invited_user_bonus, referral_bonus FROM settings");
    			              $get_refered_points = mysqli_fetch_assoc($get_settings);
    			              $invited_user_bonus = $get_refered_points['invited_user_bonus'];
    			              $referral_bonus = $get_refered_points['referral_bonus'];
    			              $response['bonus'] = $invited_user_bonus;


    						$refer_point = "UPDATE `users` SET `points`= `points`+'$referral_bonus', `total_ref`= `total_ref`+1 WHERE id=".$get_refer_status['id'];
    						$db = mysqli_query($link,$refer_point);
    						$time = date("h:i a");
    						//adding tracking record
    						$adding_tracking_record = 'INSERT INTO `tracker`(`username`, `points`, `type`, `date`,`time`) VALUES
    							("'.$get_refer_status['username'].'","'.$referral_bonus.'","Refer & Earn","'.date('Y-m-d').'","'.$time.'")';
    						$db = mysqli_query($link,$adding_tracking_record);

    				/*		$bonus_point = "UPDATE `users` SET `points`= `points`+'$invited_user_bonus' WHERE username=".$username;
    						$dbbb = mysqli_query($link,$bonus_point);
    						$time = date("h:i a");
    						//adding tracking record
    						$adding_tracking_record_user = 'INSERT INTO `tracker`(`username`, `points`, `type`, `date`,`time`) VALUES
    							("'.$username.'","'.$invited_user_bonus.'","Refer & Earn","'.date('Y-m-d').'","'.$time.'")';
    						$dbb = mysqli_query($link,$adding_tracking_record_user);*/

    						//setting the refer_status of user who is claiming the points to 1
    						$user_get_points = "UPDATE `users` SET `refer_status`= 1 WHERE username='".$username."'";
    						$db = mysqli_query($link,$user_get_points);
			            } else {

			            $response['refer_code_status'] = "You've already redeemed the points";
						$response['refer_code_error'] = "true";
			            }
			    } else {
			        	$response['refer_code_status'] = "Invalid Referral Code";
					    $response['refer_code_error'] = "true";
			    }

			}

		    $get_reward = "SELECT * FROM `users` ORDER BY `points` DESC LIMIT 99";
        	$send_reward = mysqli_query($link,$get_reward);

        	$rank = 99;
        	$count = 0;

		while($raw = mysqli_fetch_assoc($send_reward)){
          $count++;
         if($raw['id']==$id)
         {
             $rank = $count;
         }

		}

			$response['error'] = "false";
			$response['message'] = "Successfully logged in";
			$response['data'] =$data;
			$response['rank'] =$rank;

	} else {

        	$response['error'] = "true";
			$response['message'] = "Wrong username / password! Try Again";
	}

	print_r(json_encode($response));
}else
if(isset($user_check) && isset($access_key)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$check_exits_user_query = "SELECT email FROM users WHERE email='$phone'";
	$send_sql = mysqli_query($link,$check_exits_user_query);
	if(mysqli_num_rows($send_sql)==1){
	    	$response['error'] = "false";
			$response['message'] = "Already Have Account";
	}else {
	        $response['error'] = "true";
			$response['message'] = "Need to Create Account";
	}

	print_r(json_encode($response));
}else

if(isset($access_key) && isset($add_spin)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	if($type == 'Daily checked In' || $type == 'Daily checkin bonus'){
		$date = date('Y-m-d');
    	$sql= mysqli_query($link,"SELECT * FROM `tracker` where (`type`='Daily checkin bonus' or `type`='Daily checked In') and `username` = '$username' and date(`date`)='".date('Y-m-d')."'");
		$res = mysqli_fetch_assoc($sql);
		if(mysqli_num_rows($sql)>0) {
			$response['error'] = "true";
			$response['message'] = "You've already claimed daily bonus";
			print_r(json_encode($response));
			return false;
		}

	}
	    if($type=="Game Play Win Contest"){
	        $select = mysqli_query($link,"SELECT * FROM tbl_game_category WHERE id='$game_id'");
	        $r = mysqli_fetch_assoc($select);
	        $type = "".$r['name']." Win";
	          $response['error'] = false;
		    $response['message'] = "Points added to your wallet";
		    	print_r(json_encode($response));
			return false;
	    }
	     if($type=="Game Play Win Featured"){
	        $select = mysqli_query($link,"SELECT * FROM tbl_featured_item WHERE id='$game_id'");
	        $r = mysqli_fetch_assoc($select);
	        $type = "".$r['name']." Win";
	         $response['error'] = false;
		    $response['message'] = "Points added to your wallet";
		    	print_r(json_encode($response));
			return false;
	    }

	    $date = date("Y-m-d");
		if(!empty($username) && !empty($type)){
		    $date = date('Y-m-d');
		    $time = date("h:i a");
		    //Add Data Tracker
		    $tracker_query = mysqli_query($link,'INSERT INTO `tracker`(`username`, `points`, `type`, `date`,`time`) VALUES
							("'.$username.'","'.$points.'","'.$type.'","'.date('Y-m-d').'","'.$time.'")');
		    $result = mysqli_insert_id($link);
		    //Update User Points
		    $update_user_points = mysqli_query($link,"UPDATE `users` SET `points` = `points` + '".$points."' WHERE `users`.`username` ='".$username."'");

		    $response['error'] = false;
		    $response['message'] = "Points added to your wallet";
	    	$response['id'] = $result;
		} else {
		    	$response['error'] = true;
	        	$response['message'] = "Please fill all the data and submit!";
		}

	print_r(json_encode($response));
}
else

if(isset($access_key) && isset($payment_request)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$select_user = mysqli_query($link,"SELECT * FROM payment_requests WHERE username='$username' AND status = 0");

	if(mysqli_num_rows($select_user)>=1){
    		$response['error'] = true;
			$response['message'] = "You Already Requested";
	} else {
 	   $add_request = mysqli_query($link, 'INSERT INTO `payment_requests`(`username`, `payment_address`, `request_type`, `request_amount`, `points_used`, `remarks`, `status`,`date`) VALUES
							("'.$username.'","'.$payment_address.'","'.$request_type.'","'.$request_amount.'","'.$points_used.'","'.$remarks.'","'.$status.'","'.date('Y-m-d').'")');
   	    $result = mysqli_insert_id($link);
	    $sql = mysqli_query($link,"UPDATE `users` SET `points` = `points`-$points_used WHERE `users`.`username` ='".$username."'");

	        $response['error'] = false;
			$response['message'] = "Request has been registered successfully";
			$response['request_id'] = $result;

	}

	print_r(json_encode($response));
}
else

if(isset($access_key) && isset($get_user_by_id)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
		$sql = mysqli_query($link,"SELECT * FROM `users` WHERE id='$id'");
		$result = mysqli_fetch_assoc($sql);


			$get_reward = "SELECT * FROM `users` ORDER BY `points` DESC LIMIT 99";
        	$send_reward = mysqli_query($link,$get_reward);

        	$rank = 99;
        	$count = 0;

		while($raw = mysqli_fetch_assoc($send_reward)){
          $count++;
         if($raw['id']==$id)
         {
             $rank = $count;
         }

		}

	    $sqlll = mysqli_query($link,"SELECT * FROM `tracker` WHERE username=".$result['username']);
		$tracker = mysqli_fetch_assoc($sqlll);
		$points = 0;
		while($tracker){
         $points+= $tracker['points'];
		}

		$sqll = mysqli_query($link,"SELECT * FROM `reward_list` WHERE u_id=".$result['id']);

		if(mysqli_num_rows($sql)>0) {
		    $response['error'] = "false";
		    $response['rank'] = $rank;
		    $response['total'] = "2";
		    $response['redeem'] = "5210";
			$response['data'] = $result;
		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}
else

if(isset($access_key) && isset($featured_leader)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
    $check = mysqli_query($link,"SELECT * FROM tbl_featured_game_joined WHERE username= '$username' AND tbl_featured_id= '$tbl_featured_id'");
    if(mysqli_num_rows($check)==0){
         $response['error'] = "true";
		$response['message'] = "Not Join";
		print_r(json_encode($response));
		return false;
    }
	$select = mysqli_query($link,"SELECT * FROM tbl_featured_game_joined WHERE tbl_featured_id= '$tbl_featured_id' ORDER BY win DESC");
	$data = array();


	        $i=1;
            $rank=1;
            $flag="";
	while($r=mysqli_fetch_assoc($select)){

	    $pre=$r['win'];
          if($flag!=$pre){
               $flag=$pre;
              if($i!=1){
                 $rank=$i;
                      //echo "count<br />";
                    }
                $i++;
               $rank =$rank;
            }else{
               $rank = $rank;
            }

	   $user = $r['username'];

	   $sql = mysqli_query($link,"SELECT name,image FROM users WHERE username='$user'");
	   $res = mysqli_fetch_assoc($sql);
	   $data[]=$r+$res;
	   $sql = mysqli_query($link,"UPDATE tbl_featured_game_joined SET rank = '$rank' WHERE username = '$user'");

	}

	    $response['error'] = "false";
		$response['message'] = "fetch Successfull";
		$response['data'] = $data;

        print_r(json_encode($response));
}
else

if(isset($access_key) && isset($join_feature_game)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$date = date("Y-m-d");
	$user = mysqli_query($link,"SELECT points FROM users WHERE username='$username'");
	$res = mysqli_fetch_assoc($user);
    $points = 100*$entry_fee;
    //echo $points;
	if($res['points']<$points){
	    $response['error'] = "points";
		$response['message'] = "Not Enough Points Please Add Coins ";
		print_r(json_encode($response));
		return false;
	}
	$game_name = mysqli_query($link,"SELECT name FROM tbl_featured_item WHERE id='$tbl_featured_id'");
	$name = mysqli_fetch_assoc($game_name);
	$game_name = $name['name'];
	$check = mysqli_query($link,"SELECT username FROM tbl_featured_game_joined WHERE username='$username' AND tbl_featured_id='$tbl_featured_id' ");
	$row = mysqli_num_rows($check);

	if($row>0){
	    $update = mysqli_query($link,"UPDATE tbl_featured_game_joined SET entry_date='$date',lose=lose+1 WHERE username='$username' AND tbl_featured_id ='$tbl_featured_id'");
	    $update_tbl = mysqli_query($link,"UPDATE tbl_featured_item SET user_count = user_count+1 WHERE id='$tbl_featured_id'");
    	    if($update){
    	        $user_point = mysqli_query($link,"UPDATE users SET points = points-'$points' WHERE username='$username'");
    	        $tracker = mysqli_query($link,"INSERT INTO tracker SET username='$username',points=-'$points',type='$game_name', transation='$tbl_featured_id',date='$date',time='$time'");
    	        $response['error'] = false;
        		$response['message'] = "Join Successfull";
    	    }else {
    	        $response['error'] = true;
    		    $response['message'] = "Join Failed";
    	    }
	}else {
	    $insert = mysqli_query($link,"INSERT INTO tbl_featured_game_joined SET username='$username',lose=1,tbl_featured_id='$tbl_featured_id',entry_date='$date'");
	    $update_tbl = mysqli_query($link,"UPDATE tbl_featured_item SET user_count = user_count+1 WHERE id='$tbl_featured_id'");
	     if($insert){
	        $user_point = mysqli_query($link,"UPDATE users SET points = points-'$points' WHERE username='$username'");
    	   $tracker = mysqli_query($link,"INSERT INTO tracker SET username='$username',points=-'$points',type='$game_name', transation='$tbl_featured_id',date='$date',time='$time'");
    	    $response['error'] = false;
    		$response['message'] = "Join Successfull";
	    }else {
	        $response['error'] = true;
		    $response['message'] = "Join Failed";
	    }
	}

    print_r(json_encode($response));
}
else

if(isset($access_key) && isset($contest_leader)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
     $check = mysqli_query($link,"SELECT * FROM tbl_contest_game_joined WHERE username= '$username' AND tbl_game_id= '$tbl_game_id'");
    if(mysqli_num_rows($check)==0){
         $response['error'] = "true";
		$response['message'] = "Not Join";
		print_r(json_encode($response));
		return false;
    }
	$select = mysqli_query($link,"SELECT * FROM tbl_contest_game_joined WHERE tbl_game_id= '$tbl_game_id' ORDER BY win DESC");
	$data = array();
            $i=1;
            $rank=1;
            $flag="";
	while($r=mysqli_fetch_assoc($select)){
	     $pre=$r['win'];
                          if($flag!=$pre){
                               $flag=$pre;
                              if($i!=1){
                                 $rank=$i;
                                      //echo "count<br />";
                                    }
                                $i++;
                               $rank = $rank;
                            }else{
                               $rank = $rank;
                            }
	   $user = $r['username'];

	   $sql = mysqli_query($link,"SELECT name,image FROM users WHERE username='$user'");
	   $res = mysqli_fetch_assoc($sql);
	   $data[]=$r+$res;
	   $sql = mysqli_query($link,"UPDATE tbl_contest_game_joined SET rank = '$rank' WHERE username = '$user'");

	}

	    $response['error'] = "false";
		$response['message'] = "fetch Successfull";
		$response['data'] = $data;

        print_r(json_encode($response));
}
else

if(isset($access_key) && isset($join_contest_game)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$date = date("Y-m-d");
	$user = mysqli_query($link,"SELECT points FROM users WHERE username='$username'");
	$res = mysqli_fetch_assoc($user);
    $points = 100*$entry_fee;
    //echo $points;
	if($res['points']<$points){
	    $response['error'] = "points";
		$response['message'] = "Not Enough Points Please Add Coins ";
		print_r(json_encode($response));
		return false;
	}
	$game_name = mysqli_query($link,"SELECT name FROM tbl_game WHERE id='$tbl_game_id'");
	$name = mysqli_fetch_assoc($game_name);
	$game_name = $name['name'];
	$check = mysqli_query($link,"SELECT username FROM tbl_contest_game_joined WHERE username='$username' AND tbl_game_id='$tbl_game_id' ");
	$row = mysqli_num_rows($check);
    $total = mysqli_query($link,"UPDATE tbl_game SET total_player=total_player+1 WHERE id='$tbl_game_id'");
	if($row>=1){
	    $update = mysqli_query($link,"UPDATE tbl_contest_game_joined SET entry_date='$date',lose=lose+1 WHERE username='$username' AND tbl_game_id ='$tbl_game_id'");
    	    if($update){
    	        $user_point = mysqli_query($link,"UPDATE users SET points = points-'$points' WHERE username='$username'");
    	        $tracker = mysqli_query($link,"INSERT INTO tracker SET username='$username',points=-'$points',type='$game_name',date='$date', transation='$tbl_game_id',time='$time'");
    	        $response['error'] = false;
        		$response['message'] = "Join Successfull";
    	    }else {
    	        $response['error'] = true;
    		    $response['message'] = "Join Failed";
    	    }
	}else {
	    $insert = mysqli_query($link,"INSERT INTO tbl_contest_game_joined SET username='$username',lose = 1, tbl_game_id='$tbl_game_id',entry_date='$date'");
	     if($insert){
	        $user_point = mysqli_query($link,"UPDATE users SET points = points-'$points' WHERE username='$username'");
    	   $tracker = mysqli_query($link,"INSERT INTO tracker SET username='$username',points=-'$points',type='$game_name', transation='$tbl_game_id',date='$date',time='$time'");
    	    $response['error'] = false;
    		$response['message'] = "Join Successfull";
	    }else {
	        $response['error'] = true;
		    $response['message'] = "Join Failed";
	    }
	}

    print_r(json_encode($response));
}else


if(isset($access_key) && isset($my_free_game_win)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$point = $win*100;
	$date = date("Y-m-d");
	$recent = mysqli_query($link,"SELECT * FROM tbl_recent_player WHERE username='$username'");
	if(mysqli_num_rows($recent)>0){
	    $r_update = mysqli_query($link,"UPDATE tbl_recent_player SET point='$point',total_play = total_play+1,entry_date='$date',game_id='$game_id' WHERE username='$username'");
	    $join_update = mysqli_query($link,"UPDATE tbl_contest_game_joined SET win = win+1 WHERE tbl_game_id='$game_id' AND username='$username'");
	    $game = mysqli_query($link,"UPDATE tbl_game SET last_winner='$username' WHERE id='$game_id' ");

	}else {
	   $r_update = mysqli_query($link,"INSERT INTO tbl_recent_player SET point='$point',total_play = total_play+1, entry_date='$date',game_id='$game_id', username='$username'");
	    $join_update = mysqli_query($link,"UPDATE tbl_contest_game_joined SET win = win+1 WHERE tbl_game_id='$game_id' AND username='$username'");
	   $game = mysqli_query($link,"UPDATE tbl_game SET last_winner='$username' WHERE id='$game_id' ");
	}

	$response['error']="false";
	$response['message']="Successfully Updated";
	print_r(json_encode($response));
}else



if(isset($access_key) && isset($my_featured_game_win)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$point = $win*100;
	$date = date("Y-m-d");
	$recent = mysqli_query($link,"SELECT * FROM tbl_recent_player WHERE username='$username'");
	if(mysqli_num_rows($recent)>0){


	    $r_update = mysqli_query($link,"UPDATE tbl_recent_player SET point='$point',total_play = total_play+1,entry_date='$date',game_id='$game_id' WHERE username='$username'");
	    $join_update = mysqli_query($link,"UPDATE tbl_featured_game_joined SET win = win+1 WHERE tbl_featured_id='$game_id' AND username='$username'");


	}else {
	    $r_update = mysqli_query($link,"INSERT INTO tbl_recent_player SET point='$point',total_play = 1,entry_date='$date',game_id='$game_id',username='$username'");
	    $join_update = mysqli_query($link,"UPDATE tbl_featured_game_joined SET win = win+1 WHERE tbl_featured_id='$game_id' AND username='$username'");


	}

	$response['error']="false";
	$response['message']="Successfully Updated";
	print_r(json_encode($response));

}else
//13 Get Total Win or Played
if(isset($access_key) && isset($total_win)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$contest = mysqli_query($link,"SELECT win,lose FROM tbl_contest_game_joined WHERE username='$username'");

	$featured = mysqli_query($link,"SELECT win,lose FROM tbl_featured_game_joined WHERE username='$username'");
	$win1=0;
	$lose1 = 0;
	while($f = mysqli_fetch_assoc($featured)){
	    $win1 = $win1+$f['win'];
	    $lose1 = $lose1+$f['lose'];
	}
	while($c = mysqli_fetch_assoc($contest)){
	    $win1 = $win1+$c['win'];
	    $lose1 = $lose1+$c['lose'];
	}


	$total_play = $lose1;
	$total_win = $win1;
	$response['error'] = "false";
	$response['message'] = "Game Played Data";
	$response['total_play'] = $total_play;
	$response['total_win'] = $total_win;
	print_r(json_encode($response));

}else
//14 Update Profile icon
if(isset($access_key) && isset($update_profile1)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

	    $sql = mysqli_query($link,"UPDATE users SET image='$icon' WHERE username='$username'");
    	$select = mysqli_query($link,"SELECT * FROM users WHERE username='$username'");
    	$res = mysqli_fetch_assoc($select);
        if($sql){
            $response['error']=false;
            $response['message']="Succesfull Updated";
            $response['data']=$res;
        }else {
             $response['error']=true;
            $response['message']="Update Failed";
        }



	echo json_encode($response);
}else
//14 Get Profile
if(isset($access_key) && isset($get_profile)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"SELECT * FROM tbl_profile");
	$data = array();
	while($res=mysqli_fetch_assoc($sql)){
	    $data[]=$res;

	}
	echo json_encode((['get_profile' => $data]));
}else
// 7. set_refer_status() - set the refer status if referral code redemption is done
if(isset($access_key) && isset($set_refer_status)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

		    $sql = mysqli_query($link,"UPDATE `users` SET `refer_status`='".$refer_status."' WHERE `username`='".$username."'");

		    if($sql){

    			$response['error'] = "false";
    	        $response['message'] = " Refer Status set successfully";

		    }else {
	            $response['error'] = "true";
	            $response['message'] = "Refer Enable to set";
	        }

	print_r(json_encode($response));
}else
// 8. get_refer_status() - get the refer status to check if referral code redemption is done
if(isset($access_key) && isset($get_refer_status)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
		$sql = mysqli_query($link,"select `refer_status` from `users` WHERE `email`='".$email."'");
		$result = mysqli_fetch_assoc($sql);
		$response['error'] = "false";
    	$response['refer_status'] = $result['refer_status'];
	    print_r(json_encode($response));
}else

// 9. update_profile() - update user profile

if(isset($access_key) && isset($update_profile)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

    $sql = mysqli_query($link,"UPDATE users SET email='$email',phone='$phone',name='$name' WHERE username='$username'");
	$select = mysqli_query($link,"SELECT * FROM users WHERE username='$username'");
	$data = mysqli_fetch_assoc($select);
	if($sql){
	$response['error'] = "false";
	$response['message'] = " Profile updated successfully";
	$response['data']=$data;
	}else {
	    $response['error'] = "true";
	    $response['message'] = " Profile Not Upateded! Try Again";
	}
	print_r(json_encode($response));


}else
// 10. user_tracker() - get login details by user's username
if(isset($access_key) && isset($user_tracker)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
		$sql = mysqli_query($link,"SELECT MAX(id) as id,date FROM `tracker` WHERE username='".$username."' and points=0 and type='claim' ");
		$result = mysqli_fetch_assoc($sql);

		if(empty($result) || $result['id'] == ''){
			$sql = mysqli_query($link,"SELECT Min(id) as id,date FROM `tracker` WHERE username='".$username."'");
			$result = mysqli_fetch_assoc($sql);
		}

		$id = $result['id'];
		$date = date('d-M-Y', strtotime($result['date']));
		$sql = mysqli_query($link,"SELECT * FROM `tracker` where id >= '".$id."' and `username`='".$username."' ORDER BY `id` DESC LIMIT 30");
		$rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }

		if (!empty($rows)) {
			$response['error'] = "false";
			$response['message'] = "Tracking history from ".$date." onwards";
			$response['data'] = $rows;
		}else{
			$response['error'] = "true";
			$response['message'] = "No tracking history found!";
		}

	print_r(json_encode($response));
}else

//3. daily_checkin - Daily checkin of user and Add Spin Points to user account
if(isset($access_key) && isset($daily_checkin)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

		$sql = mysqli_query($link,"select id from tracker where `username`='".$username."' and (`type`='Daily checkin bonus' or `type`='Daily checkin') and date(`date`)='".date('Y-m-d')."'");
		$result = mysqli_fetch_assoc($sql);

		$set_sql = mysqli_query($link,"select daily_b_points from settings");
		$result_b = mysqli_fetch_assoc($set_sql);

		if(mysqli_num_rows($sql)>0){

			$response['error'] = true;
			$response['message'] = "You've already claim your daily bonus!";
			$response['id'] = $result['id'];
		    $response['points'] = $result_b['daily_b_points'];

		} else {
		      $response['error'] = false;
	    	  $response['message'] = "Spin Available";
	    	  $response['id'] = $result['id'];
	    	  $response['points'] = $result_b['daily_b_points'];
		}


	    	print_r(json_encode($response));
}
else

// 12. get_payment_requests() - get user's payment requests
if(isset($access_key) && isset($get_payment_requests)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
    	$sql = mysqli_query($link,"SELECT * FROM `payment_requests` WHERE username='$username'");

	    $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }

		if (!empty($sql)) {
			$response['error'] = "false";
			$response['data'] = $rows;
		}else{
			$response['error'] = "true";
			$response['message'] = "No data found!";
		}

		print_r(json_encode($response));
}else
// 13. update_fcm_id() - update user's fcm id
if(isset($access_key) && isset($update_fcm_id)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"UPDATE `users` SET `fcm_id`='".$fcm_id."' WHERE `username`='".$username."'");
	$response['error'] = "false";
	$response['message'] = "FCM ID updated successfully";
	print_r(json_encode($response));
}
///

else



// Get Game List////////////////////////////////////
if(isset($access_key) && isset($my_game)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
         $sql=mysqli_query($link,"select * from game_list");

        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
            $game_id = $r['id'];
            $user = mysqli_query($link,"SELECT * FROM tbl_game_history WHERE game_id='$game_id' AND username='$username'");
            $res = mysqli_fetch_assoc($user);
            $data = array("replay"=>$res['replay'],"total_earning"=>$res['total_earning']);
            $rows[] = $r+$data;
        }
       echo json_encode((['feed' => $rows]));

}

else
//////////////// GetActivity Data

if(isset($access_key) && isset($activity)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
         $sql = mysqli_query($link,"SELECT * FROM notifications ORDER BY id DESC");
         //////
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }

        echo json_encode((['feed' => $rows]));
}
else
// Insert Paid or Free Game Statics
if(isset($access_key) && isset($count_play)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	    if($free_game) {
	        $sql = mysqli_query($link,"UPDATE game_list SET free = free+1 WHERE id = '$id'");
	    } else {
	        $sql = mysqli_query($link,"UPDATE game_list SET paid = paid+1 WHERE id = '$id'");
	    }

         //////
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }

        echo json_encode((['feed' => $rows]));
}
else
//my Join Game
if(isset($access_key) && isset($my_join_game)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$check = mysqli_query($link,"SELECT * FROM tbl_game_history WHERE username='$username' AND game_id='$game_id'");
	$res = mysqli_num_rows($check);
	if($res==1){
	    $update = mysqli_query($link,"UPDATE tbl_game_history set replay=replay+1 ,total_earning=total_earning+'$total_earning' WHERE username='$username' AND game_id='$game_id'");
	    if($update){
	        $response['error']=false;
	        $response['message']="Updated";
	    }else {
	         $response['error']=true;
	        $response['message']="Failed";
	    }
	}else {
	     $insert = mysqli_query($link,"INSERT INTO tbl_game_history SET replay=1,total_earning='$total_earning', username='$username', game_id='$game_id'");
	     if($insert){
	        $response['error']=false;
	        $response['message']="Inserted";
	    }else {
	         $response['error']=true;
	        $response['message']="Failed";
	    }
	}
	print_r(json_encode($response));
}
else
/// Get Leaderboad
if(isset($access_key) && isset($leaderboard)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"SELECT points,image,name FROM users ORDER BY points DESC limit 10");

	    $rows = array();
	        $i=1;
            $rank=1;
            $flag="";
        while($r = mysqli_fetch_assoc($sql)) {
                        $pre=$r['points'];
                          if($flag!=$pre){
                               $flag=$pre;
                              if($i!=1){
                                 $rank=$i;
                                      //echo "count<br />";
                                    }
                                $i++;
                               $rank = ["rank"=>$rank];
                            }else{
                               $rank = $rank;
                            }
         $rows[] = $r + $rank;
        }
        echo json_encode((['feed' => $rows]));

}
/*else
//get Admob Id
if(isset($access_key) && isset($admob)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"SELECT * FROM admob");

	    $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
        echo json_encode((['feed' => $rows]));

}*/
//update password
else
if(isset($access_key) && isset($battle_contest)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

    $select = mysqli_query($link,"SELECT * FROM tbl_game_category WHERE status!=1");
    $category=array();
    while($res=mysqli_fetch_assoc($select)){
        $category[]=$res;
    }
    $id_data = mysqli_query($link,"SELECT * FROM tbl_game WHERE tbl_game_id='$tbl_category_id' AND status!=1");
    $contest = array();
    while($r=mysqli_fetch_assoc($id_data)){
        $contest[]=$r;
    }

   echo json_encode((['contest' => $contest,'all_game'=>$category]));

}
else
/// update badege

if(isset($access_key) && isset($update_badge)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql= mysqli_query($link, "UPDATE users SET badge = 0 WHERE username='$username'");

}
else
//////////////////////

if(isset($access_key) && isset($user_point_update)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	        $update = mysqli_query($link,"SELECT * FROM users WHERE username='$username'");
	        $new = mysqli_query($link,"UPDATE users SET fcm_id = '$fcm_id' WHERE username='$username'");
	        $data = mysqli_fetch_assoc($update);

			$response['error'] = "false";
			$response['message'] = "Successfully logged in";
			$response['data'] =$data;
			print_r(json_encode($response));
   }

else

////////////////

////////////get Banner

if(isset($access_key) && isset($banner)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"SELECT * FROM banner");

	    $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
           /* $username = $r['username'];
            $user = mysqli_query($link,"SELECT name,image FROM users WHERE username='$username'");
            $res = mysqli_fetch_assoc($user);
            $da = $res;*/
             $rows[] = $r;
    }
    $feature = mysqli_query($link,"SELECT * FROM tbl_featured_item WHERE status!=1");
        $data = array();
        while($d=mysqli_fetch_assoc($feature)){
            $data[]=$d;

        }
    $allgame= mysqli_query($link,"SELECT * FROM tbl_game_category WHERE status!=1");
    $game = array();
    while($g=mysqli_fetch_assoc($allgame)){

        $game[]=$g;

    }
        echo json_encode((['banner' => $rows,'featured_item'=>$data,'all_game'=>$game]));

}
else
/////Check Update//////////////////
if(isset($access_key) && isset($update_version)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"SELECT * FROM tbl_update");

	$res = mysqli_fetch_assoc($sql);
	if($res['version']>$version) {
	    $response['error'] = "false";
	    $response['message'] = "Update Available";
	} else {
	    $response['error'] = "true";
	    $response['message'] = "You Are Using Latest Version of App";
	}

	 print_r(json_encode($response));

}else
if(isset($access_key) && isset($support)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"INSERT INTO live_chat SET name='$name',username='$username',phone='$phone',u_message='$subject'");


	if($sql) {
	    $response['error'] = "false";
	    //$response['message'] = "Update Available";
	} else {
	    $response['error'] = "true";
	   // $response['message'] = "You Are Using Latest Version of App";
	}

	 print_r(json_encode($response));
}

if(isset($offers) && isset($access_key)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$get_offers = "SELECT * FROM offers WHERE status='0'";
	$send_offers = mysqli_query($link,$get_offers);

	$result = mysqli_fetch_assoc($send_offers);
//	$r_row = mysqli_fetch_array($r_url)
		if(mysqli_num_rows($send_offers)>0) {
		    $response['error'] = "false";
			$response['data'] = $result;

		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}


// hereeeeeeeeeee

if(isset($task) && isset($access_key) && isset($id)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$user = array();
      $sql="SELECT * FROM ref_achi";
      $result=mysqli_query($link,$sql);

	//$result = mysqli_fetch_assoc($send_offers);
//	$r_row = mysqli_fetch_array($r_url)
		if(mysqli_num_rows($result)>0) {

		    $response['error'] = "false";


			while($raw = mysqli_fetch_assoc($result)){
            $index['id'] = $raw['id'];
            $index['invites'] = $raw['invites'];
            $index['points'] = $raw['points'];
            $t_id = $raw['id'];

    $check_sql="SELECT * FROM ref_claim WHERE achi_id =".$t_id." AND u_id =".$id;
    $check_result=mysqli_query($link,$check_sql);
    if(mysqli_num_rows($check_result)>0) {
		    $index['check'] = "true";
    }else
    {
        $index['check'] = "false";
    }



    array_push($user,$index);
}
         $response['data'] = $user;
         $ref_sql="SELECT total_ref, task FROM users WHERE id =".$id;
         $ref_result=mysqli_query($link,$ref_sql);
         $ref_raw = mysqli_fetch_assoc($ref_result);
         $response['ref'] =$ref_raw['total_ref'];
         $response['task'] =$ref_raw['task'];


         $set_sql="SELECT * FROM settings";
         $set_result=mysqli_query($link,$set_sql);
         $set_raw = mysqli_fetch_assoc($set_result);
         $response['msg'] =$set_raw['refer_msg'];
         $response['bonus'] =$set_raw['invited_user_bonus'];

         $total_sql="SELECT * FROM reward_list WHERE u_id = '$id' AND status = '1'";
         $total_result=mysqli_query($link,$total_sql);
         $response['re'] = mysqli_num_rows($total_result);


		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}

if(isset($task_claim) && isset($access_key) && isset($id)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$get_offers = "SELECT * FROM ref_claim WHERE achi_id=".$task_claim."AND u_id=".$id;
	$send_offers = mysqli_query($link,$get_offers);
//	$result = mysqli_fetch_assoc($send_offers);
//	$r_row = mysqli_fetch_array($r_url)
		if(!mysqli_num_rows($send_offers)>0) {


		    $get_achi = "SELECT * FROM ref_achi WHERE id=".$task_claim;
	        $send_achi = mysqli_query($link,$get_achi);
	        if(mysqli_num_rows($send_achi)>0) {
	            $result = mysqli_fetch_assoc($send_achi);
	            $invites = $result['invites'];


	        $get_user = "SELECT * FROM users WHERE id=".$id;
	        $send_user = mysqli_query($link,$get_user);
	        $user = mysqli_fetch_assoc($send_user);
	        $user_ref = $user['total_ref'];

	        if(mysqli_num_rows($send_user)>0 && $user_ref>=$invites){


	      $adding_claim_record = 'INSERT INTO `ref_claim`(`achi_id`, `u_id`) VALUES
        	("'.$task_claim.'","'.$id.'")';
    	  $db = mysqli_query($link,$adding_claim_record);
    	  $pls = $result['points'];

    	  if($db)
    	  {
    	       $response['error'] = "false";

    	  $refer_point = "UPDATE `users` SET `points`= `points`+'$pls' WHERE id=".$id;
        	$db = mysqli_query($link,$refer_point);

	            $time = date("h:i a");
	           $adding_tracking_record = 'INSERT INTO `tracker`(`username`, `points`, `type`, `date`,`time`) VALUES
    	("'.$user['username'].'","'.$pls.'","Referral task credit","'.date('Y-m-d').'","'.$time.'")';
    	  $db = mysqli_query($link,$adding_tracking_record);
    	  $response['error'] = "false";
    	  $response['p'] = $pls;
    	  }
	        }

	        }







		} else {
		    $response['error'] = "true";
			$response['message'] = "error!";
			$response['p'] = "not";
		}

	print_r(json_encode($response));
}





if(isset($reward) && isset($access_key) && isset($id)) {
    $response = array();
     if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	 $user = array();
	 $amounts = array();
	$get_reward = "SELECT * FROM reward";
	$send_reward = mysqli_query($link,$get_reward);

		while($raw = mysqli_fetch_assoc($send_reward)){
            $index['id'] = $raw['id'];
            $idd = $raw['id'];
            $index['name'] = $raw['name'];
            $index['image'] = $raw['image'];
            $index['symbol'] = $raw['symbol'];
            $index['hint'] = $raw['hint'];
            $index['input_type'] = $raw['input_type'];
            $index['details'] = $raw['details'];
            $get_amount = "select * from reward_amounts where r_id = '$idd' order by cast(coins as unsigned)";
	        $send_amount = mysqli_query($link,$get_amount);
	        $count=0;
	        while($amount_raw = mysqli_fetch_assoc($send_amount)){
	            if($count==0)
	            {
	                $index['minimum'] = $amount_raw['coins'];
	            }
	            $count++;
	            $amount_index['id'] = $amount_raw['id'];
	            $amount_index['r_id'] = $amount_raw['r_id'];
	            $amount_index['coins'] = $amount_raw['coins'];
	            $amount_index['amount'] = $amount_raw['amount'];
	            array_push($amounts,$amount_index);
	        }

	        if(mysqli_num_rows($send_amount)>0){
             $index['amounts'] = $amounts;
             array_push($user,$index);
             $amounts = array();
	        }

		}
		 $get_amount = "select * from reward_amounts order by cast(coins as unsigned)";
	        $send_amount = mysqli_query($link,$get_amount);
	        $amount_raw = mysqli_fetch_assoc($send_amount);
//	$r_row = mysqli_fetch_array($r_url)

		if(mysqli_num_rows($send_reward)>0) {

		 $ref_sql="SELECT total_ref, task FROM users WHERE id =".$id;
         $ref_result=mysqli_query($link,$ref_sql);
         $ref_raw = mysqli_fetch_assoc($ref_result);
         $response['ref'] =$ref_raw['total_ref'];
          $response['task'] =$ref_raw['task'];

         $total_sql="SELECT * FROM reward_list WHERE u_id = '$id' AND status = '1'";
         $total_result=mysqli_query($link,$total_sql);
         $response['re'] = mysqli_num_rows($total_result);

		    $response['error'] = "false";
		    $response['minimum'] = $amount_raw['coins'];
			$response['data'] = $user;

		//	$response['amounts'] = $amounts;

		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}

if(isset($id) && isset($access_key) && isset($redeem)&& isset($p_details)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$get_offers = "SELECT * FROM users WHERE id=".$id;
	$send_offers = mysqli_query($link,$get_offers);
	$result = mysqli_fetch_assoc($send_offers);
//	$r_row = mysqli_fetch_array($r_url)
		if(mysqli_num_rows($send_offers)>0) {
		    	$get_package = "SELECT * FROM reward WHERE id=".$redeem;
            	$send_package = mysqli_query($link,$get_package);
            	$package_r = mysqli_fetch_assoc($send_package);

            	if(mysqli_num_rows($send_package)>0) {

            	    $avai_coins=$result['points'];
            	    $name=$package_r['name'];
            	    $p_id=$package_r['id'];
            	    $uid=$result['id'];
            	    $symb=$package_r['symbol'];
            	    $date =date('Y-m-d');
            	    $time = date("h:i a");

                	$getAmount = "SELECT * FROM reward_amounts WHERE r_id=".$redeem." AND id = ".$amount_id;
                	$amount_sql = mysqli_query($link,$getAmount);
                	$amountt = mysqli_fetch_assoc($amount_sql);
                	if(mysqli_num_rows($amount_sql)>0) {
                	   $amount = $amountt['amount'];
                	   $coins = $amountt['coins'];


            	    if($avai_coins>=$coins)
            	    {
            	        	$refer_point = "UPDATE `users` SET `points`= `points`-'$coins' WHERE id=".$id;
    						$db = mysqli_query($link,$refer_point);
    						if($db)
    						{
    						    	$register_user = "INSERT INTO reward_list (u_id,package_name,amount,date,time,status,package_id,symbol,coins_used,p_details) VALUES ('$uid','$name','$amount','$date','$time','0','$p_id','$symb','$coins','$p_details')";
	                                $send_server= mysqli_query($link,$register_user);

	                                 $response['error'] = "false";
		                             $response['message'] = "Redeem successfully.";

    						}else
            	    {
            	         $response['error'] = "true";
		                $response['message'] = "Error to redeem package";
            	    }
            	    }else
            	    {
            	         $response['error'] = "true";
		                	$response['message'] = "Not enough points available to redeem";
            	    }


                	}

            	}else
            	{
            	    $response['error'] = "true";
		                	$response['message'] = "No package available";
            	}





		    $response['error'] = "false";
			$response['data'] = $result;

		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}

if(isset($spinner) && isset($access_key) && isset($usernamee)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

	$get_offers = "SELECT daily_spins FROM settings";
	$send_offers = mysqli_query($link,$get_offers);


	$result = mysqli_fetch_assoc($send_offers);
//	$r_row = mysqli_fetch_array($r_url)
		if(mysqli_num_rows($send_offers)>0) {
		    $date =date('Y-m-d');
		    $sql= mysqli_query($link,"SELECT * FROM `tracker` where (`type`='Spin & Win Reward') and `username` = '$usernamee' and date(`date`)='".date('Y-m-d')."'");
		$res = mysqli_fetch_assoc($sql);
		$tracker = mysqli_num_rows($sql);
		    /*	$get_tracker = "SELECT * FROM tracker WHERE username=".'gouravsharma2444'."AND type='Spin & Win Reward' AND date=".$date;
	            $send_tracker = mysqli_query($link,$get_tracker);
	            	$tracker = mysqli_fetch_assoc($send_tracker);*/


		    $response['error'] = "false";
			$response['daily'] = $result['daily_spins'];
			$response['left'] = $tracker;

		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}


if(isset($settings) && isset($access_key)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$user = array();

		  	$sql = "SELECT * FROM settings";
		  	$hm = mysqli_query($link,$sql);
		$res = mysqli_fetch_assoc($hm);


		 	$adget_sql = "SELECT * FROM offers WHERE status=0 AND offer_name='toro'";
		 	$hm = mysqli_query($link,$adget_sql);
		 	if(mysqli_num_rows($hm)>0)
		 	{
		 	   $index['check_ot'] = "0";
		 	}else
		 	{
		 	     $index['check_ot'] = "1";
		 	}

		 	$adget_sql = "SELECT * FROM offers WHERE status=0 AND offer_name='adget'";
		  	$hm = mysqli_query($link,$adget_sql);
		 	if(mysqli_num_rows($hm)>0)
		 		{
		 	   $index['check_ag'] = "0";
		 	}else
		 	{
		 	     $index['check_ag'] = "1";
		 	}

		 	$adget_sql = "SELECT * FROM offers WHERE status=0 AND offer_name='poll'";
		 	 	$hm = mysqli_query($link,$adget_sql);
		 	if(mysqli_num_rows($hm)>0)
		 	{
		 	   $index['check_p'] = "0";
		 	}else
		 	{
		 	     $index['check_p'] = "1";
		 	}


            $index['OT_APP_ID'] = $res['OT_APP_ID'];
            $index['OT_KEY'] = $res['OT_KEY'];
            $index['PF_ID'] = $res['PF_ID'];
            $index['AG_WALLCODE'] = $res['AG_WALLCODE'];
            $index['fb_ad_time'] = $res['fb_ad_time'];
            $index['fb_ad_id'] = $res['fb_ad_id'];
             array_push($user,$index);



		    $response['error'] = "false";

		    $response['set'] = $user;




	print_r(json_encode($response));
}
       if(isset($reward_count) && isset($access_key)) {
         $total_sql="SELECT * FROM reward_list WHERE u_id = '$reward_count'";
         $total_result=mysqli_query($link,$total_sql);
         $response['re'] = mysqli_num_rows($total_result);

         $total_earn_sql="SELECT * FROM tracker WHERE username = '$user'";
         $total_earn_result=mysqli_query($link,$total_earn_sql);
        // $response['re'] = mysqli_num_rows($total_result);
         if(mysqli_num_rows($total_earn_result)>0)
         {
            $earn = 0;
            while($res_earn = mysqli_fetch_assoc($total_earn_result))
            {
                $earn+=$res_earn['points'];
            }
         }else
         {
            $earn = 0; 
         }
         $response['earn'] = $earn;

         print_r(json_encode($response));
       }



if(isset($game) && isset($access_key)) {
    $response = array();
   if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	 $user = array();
	$get_reward = "SELECT * FROM games";
	$send_reward = mysqli_query($link,$get_reward);

		while($raw = mysqli_fetch_assoc($send_reward)){
            $index['id'] = $raw['id'];
            $index['title'] = $raw['title'];
            $index['image'] = $raw['image'];
            $index['game'] = $raw['game'];
             array_push($user,$index);
		}

			$sql= mysqli_query($link,"SELECT * FROM `tracker` where (`type`='Game Zone' or `type`='GameZone') and `username` = '$usser' and date(`date`)='".date('Y-m-d')."'");
		$res = mysqli_fetch_assoc($sql);

//	$result = mysqli_fetch_assoc($res);
//	$r_row = mysqli_fetch_array($r_url)
	$get_set = "SELECT games FROM settings";
            	$send_set = mysqli_query($link,$get_set);
            	$raw_set = mysqli_fetch_assoc($send_set);
		if(mysqli_num_rows($sql)>0) {
			$response['played'] = mysqli_num_rows($sql);
			$response['limit'] = $raw_set['games'];

		} else {
		   	$response['played'] = 0;
			$response['limit'] =$raw_set['games'];
		}


		if(mysqli_num_rows($send_reward)>0) {

		    $response['error'] = "false";
			$response['data'] = $user;

		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}

if (isset($check_zone) && isset($access_key)) { $response = array(); if ($key != $access_key) { $response["\145\162\162\157\162"] = "\164\162\x75\145"; $response["\155\x65\163\x73\141\x67\x65"] = "\x49\x6e\166\141\154\x69\x64\40\x41\x63\x63\x65\163\163\40\x4b\x65\171"; print_r(json_encode($response)); return false; } $get_offers = "\x53\105\114\105\x43\124\40\x67\141\x6d\145\163\x20\106\122\117\115\x20\163\x65\164\x74\151\156\x67\x73"; $send_offers = mysqli_query($link, $get_offers); $sql = mysqli_query($link, "\x53\105\x4c\105\x43\x54\40\52\40\x46\x52\117\115\40\140\164\x72\x61\143\153\x65\162\140\x20\x77\150\x65\162\x65\x20\x28\x60\164\x79\160\x65\x60\x3d\47\x47\141\155\x65\x20\x5a\157\156\145\x27\x20\157\x72\40\x60\x74\x79\160\x65\140\75\x27\x47\141\x6d\145\x5a\157\x6e\145\47\x29\40\141\156\144\40\x60\x75\x73\x65\162\156\x61\x6d\145\140\40\x3d\40\x27{$check_zone}\47\x20\x61\x6e\144\x20\144\x61\164\x65\50\140\x64\x61\164\145\140\x29\75\47" . date("\x59\x2d\155\55\x64") . "\x27"); $res = mysqli_fetch_assoc($sql); $result = mysqli_fetch_assoc($send_offers); if (mysqli_num_rows($send_offers) > 0) { if (mysqli_num_rows($sql) >= $result["\147\x61\x6d\x65\x73"]) { $response["\x65\162\162\x6f\162"] = "\164\x72\165\145"; $response["\155\x73\x67"] = "\131\x6f\x75\x72\40\x64\x61\151\x6c\171\40\154\x69\155\151\x74\40\150\141\x73\x20\142\145\x65\x6e\40\162\x65\141\x63\x68\145\x64\x2c\40\124\x6f\x20\x70\154\141\171\40\x67\141\155\145\163\x20\143\x6f\155\145\40\x61\x67\x61\151\x6e\x20\x74\157\155\157\162\x72\157\167\x20\x6f\162\x20\x79\157\x75\40\x63\141\156\x20\x70\x6c\141\171\x20\x66\x6f\162\40\x6f\x6e\x6c\171\40\x66\x75\156\41"; } else { $response["\145\x72\162\157\162"] = "\x66\141\154\163\145"; $response["\147\x61\155\x65\x73"] = $result["\147\x61\155\x65\163"]; } $response["\x70\x6c\x61\171\145\144"] = mysqli_num_rows($sql); $response["\x6c\151\155\x69\x74"] = 2; } else { $response["\x65\x72\x72\157\162"] = "\164\x72\x75\x65"; $response["\155\163\x67"] = "\116\x6f\40\x64\141\x74\141\x20\x66\x6f\165\156\144\x21"; } print_r(json_encode($response)); } if (isset($c) && isset($access_key)) { $response = array(); if ($key != $access_key) { $response["\x65\x72\x72\x6f\x72"] = "\60"; $response["\x6d\x65\163\163\141\x67\x65"] = "\111\156\x76\141\154\151\144\x20\x41\143\143\145\x73\x73\x20\x4b\145\x79"; print_r(json_encode($response)); return false; } $get_reward = "\x53\x45\114\105\103\x54\40\166\160\156\x20\x46\122\117\x4d\40\x73\145\x74\x74\x69\156\x67\163"; $send_reward = mysqli_query($link, $get_reward); if (c()) { $response["\x65\x72\x72\157\x72"] = "\x31"; } else { $response["\145\162\162\x6f\162"] = "\60"; } $raw = mysqli_fetch_assoc($send_reward); $response["\166\160\156"] = $raw["\166\x70\x6e"]; print_r(json_encode($response)); } if (isset($redeem_check) && isset($access_key)) { $response = array(); if ($key != $access_key) { $response["\145\162\162\157\162"] = "\x74\x72\x75\145"; $response["\155\x65\163\x73\x61\147\x65"] = "\111\x6e\x76\141\154\x69\x64\x20\x41\x63\x63\x65\163\163\x20\113\145\x79"; print_r(json_encode($response)); return false; } $user = array(); $get_reward = "\123\x45\x4c\105\103\x54\x20\x2a\x20\106\122\117\x4d\40\x72\145\167\x61\162\x64\x5f\154\x69\x73\164\40\x57\110\105\x52\105\40\165\x5f\151\x64\40\x3d\40\x27{$redeem_check}\x27"; $send_reward = mysqli_query($link, $get_reward); while ($raw = mysqli_fetch_assoc($send_reward)) { $index["\151\144"] = $raw["\x69\144"]; $index["\x75\x5f\151\x64"] = $raw["\165\137\x69\x64"]; $index["\x70\x61\x63\153\x61\x67\145\x5f\156\141\x6d\145"] = $raw["\160\x61\143\153\141\147\x65\x5f\156\141\155\x65"]; $index["\x70\137\x64\x65\164\x61\151\x6c\x73"] = $raw["\x70\x5f\144\145\164\141\151\154\163"]; $index["\143\x6f\x69\x6e\x73\x5f\x75\163\145\x64"] = $raw["\x63\157\x69\x6e\x73\x5f\x75\x73\x65\144"]; $index["\163\x79\x6d\142\x6f\x6c"] = $raw["\x73\171\x6d\x62\x6f\x6c"]; $index["\141\155\157\165\156\164"] = $raw["\x61\155\157\165\x6e\164"]; $index["\x74\x69\155\145"] = $raw["\164\151\x6d\x65"]; $index["\x64\141\164\x65"] = $raw["\144\141\x74\145"]; $index["\163\x74\x61\x74\165\163"] = $raw["\163\164\x61\x74\165\163"]; $index["\x70\141\143\x6b\141\147\145\137\x69\144"] = $raw["\x70\x61\x63\153\x61\147\x65\x5f\151\x64"]; $get_img = "\x53\x45\x4c\x45\x43\x54\x20\x2a\x20\x46\x52\117\x4d\x20\x72\145\x77\x61\x72\144\40\x57\x48\x45\122\x45\x20\151\x64\x20\75\40" . $raw["\x70\x61\143\x6b\141\147\x65\x5f\x69\144"]; $send_img = mysqli_query($link, $get_img); $img = mysqli_fetch_assoc($send_img); $index["\151\155\141\147\x65"] = $img["\151\155\x61\x67\x65"]; array_push($user, $index); } if (mysqli_num_rows($send_reward) > 0) { $response["\x65\162\162\157\162"] = "\x66\x61\154\x73\145"; $response["\x64\x61\x74\141"] = $user; } else { $response["\145\162\162\x6f\x72"] = "\x74\x72\x75\x65"; $response["\x6d\145\163\x73\141\x67\145"] = "\116\x6f\x20\x64\x61\164\x61\40\146\x6f\165\156\144\x21"; } print_r(json_encode($response)); } 




if(isset($access_key) && isset($daily_login) && isset($for_what)){
  $response = array();
   if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}



	      $day = date('D');

                if($day=="Mon")
            {
               $day="Monday";
            }elseif($day=="Tue")
            {
               $day="Tuesday";

            }elseif($day=="Wed")
            {
               $day="Wednesday";

            }elseif($day=="Thu")
            {
               $day="Thursday";

            }elseif($day=="Fri")
            {
               $day="Friday";

            }elseif($day=="Sat")
            {
               $day="Saturday";

            }elseif($day=="Sun") {$day="Sunday";}



             $check_last_date = date('d/m/Y', strtotime("-1 week 6 day"));
         	 $today_date = date('d/m/Y');

         	 if($day=="Monday")
         	 {
         	     $week = 0;
         	 }else
         	 {
         	     $week = -1;
         	 }



	  $start_day = date('l - d/m/Y', strtotime("Monday $week week 0 day"));
	  $start_day = str_replace("Sunday","",$start_day);
	  $start_day = str_replace("Monday","",$start_day);
	  $start_day = str_replace("Tuesday","",$start_day);
	  $start_day = str_replace("Wednesday","",$start_day);
	  $start_day = str_replace("Thursday","",$start_day);
	  $start_day = str_replace("Friday","",$start_day);
	  $start_day = str_replace("Saturday","",$start_day);
	  $start_day = str_replace(" ","",$start_day);
	  $start_day = str_replace("-","",$start_day);
	  $date = date('d/m/Y');

	    $get_str = "SELECT streak, long_streak FROM users WHERE id = '$daily_login'";
	    $send_str = mysqli_query($link,$get_str);

	    $raw = mysqli_fetch_assoc($send_str);

	    $streak = $raw['streak'];
	    $long_streak = $raw['long_streak'];
	   	$response['long_str'] = $long_streak;
	    $pre_date = date('d/m/Y',strtotime("-1 days"));

      if($for_what=="1"){
	    	$get_stre = "SELECT * FROM daily_login WHERE week_start = '$start_day' AND u_id = '$daily_login' AND datee = '$pre_date'";
         	$send_stre = mysqli_query($link,$get_stre);
         	 if(mysqli_num_rows($send_stre)>0) {
         	     	$response['str'] = $raw['streak'];
         	 }else
         	 {
         	     //	$get_stre = "SELECT * FROM daily_login WHERE week_start = '$start_day' AND u_id = '$daily_login' AND datee = ' $date'";
         	     	$get_stre = "SELECT * FROM daily_login WHERE week_start = '$start_day' AND u_id = '$daily_login' AND datee = '$date'";
                	$send_stre = mysqli_query($link,$get_stre);
                		 if(mysqli_num_rows($send_stre)>0) {
                  	$refer_point = "UPDATE `users` SET `streak`= '1' WHERE id=".$daily_login;
    			    $db = mysqli_query($link,$refer_point);
    			    if($db){$response['str'] = 1;}
                		 }else
                		 {
                   $refer_point = "UPDATE `users` SET `streak`= '0' WHERE id=".$daily_login;
    			    $db = mysqli_query($link,$refer_point);
    			    $response['str'] = 0;
                		 }


         	 }

         	 $pars = 0;



		for ($x = 0; $x <= 6; $x++) {

	  $firstday = date('l - d/m/Y', strtotime("Monday $week week $x day"));

	  $firstday = str_replace("Sunday","",$firstday);
	  $firstday = str_replace("Monday","",$firstday);
	  $firstday = str_replace("Tuesday","",$firstday);
	  $firstday = str_replace("Wednesday","",$firstday);
	  $firstday = str_replace("Thursday","",$firstday);
	  $firstday = str_replace("Friday","",$firstday);
	  $firstday = str_replace("Saturday","",$firstday);
	  $firstday = str_replace(" ","",$firstday);
	  $firstday = str_replace("-","",$firstday);

	$get_reward = "SELECT * FROM daily_login WHERE week_start = '$start_day' AND u_id = '$daily_login' AND datee = '$firstday'";
	$send_reward = mysqli_query($link,$get_reward);

//	echo date('d/m/Y')."-";




        if($send_reward){
	    if(mysqli_num_rows($send_reward)>0) {
	        $response["day"."$x"] = "1";// Allready claimed
	        $pars=$pars+1;
	    }else
	    {
	        if($firstday==$date)
	        {
	        $response["day"."$x"] = "4"; //claim day
	        }else
	        {
	             if($firstday<$date){
	        $response["day"."$x"] = "3"; //missed
	    }else
	    {
	         $response["day"."$x"] = "2"; //pending
	    }}

     }
  }else
  {
      	$response['error'] = "true";
		$response['message'] = "Invalid bonus points";
  }
		}

		$response['pars']=cal_percentage($pars, 7);

		$set_sql = mysqli_query($link,"select daily_b_points from settings");
		$result_b = mysqli_fetch_assoc($set_sql);

		if(mysqli_num_rows($set_sql)>0){
		  	$response['error'] = "false";
		    $response['points'] = $result_b['daily_b_points'];
		}else{
		$response['error'] = "true";
		$response['message'] = "Invalid bonus points";
		}

		print_r(json_encode($response));
      }elseif($for_what=="2")
      {
      $end_day = date('l - d/m/Y', strtotime("Monday $week week 6 day"));
      $end_day = str_replace("Sunday","",$end_day);
	  $end_day = str_replace("Monday","",$end_day);
	  $end_day = str_replace("Tuesday","",$end_day);
	  $end_day = str_replace("Wednesday","",$end_day);
	  $end_day = str_replace("Thursday","",$end_day);
	  $end_day = str_replace("Friday","",$end_day);
	  $end_day = str_replace("Saturday","",$end_day);
	  $end_day = str_replace(" ","",$end_day);
	  $end_day = str_replace("-","",$end_day);
	  $date = date('d/m/Y');
          	$register_user = "INSERT INTO daily_login (u_id,datee,week_start,week_end) VALUES ('$daily_login','$date','$start_day','$end_day')";
        	$send_server= mysqli_query($link,$register_user);
        	if($send_server)
        	{
        	    $response['error'] = "false";
        	    $streak=$streak+1;
        	    if($streak>$long_streak){$long_streak=$streak;}
        	    $refer_point = "UPDATE `users` SET  `streak`= '$streak',`long_streak`= '$long_streak' WHERE id = ".$daily_login;
    			    $db = mysqli_query($link,$refer_point);
    			   // if($db){$response['str'] = 0;}
        	}else
        	{
        	    	$response['error'] = "true";
		            $response['message'] = "Database error!";
        	}

        	print_r(json_encode($response));

      }

}



if(isset($get_points) && isset($access_key)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$get_offers = "SELECT points FROM users WHERE id = '$get_points'";
	$send_offers = mysqli_query($link,$get_offers);


	$result = mysqli_fetch_assoc($send_offers);
//	$r_row = mysqli_fetch_array($r_url)
		if(mysqli_num_rows($send_offers)>0) {
		    $response['error'] = "false";
    	$response['points'] = $result['points'];
		} else {
		    $response['error'] = "true";
			$response['msg'] = "No data found!";
		}

	print_r(json_encode($response));
}


if(isset($get_offer_toro) && isset($access_key)) {
//    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

//https://www.offertoro.com/api/?pubid=24120&appid=9959&secretkey=75f50c32a40d588ff610fcc90cd051de&country=in&platform=web&format=xml&device=android

				$get_offers = "SELECT OT_PUB,OT_APP_ID,OT_KEY FROM settings";
				$send_offers = mysqli_query($link,$get_offers);
				$result = mysqli_fetch_assoc($send_offers);

        $ch = curl_init();
        $details = ip_details();
        $url = "https://www.offertoro.com/api/?pubid=".$result['OT_PUB']."&appid=".$result['OT_APP_ID']."&secretkey=".$result['OT_KEY']."&platform=web&format=json&device=android";
          $url =$url."&country=IN";

                $response = file_get_contents($url);
                echo $response;

}

if(isset($leader) && isset($access_key)) {
    $response = array();
   if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	 $user = array();
	$get_reward = "SELECT * FROM `users` ORDER BY `points` DESC LIMIT 10";
	$send_reward = mysqli_query($link,$get_reward);

		while($raw = mysqli_fetch_assoc($send_reward)){
            $index['name'] = $raw['name'];
            $index['image'] = $raw['image'];
            $index['points'] = $raw['points'];
             array_push($user,$index);
		}


		if(mysqli_num_rows($send_reward)>0) {

		    $response['error'] = "false";
			$response['data'] = $user;

		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}

	print_r(json_encode($response));
}


?>

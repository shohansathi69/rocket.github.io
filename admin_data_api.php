<?php include 'connect.php' ; ?>

<?php

if (isset($_POST['edit_offer'])) {
    if(!$demo) {
 $rand = rand();

  if (isset($_FILES["fileToUpload"])) {

if(!$_FILES["fileToUpload"]["name"]=="")
{


  $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]).$rand;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }


        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
       /* if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }*/

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $title = $_POST['title'];
            $sub = $_POST['SubTitle'];
            $status = $_POST['status'];
              $file = url().$target_file;
              if (isset($_POST['url'])) {
                $url = $_POST['url'];
                $update_sql = "UPDATE `offers` SET `title`= '$title', `sub`= '$sub', `status`= '$status', `image`= '$file', `offer_name`= '$url' WHERE id=".$_POST['edit_offer'];
              }else {
                  $update_sql = "UPDATE `offers` SET `title`= '$title', `sub`= '$sub', `status`= '$status', `image`= '$file' WHERE id=".$_POST['edit_offer'];
              }

            $db = mysqli_query($link,$update_sql);
            if ($db) {
            header("Location: ".url());
            }else {echo mysqli_error($link);}

            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
}else {
  $file = url().$target_file;
  $title = $_POST['title'];
  $sub = $_POST['SubTitle'];
  $status = $_POST['status'];
  if (isset($_POST['url'])) {

    $url = $_POST['url'];
    $update_sql = "UPDATE `offers` SET `title`= '$title', `sub`= '$sub', `status`= '$status', `offer_name`= '$url' WHERE id=".$_POST['edit_offer'];
  }else {
      $update_sql = "UPDATE `offers` SET `title`= '$title', `sub`= '$sub', `status`= '$status' WHERE id=".$_POST['edit_offer'];
  }

  $db = mysqli_query($link,$update_sql);
  if ($db) {
  header("Location: ".url());
  }else {echo mysqli_error($link);}

}

 }else {
   $file = url().$target_file;
   $title = $_POST['title'];
   $sub = $_POST['SubTitle'];
   $status = $_POST['status'];
   if (isset($_POST['url'])) {
     $url = $_POST['url'];
     $update_sql = "UPDATE `offers` SET `title`= '$title', `sub`= '$sub', `status`= '$status', `offer_name`= '$url' WHERE id=".$_POST['edit_offer'];
   }else {
       $update_sql = "UPDATE `offers` SET `title`= '$title', `sub`= '$sub', `status`= '$status' WHERE id=".$_POST['edit_offer'];
   }

   $db = mysqli_query($link,$update_sql);
   if ($db) {
   header("Location: ".url());
   }else {echo mysqli_error($link);}

 }


}

else {
    header("Location: ".url());
}


}



if (isset($_POST['add_redeem'])) {
if(!$demo) {
 $rand = rand();
  if (isset($_FILES["fileToUpload"])) {

  $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]).$rand;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }


        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        /*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }*/

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $name = $_POST['name'];
            $symbol = $_POST['symbol'];
            $hint = $_POST['hint'];
            $type = $_POST['type'];
            $more = $_POST['more'];
            $file = url().$target_file;
            $add_r = "INSERT INTO reward (name,image,symbol,hint,input_type,details) VALUES ('$name','$file','$symbol','$hint','$type','$more')";
          	$send_r= mysqli_query($link,$add_r);
            if ($send_r) {
            header("Location: redeem.php");
            }else {echo mysqli_error($link);}

            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }

 }


}else {
    header("Location: redeem.php");
}


}




if (isset($_POST['delt'])) {
    $url = $_POST['url'];
    if(!$demo) {
  $clm_name = $_POST['clm_name'];
  $r_id = $_POST['r_id'];
 $sql = "DELETE FROM $clm_name WHERE id='$r_id'";
  $res = mysqli_query($link, $sql);
if ($res) {
header("Location: ".$url);
} else {
echo "Error deleting record: " . mysqli_error($conn);}
    }else {
        header("Location: ".$url);
    }
}




if (isset($_POST['edit_redeem'])) {

if(!$demo) {


if(!$_FILES["fileToUpload"]["name"]=="")
{
    $rand = rand();


  $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]).$rand;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }


        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
       /* if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }*/

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $name = $_POST['name'];
            $symbol = $_POST['symbol'];
            $hint = $_POST['hint'];
            $type = $_POST['type'];
            $more = $_POST['more'];
            $file = url().$target_file;
            $up = "UPDATE `reward` SET `name`= '$name', `symbol`= '$symbol', `hint`= '$hint', `input_type`= '$type',`image`= '$file',`details`= '$more' WHERE id=".$_POST['edit_redeem'];
            $db = mysqli_query($link,$up);

            if ($db) {
            header("Location: redeem.php");
            }else {  echo mysqli_error($link);}

            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
}else {
  $name = $_POST['name'];
  $coins = $_POST['coins'];
  $amount = $_POST['amount'];
  $symbol = $_POST['symbol'];
  $hint = $_POST['hint'];
  $type = $_POST['type'];
  $more = $_POST['more'];

  $up = "UPDATE `reward` SET `name`= '$name', `symbol`= '$symbol', `hint`= '$hint', `input_type`= '$type', `details`= '$more' WHERE id=".$_POST['edit_redeem'];
  $db = mysqli_query($link,$up);
  if ($db) {
  header("Location: redeem.php");
  }else {  echo mysqli_error($link);}
}
}else {
    header("Location: redeem.php");
}
}






if (isset($_POST['view_action'])) {
    if(!$demo) {
  $name = $_POST['view_action'];
  $up = "UPDATE `reward_list` SET `status`= '$name' WHERE id = ".$_POST['view_id'];
  $db = mysqli_query($link,$up);
  if ($db) {
   header("Location: redeems.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: redeems.php");
    }
}




if (isset($_POST['add-offer'])) {
    
    if(!$demo) {

  if (isset($_FILES["fileToUpload"])) {

  $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }


        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $title = $_POST['title'];
            $SubTitle = $_POST['SubTitle'];
            $url = $_POST['url'];
            $file = url().$target_file;
            $add_r = "INSERT INTO offers (title,image,sub,offer_name,type) VALUES ('$title','$file','$SubTitle','$url','1')";
           $send_r= mysqli_query($link,$add_r);
            if ($send_r) {
            header("Location: ".url());
            }else {
              echo mysqli_error($link);
            }
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }

 }else {



   $title = $_POST['title'];
   $SubTitle = $_POST['SubTitle'];
   $add_r = "INSERT INTO offers (title,sub,offer_name,type) VALUES ('$title','$SubTitle','$url','1')";
 	$send_r= mysqli_query($link,$add_r);
   if ($send_r) {
   header("Location: ".url());
   }else {
     echo mysqli_error($link);
   }
 }
} else {
    header("Location: ".url());
}

}





if (isset($_POST['settings_user'])) {
    
    if(!$demo) {

  $d_b = $_POST['d_b'];
  $spin = $_POST['spin'];
  $Invited = $_POST['Invited'];
  $Referral = $_POST['Referral'];
  $Shere = $_POST['Shere'];
  $app_id = $_POST['os_app_id'];
  $api = $_POST['os_rest_api'];

  $up = "UPDATE `settings` SET `daily_b_points`= '$d_b', `invited_user_bonus`= '$Invited', `referral_bonus`= '$Referral', `refer_msg`= '$Shere', `daily_spins`= '$spin',`os_app_id`= '$app_id', `os_rest_api`= '$api'";
  $db = mysqli_query($link,$up);

  if ($db) {

  header("Location: settings.php");
  }
  else {  echo mysqli_error($link);
  }
    }else {
        header("Location: settings.php");
    }
}


if (isset($_POST['settings_wall'])) {
    
    if(!$demo) {

  $ot_app = $_POST['ot_app'];
  $ot_k = $_POST['ot_k'];
  $p_id = $_POST['p_id'];
  $adg = $_POST['adg'];
  $OT_PUB = $_POST['ot_pub'];

  $up = "UPDATE `settings` SET `OT_APP_ID`= '$ot_app', `OT_KEY`= '$ot_k', `PF_ID`= '$p_id', `AG_WALLCODE`= '$adg',`OT_PUB`= '$OT_PUB'";
  $db = mysqli_query($link,$up);

  if ($db) {

  header("Location: settings.php");
  }
  else {  echo mysqli_error($link);
  }
    }else {
        header("Location: settings.php");
    }
}


if (isset($_POST['edit_user'])) {
    
    if(!$demo) {

  $u = $_POST['edit_user'];

  $email = $_POST['email'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $points = $_POST['points'];

  $up = "UPDATE `users` SET `email`= '$email', `name`= '$name', `phone`= '$phone', `points`= '$points' WHERE username = '$u'";
  $db = mysqli_query($link,$up);


  if ($db) {

  header("Location: userlist.php");
  }
  else {  echo mysqli_error($link);
  }
    }else {
        header("Location: userlist.php");
    }
}


if(isset($_POST['admin_update'])){
$u = $_POST['admin_update'];
if(!$demo) {
$rand = rand();
  if(!basename($_FILES["fileToUpload"]["name"])=="")
  {


    $target_dir = "img/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]).$rand;
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }


          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }

          // Check file size
          if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }

          // Allow certain file formats
          /*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }*/

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              $pro = url().$target_file;


              echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }
  }else {
  $pro = $_POST['pro'];
echo "this";
  }


    if(isset($_POST['old']) && isset($_POST['new']) && !$_POST['old']=="" && !$_POST['new']==""){
      $old = $_POST['old'];
      $new = $_POST['new'];
        $old_pass = hash('sha256', $old);
        $new_pass = hash('sha256', $new);
        $check = mysqli_query($link,"SELECT * FROM tbl_admin");
        $re = mysqli_fetch_assoc($check);
        if($re['password']==$old_pass){
          $email = $_POST['email'];
          $name = $_POST['name'];
          $company = $_POST['company'];
          $username = $_POST['username'];
                $update = mysqli_query($link,"UPDATE tbl_admin SET email='$email',name='$name',company='$company', password='$new_pass', profile='$pro',username = '$username'");
            if($update){ 
                header("Location: profile.php");
            }else {
                echo "Update Failed With Password";
            }
        }else {
            echo "Password Not Match";
        }
    }else {
      $email = $_POST['email'];
      $name = $_POST['name'];
      $company = $_POST['company'];
      $username = $_POST['username'];
            $update = mysqli_query($link,"UPDATE tbl_admin SET email='$email',name='$name',company='$company' , profile='$pro', username='$username'");
            if($update){
                header("Location: profile.php");
            }else {
                echo "Update Failed";
            }
    }
}else {
    header("Location: profile.php");
}
}


if (isset($_POST['edit-task'])) {
    if(!$demo) {
  $invites = $_POST['invites'];
  $points = $_POST['points'];
  $up = "UPDATE `ref_achi` SET `invites`= '$invites', `points`= '$points' WHERE id=".$_POST['edit-task'];
  $db = mysqli_query($link,$up);
  if ($db) {
  header("Location: refer-task.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: refer-task.php");
    }
}

if (isset($_POST['vpn_check'])) {
    if(!$demo) {
    if (isset($_POST['vpn'])) {
        $vpn = 1;
    }else
    {
        $vpn = 0;
    }
  $vpn = $_POST['vpn'];
  if($vpn==0 or $vpn == 1){
  
  $up = "UPDATE `settings` SET `vpn`= '$vpn'";
  $db = mysqli_query($link,$up);
  if ($db) {
  header("Location: settings.php");
  }else {
    echo mysqli_error($link);
  }
  }else
    {
        echo "Invalid value";
    }
    }else {
        header("Location: settings.php");
    }
}

if ($_POST['add-task']) {
    if(!$demo) {
  $invites = $_POST['invites'];
  $points = $_POST['points'];
  $register_user = "INSERT INTO ref_achi (invites,points) VALUES ('$invites','$points')";
	$send_server= mysqli_query($link,$register_user);
  if ($send_server) {
  header("Location: refer-task.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: refer-task.php");
    }
}


if ($_POST['r_item']) {
    if(!$demo) {
  $coins = $_POST['coins'];
  $amount = $_POST['amount'];
  $r_id = $_POST['r_item'];
  $register_user = "INSERT INTO reward_amounts (coins,amount,r_id) VALUES ('$coins','$amount','$r_id')";
	$send_server= mysqli_query($link,$register_user);
  if ($send_server) {
  header("Location: paymentm-list.php?i=".$_POST['r_item']);
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: paymentm-list.php?i=".$_POST['r_item']);
    }
}

if (isset($_POST['edit_r_item'])) {
    if(!$demo) {
  $coins = $_POST['coins'];
  $amount = $_POST['amount'];
  $r_id = $_POST['edit_r_item'];
  $up = "UPDATE `reward_amounts` SET `coins`= '$coins', `amount`= '$amount' WHERE id=".$r_id;
  $db = mysqli_query($link,$up);
  if ($db) {
  header("Location: redeem.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: redeem.php");
    }
}



if (isset($_POST['eboot'])) {
    
    if(!$demo) {

  if (isset($_FILES["fileToUpload"])) {

  $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }


        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "examples/eboot.".$imageFileType)) {
          
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            header("Location: settings.php");
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }

 }
    }else {
        header("Location: settings.php");
    }
}

if ($_POST['game_name']) {
    if(!$demo) {
  $name = $_POST['game_name'];
  $image = $_POST['image'];
  $url = $_POST['url'];
  $register_user = "INSERT INTO games (title,image,game) VALUES ('$name','$image','$url')";
	$send_server= mysqli_query($link,$register_user);
  if ($send_server) {
  header("Location: game.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: game.php");
    }
}

if (isset($_POST['edit_game_name'])) {
    if(!$demo) {
 $name = $_POST['edit_game_name'];
  $image = $_POST['image'];
  $url = $_POST['url'];
  $up = "UPDATE `games` SET `title`= '$name', `image`= '$image', `game`= '$url' WHERE id=".$_POST['game_id'];
  $db = mysqli_query($link,$up);
  if ($db) {
  header("Location: game.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: game.php");
    }
}

if ($_POST['a_title']) {
    if(!$demo) {
  $a_title = $_POST['a_title'];
  $image = $_POST['image'];
  $url = $_POST['url'];
  $points = $_POST['points'];
  $time = $_POST['time'];
  $register_user = "INSERT INTO readTask (title,image,points,time,url) VALUES ('$a_title','$image','$points','$time','$url')";
	$send_server= mysqli_query($link,$register_user);
  if ($send_server) {
  header("Location: article.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: article.php");
    }
}

if (isset($_POST['aa_title'])) {
    if(!$demo) {
  $a_title = $_POST['aa_title'];
  $image = $_POST['image'];
  $url = $_POST['url'];
  $points = $_POST['points'];
  $time = $_POST['time'];
  $up = "UPDATE `readTask` SET `title`= '$a_title', `image`= '$image', `points`= '$points', `time`= '$time', `url`= '$url' WHERE id=".$_POST['a_id'];
  $db = mysqli_query($link,$up);
  if ($db) {
  header("Location: article.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: article.php");
    }
}


if ($_POST['afbads']) {
    if(!$demo) {
  $fbadsunit = $_POST['afbads'];
  $fbadtime = $_POST['afbtime'];
  $register_user = "UPDATE `settings` SET `fb_ad_id`= '$fbadsunit', `fb_ad_time`= '$fbadtime'";
	$send_server= mysqli_query($link,$register_user);
  if ($send_server) {
  header("Location: settings.php");
  }else {
    echo mysqli_error($link);
  }
    }else {
        header("Location: settings.php");
    }
}

if ($_POST['user_b']) {
    if(!$demo) {
  $id = $_POST['user_b'];
  $status = $_POST['status'];
  $register_user = "UPDATE `users` SET `status`= '$status' WHERE id = '$id'";
	$send_server= mysqli_query($link,$register_user);
  if ($send_server) {
      if(!isset($_POST['r']))
      {
  header("Location: userlist.php");
      }else
      {
         header("Location: redeems.php"); 
      }
  }else {
    echo mysqli_error($link);
  }
    }else {
         if(!isset($_POST['r']))
      {
  header("Location: userlist.php");
      }else
      {
         header("Location: redeems.php"); 
      }
    }
}
 ?>

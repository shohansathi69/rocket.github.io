<?php
session_start();


//onclick="this.disabled='disabled';"
if(empty($_SESSION['username'])) 
	header("Location: login.php");
	
?>

<?php 

function url(){
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return str_replace("admin_api.php","",$url);
    }
    


?>
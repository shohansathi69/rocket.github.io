<?php 
include 'db.php';
include 'session.php';
$sql = mysqli_query($link,"SELECT * FROM tbl_admin");
$res = mysqli_fetch_assoc($sql);

$search_result = $_GET['search'];

extract($_REQUEST);
if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_pages_sql = "SELECT COUNT(*) FROM users WHERE username LIKE '%$search%%' OR phone LIKE '%$search%%'";
        $result = mysqli_query($link,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM users WHERE username LIKE '%$search%%' OR phone LIKE '%$search%%' LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($link,$sql);

?>

<?php include 'inc/head.php';?>

<body class="crm_body_bg">

<?php include 'inc/nav.php';?>

<section class="main_content dashboard_part large_header_bg">

<?php include 'inc/profile.php';?>

<div class="main_content_iner ">
<div class="container-fluid p-0">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="white_card card_height_100 mb_30">
<div class="white_card_header">
<div class="box_header m-0">
<div class="main-title">
<h3 class="m-0">Users</h3>
</div>
<form style="display: flex;align-items: center;gap: 7px;" action="search_user.php">
<input type="search" class="form-control" id="gsearch" name="search" value="<?php echo $search_result; ?>">
<input class="btn_1" style="border:none;" type="submit">
</form>
</div>
</div>
<div class="white_card_body">
<div class="QA_section">

<div class="QA_table mb_30">

<table class="table lms_table_active ">
<thead>
<tr>
<th scope="col">Name</th>
<th scope="col">Points</th>
<th scope="col">Email</th>
<th scope="col">Total Referrals</th>
<th scope="col">Status</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>

 <!-- start here  -->

<?php 
        extract($_REQUEST);
            while($row = mysqli_fetch_array($res_data)){ ?>

                <tr>
  <th scope="row"> <a href="#" class="question_content"> <?php echo $row['username']; ?></a></th>
  <td> <?php echo $row['points']; ?></td>
  <td> <?php echo $row['email']; ?></td>
  <td> <?php echo $row['total_ref']; ?></td>
  <form action="admin_api.php" method="post" id="myform">
      <input type='hidden' name='user_b' value='<?php echo $row['id']; ?>'>
     
  <?php if ($row['status']=="0") {
      $id =$row['id'];
    echo "
    <input type='hidden' name='status' value='1'>
    <td><Button style='border: none;' type='submit' class='status_btn'>Active</Button></td>";
  }else {
      echo "
    <input type='hidden' name='status' value='0'>
    <td><Button style='border: none;' type='submit' style='background: red;' class='status_btn'>Blocked</Button></td>";
    
  } ?>
  
   </form>

       

   


  <th scope="col">
  <div class="action_btns d-flex">
  <a href="edit-user.php?i=<?php echo $row['username']; ?>" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
  <a href="tracker.php?i=<?php echo $row['username']; ?>" class="action_btn mr_10"> <i class="fa-solid fa-database"></i> </a>
  <!--<a href="#" class="action_btn mr_10"> <i class="fa-solid fa-ban"></i> </a>-->
 <!-- <a href="#" class="action_btn"> <i class="fas fa-trash"></i> </a>-->
  </div>
  </th>
  </tr>


            <?php } ?>

<!-- end here  -->
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="col-12">
 </div>
</div>
</div>
</div>


</section>

<?php include 'inc/foot.php';?>

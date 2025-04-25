<?php
include 'session.php';
include 'db.php';?>

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
<br>
</div>
</div>
<div class="white_card_body">
<div class="QA_section">
<div class="white_box_tittle list_header" style="display: flex;margin-top: -40px;">
<h4>Refer Tasks</h4>
<div class="box_right d-flex lms_block">

<div class="add_button ml-10">
<a href="add-ref-task.php" class="btn_1">Add New</a>
</div>
</div>
</div>
<div class="QA_table mb_30">

<table class="table lms_table_active ">
<thead>
<tr>
<th scope="col">Task Number</th>
<th scope="col">Invites</th>
<th scope="col">Points</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>

 <!-- start here  -->


 <?php

 $sql = "SELECT * FROM ref_achi";
 $result = mysqli_query($link, $sql);
$count = 0;
  while($row = mysqli_fetch_assoc($result)) {
      $count++;
  ?>
  <tr>
  <th scope="row"> <a href="#" class="question_content"> <?php echo "Task "."$count" ?></a></th>
  <td> <?php echo $row['invites']; ?></td>
  <td> <?php echo $row['points']; ?></td>


  <th scope="col">
  <div class="action_btns d-flex">
      <a href="edit-task.php?i=<?php echo $row['id']; ?>" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
  <form action="admin_api.php" method="post">
  <input type="hidden" name="clm_name" value="ref_achi">
  <input type="hidden" name="r_id" value="<?php echo $row['id']; ?>">
  <input type="hidden" name="url" value="refer-task.php">
  <input type="hidden" name="delt">
<button type="submit" class="action_btn" style="border: none;"> <i class="fas fa-trash"></i> </button>
</form>
  
  </div>
  </th>
  </tr>
<?php

}

 ?>


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

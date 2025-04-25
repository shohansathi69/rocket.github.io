<?php
include 'session.php';
include 'db.php';
include 'v.php';?>

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
<div class="box_right d-flex lms_block">
<div class="add_button ml-10">
<a href="add-game.php" class="btn_1">Add Game</a>
</div>
</div>
</div>
</div>
<div class="white_card_body">
<div class="QA_section">

<div class="QA_table mb_30">

<table class="table lms_table_active ">
<thead>
<tr>
<th scope="col">Image</th>
<th scope="col">Name</th>
<th scope="col">Status</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>

 <!-- start here  -->


 <?php
 $sql = "SELECT * FROM games";
 $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result)) {
  ?>
  <tr>
  <th scope="row"><img style="margin-right: 15px;height: 55px;width: 55px;border-radius: 45px;border: 3px solid #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 10%);" src="<?php echo $row['image']; ?>" alt="User Img"></th>
  <td><?php echo $row['title']; ?></td>
  <td><a class="status_btn">Active</a></td>

  <th scope="col">
  <div class="action_btns d-flex">
  <a href="edit-game.php?i=<?php echo $row['id']; ?>" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
  <form action="admin_api.php" method="post">
  <input type="hidden" name="clm_name" value="games">
  <input type="hidden" name="r_id" value="<?php echo $row['id']; ?>">
  <input type="hidden" name="url" value="game.php">
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

<?php
include 'session.php';
include 'db.php';?>
<?php $sql = mysqli_query($link,"SELECT * FROM tbl_admin WHERE username='$u'");
$res = mysqli_fetch_assoc($sql);
 ?>
<?php include 'inc/head.php';?>
<body class="crm_body_bg">



<?php include 'inc/nav.php';?>

<section class="main_content dashboard_part large_header_bg">

<?php include 'inc/profile.php';?>


<div class="main_content_iner ">

<div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Admin Profile </h3>
                </div>
                <div class="col-4 text-right">
                  <button type="submit" form="profile" class="btn btn-sm btn-primary">Save</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="admin_api.php" method="post" id="profile" enctype="multipart/form-data">
                <h6 class="heading-small text-muted mb-4">Admin information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control" name="username" placeholder="Username" value="<?php echo $res['username'];?>">
                        <input type="hidden" id="input-username" class="form-control" name="admin_update" value="<?php echo $res['username'];?>">
                        <input type="hidden" name="pro" value="<?php echo $res['profile'];?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control" name="email" placeholder="jesse@example.com" value="<?php echo $res['email'];?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Full Name</label>
                        <input type="text" id="input-first-name" class="form-control" name="name" placeholder="First name" value="<?php echo $res['name'];?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Company</label>
                        <input type="text" id="input-last-name" class="form-control" name="company" placeholder="Last name" value="<?php echo $res['company'];?>">
                      </div>
                    </div>
                    
         <div class="col-lg-12">
              <div class="input-group mb-3">

              <div class="input-group-append" id="filele" style="align-items: center;gap: 12px;">
              <div class="thumb" style="padding: 10px 7px;background: #f5f6ff;border-radius: 10px;">
                 <img src="<?php echo $res['profile']; ?>" alt="" style="height: 55px;">
            </div>
            <div class="input-group-append" id="filele">
              <span style="height: 38px;" class="input-group-text" id="basic-addon2">
              <input style="width:100%" type="file" name="fileToUpload" id="fileToUpload">
              </span>
            </div>
            </div>
            </div>
            </div>
                    
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Change Password</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Current Password</label>
                        <input id="input-address" name="old" class="form-control" placeholder="Current Pass" type="password">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">New Password</label>
                        <input id="input-address" name="new" class="form-control" placeholder="New Pass" type="password">
                      </div>
                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>

</div>


</section>

<?php include 'inc/foot.php';?>

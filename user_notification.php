<?php include 'header.php' ; ?>
<?php include 'connect.php' ; ?>



<style type="text/css">
  img.im {
    width: 22%;
}
.bt{
  margin-bottom: 16px;
}
  .container-fluid{
      margin-right: 30px;
    margin-left: 30px;
    width: fit-content!important;
  
  }
  .card{
border-radius: 20px!important}
  .content-wrapper{
  min-height: 433px;
    background: white;
    text-align: left;
    margin-left: 0px!important;
  }
  body{
      background: #f1f4f8;
  }
  .next{
  position: relative;
    color: white;
    text-decoration: none;
    background-color: #6610f2;
    border: 1px solid #dddfeb;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 81px;
    padding: 9px;
    border-radius: 10px;
   margin-left: 33px;
     padding-left: 48px!important;
    padding-right: 48px!important;
  }
  .paginate_button {
        padding: 10px;
    margin: 5px;
    border-radius: 6px;
    position: relative;
    text-decoration: none;
    border: 1px solid #dddfeb;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    z-index: 3;
    border-color: #4e73df;
  }
  .previous{
        margin-right: 21px;
    position: relative;
    color: white;
    text-decoration: none;
    background-color: #6610f2;
    border: 1px solid #dddfeb;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 81px;
    padding: 9px;
    border-radius: 10px;
    padding-right: 21px;
  }
  
</style>
 


<div class="container-fluid">
            
                <div class="card shadow">
                     
                    	
                    <div class="card-body">
                        
                     


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
 
    
 

<div class="main_content_iner ">

<div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-4">
                  <h3 class="mb-0">Send Notification</h3>
                </div>
                <div class="col-8 text-right">
                  <button form="myform" class="btn btn-sm btn-primary btn btn-primary btn-block" type="submit">Send Notification</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form id="myform" action="user_notification_send.php" method="get" enctype="multipart/form-data">
                <h6 class="heading-small text-muted mb-4">Notification Details</h6>
               <fieldset>
                
                    <input type="hidden" id="redId" name="regId" class="pure-input-1-2" required="" placeholder="Enter firebase registration id">
 
                    <label for="title">Type Your Opne Link</label>
                    <input  style="background: beige;"  style="background: beige;"  type="url" id="title" name="title" class="form-control" placeholder="Type Your Opne Link!">
                    <br>
                    
                    
                    <label for="title">Notification Title</label>
                    <input  style="background: beige;"  style="background: beige;"  type="text" id="message" name="message" class="form-control" placeholder="Enter title">
                    <input style="background: beige;" type="hidden" name="push_type" value="individual">
                    <br>
                    
               
                    <br>
                    <label for="title">Notification Image Link</label>
                    <input  style="background: beige;"  type="text" id="title" name="image" class="form-control" placeholder="url">
               
                    
                </fieldset>
              </form>
            </div>
          </div>

</div>


 
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->









                         </div>
                    </div>
                
            </div>

 
      
 <?php include 'footer.php' ; ?>


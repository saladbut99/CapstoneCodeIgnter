<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>



<div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-7">
               <a href="home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
           </div>
           <div class="col-4 text-center pt-3">
                  <p style="color:white; text-align:right;"><?= session()->get('firstname') ?> <?= session()->get('lastname') ?></p>
           </div>
           <div class="col-1 p-0 text-center">
               <div style="margin-right: 0%;">
                   <a href="#" class="dropdown"><img src="<?=base_url()?>/public/assets/images/admin.png" alt="" class="nav_img" height="60" width="60"></a>
                </div>
           </div>
       </nav>
   </div>
   <div class="menu p-2 text-center">
     <div class="pt-3" style="cursor:pointer;">
       <a href="update">Update Password</a>
       </div>
        <div class="">
        <a href="logout">Logout</a>
        </div>
   </div>
   <script>
     $( ".dropdown" ).click(function() {
       $( ".menu").toggle();
   });
   </script>

   <div class="container mt-5" style="margin-bottom:5%;">
     <div class="row mt-3s">
       <div class="backbutton col-2 d-flex justify-content-left ">
           <a href="home" style="text-decoration: none; color: rgb(68, 68, 68);">
           <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
               <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
           </svg>
           </a>
       </div>
       <br>
       <?php if (session()->get('updatesuccess')): ?>
       <div class="alert alert-success" role="alert" style="margin-bottom:5%;">
           <h4><?= session()->get('updatesuccess') ?></h4>
       </div>
     <?php endif; ?>
       <br>
       <div class="col-12">
         <table class="table table-bordered display nowrap" id="users-list"  cellspacing="0" style="width:100%;" >
           <thead style="font-size:5px;">
              <tr>
                 <th style="font-size:30px;">Pupil Id</th>
                 <th style="font-size:30px;" class="all">Firstname</th>
                 <th style="font-size:30px;" class="all">Lastname</th>
                 <th style="font-size:30px;">Section Name</th>
                 <th style="font-size:30px;">Address</th>
                 <th style="font-size:30px;">Parents/Guardian Name</th>
                 <th style="font-size:30px;" class="all">Status</th>
                 <th style="font-size:30px;">Action</th>
              </tr>
           </thead>
           <tbody>
              <?php if($users): ?>
              <?php foreach($users as $user): ?>
              <tr>
                 <td><?php echo $user['pupil_id']; ?></td>
                 <td><?php echo $user['pupil_firstname']; ?></td>
                 <td><?php echo $user['pupil_lastname']; ?></td>
                 <td><?php echo $user['section_name']; ?></td>
                 <td><?php echo $user['pupil_address']; ?></td>
                 <td style="text-align:center;">Father: <?php echo $user['pupil_father_name']; ?><br>Mother: <?php echo $user['pupil_mother_name']; ?><br>Guardian: <?php echo $user['pupil_guardian_name']; ?></td>
                   <td style="text-align:center;"><?php echo $user['account_status']; ?></td>
                 <td style="text-align:center;"><a href="view/<?= $user['pupil_id'] ?>" style="text-decoration:none; font-size:15px;" class="btn btn-primary">Change Status</a></td>
              </tr>
             <?php endforeach; ?>
             <?php endif; ?>
           </tbody>
         </table>
       </div>
     </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
   <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
   <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

   <script>
       $(document).ready( function () {
         $('#users-list').DataTable({
        
           "createdRow": function( row, data, dataIndex,cells ) {
             if ( data[6] == "Inactive" ) {
               $(cells[0]).addClass('red');
              $(cells[1]).addClass('red');
              $(cells[2]).addClass('red');
              $(cells[3]).addClass('red');
              $(cells[4]).addClass('red');
                $(cells[5]).addClass('red');
                            $(cells[6]).addClass('red');
             }
           },
           "responsive": true,
         });
     } );
   </script>



<?= $this->endSection(); ?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-7">
               <a href="<?php echo base_url(); ?>/public/admin/home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
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
        <div class="">
        <a href="<?php echo base_url(); ?>/public/admin/logout">Logout</a>
        </div>
   </div>
   <script>
     $( ".dropdown" ).click(function() {
       $( ".menu").toggle();
   });
   </script>

   <div class="container mt-5" style="margin-bottom:5%;">

     <div class="mt-3">
       <div class="backbutton col-2">
           <a href="<?php echo base_url(); ?>/public/admin/viewperformance_section" style="text-decoration: none; color: rgb(68, 68, 68);">
           <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
               <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
           </svg>
           </a>
       </div>
       <br>


       <br>
       <?php if (!$users): ?>
          <h1 style="text-align:center;">No Added Module</h1>
      <?php else: ?>
        <table class="table table-borderless table-hover" id="users-list"  style=" border-bottom: none;">
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th>Pupil Name</th>

             </tr>
          </thead>

             <?php if($users): ?>
             <?php foreach($users as $user): ?>
               <?php if ($user['section_id']==5): ?>
                 <tr>
                     <td style="text-align:left"><a href="<?php echo base_url(); ?>/public/admin/viewperformance_module\<?= $user['section_id'] ?>"  style="text-decoration:none; font-size:20px;"><?php echo $user['pupil_firstname']; ?> <?php echo $user['pupil_lastname']; ?></a> </td>
                  </tr>
               <?php endif; ?>

            <?php endforeach; ?>
            <?php endif; ?>
        </table>

       <?php endif; ?>

     </div>
   </div>

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script>
      $(document).ready( function () {
        $('#users-list').DataTable({
           "bPaginate": false,
           "bInfo" : false,
           "searching": false,
           "language": {
             "emptyTable": "No uploaded module for section Rose"
           },
            "responsive": true,
            "order": [[ 1, "asc" ]],
        });
        $('#users-list2').DataTable({
           "bPaginate": false,
           "bInfo" : false,
           "searching": false,
           "language": {
             "emptyTable": "No uploaded module for Unit 2"
           },
            "responsive": true,
        });
        $('#users-list3').DataTable({
           "bPaginate": false,
           "bInfo" : false,
           "searching": false,
           "language": {
             "emptyTable": "No uploaded module for Unit 3"
           },
            "responsive": true,
        });
        $('#users-list4').DataTable({
           "bPaginate": false,
           "bInfo" : false,
           "searching": false,
           "language": {
             "emptyTable": "No uploaded module for Unit 4"
           },
            "responsive": true,
        });
    } );
  </script>

  <?= $this->endSection() ?>

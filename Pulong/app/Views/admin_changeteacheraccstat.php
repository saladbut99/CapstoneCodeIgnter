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
   <div class="container mt-5">
     <div class="mt-3">
        <table class="table table-bordered" id="users-list">
          <thead>
             <tr>
                <th>Teacher Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Section Id</th>
                <th>Section Name</th>
             </tr>
          </thead>
          <tbody>
             <?php if($users): ?>
             <?php foreach($users as $user): ?>
             <tr>
                <td><?php echo $user['teacher_id']; ?></td>
                <td><?php echo $user['teacher_firstname']; ?></td>
                <td><?php echo $user['teacher_lastname']; ?></td>
                <td><?php echo $user['section_id']; ?></td>
                <td><?php echo $user['section_name']; ?></td>
             </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
     </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
   <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   <script>
       $(document).ready( function () {
         $('#users-list').DataTable();
     } );
   </script>



<?= $this->endSection(); ?>

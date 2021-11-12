<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-10">
               <a href="AdminDashboard" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
           </div>
           <div class="col-1 text-center ">
               <p style="color:white;">name</p>
           </div>
           <div class="col-1 text-center">
               <div>
                   <a href=""><img src="<?=base_url()?>/public/assets/images/admin.png" alt="" class="nav_img" height="60" width="60"></a>
               </div>
           </div>
       </nav>
   </div>

<p>This page is after admin_viewmodule</p>


<?= $this->endSection(); ?>

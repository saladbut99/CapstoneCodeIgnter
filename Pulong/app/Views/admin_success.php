<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
<div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-10">
               <a href="home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
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
<div class="mask d-flex align-items-center h-100 gradient-custom-3 mb-5">
      <div class="container h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md text-center" >

            <br>
            <h1 style="color:black;">Account Successfully Created</h1>
            <br><br>
          <a href="register" class="check"><svg style="border:2px solid green; border-radius: 100px;" xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="green" class="bi bi-check-lg" viewBox="0 0 16 16">
              <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
            </svg></a>

        </div>
      </div>
    </div>

<?= $this->endSection() ?>

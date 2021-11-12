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
<div class="backbutton backbuttonpos row align-items-center">

      <div class="backbutton col-2 p-0">
          <a href="home" style="text-decoration: none; color: rgb(68, 68, 68);" class="">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
          </svg>
          </a>
      </div>
      <div class="col-3" style="cursor: pointer;">
          <a href="home" style="text-decoration: none; color: rgb(68, 68, 68);" class=""></a>
          <h4>Back</h4>
          </a>
      </div>
      <div class="col-7"></div>
  </div>
<br>
  <div class="col-sm-12">
      <form method="get">
          <div class="row align-items-center">
              <div class="col-sm-1" style="padding-right: 5px; width: auto;">
                  <label style="margin-left: 5px;">Search: </label>
              </div>
              <div class="col-sm-2" style="padding-left: 0px;width: auto;">
                  <input type="text" name="username" id="username" class="form-control" value="" placeholder="...">
              </div>
              <div class="col-sm-1 p-2 m-0" style="width: auto;">
                  <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
              </div>
              <div class="col-sm-1 p-0 m-0" style="width: auto;">
                  <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> Clear</a>
              </div>
                      </div>
                  </div>
          </div>
      </form>
  </div>

  <?= $this->endSection() ?>

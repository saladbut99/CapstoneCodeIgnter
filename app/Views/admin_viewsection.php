<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

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
                   <a href="#" class="dropdown"><img src="<?=base_url()?>/public/assets/images/teacher.png" alt="" class="nav_img" height="60" width="60"></a>
                </div>
           </div>
       </nav>
   </div>
   <div class="menu p-2 text-center">
        <div class="">
        <a href="logout">Logout</a>
        </div>
   </div>
   <div class="container">
     <div class="row">
       <div class="backbutton col-2">
           <a href="manage" style="text-decoration: none; color: rgb(68, 68, 68);">
           <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
               <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
           </svg>
           </a>
       </div>
     </div>
   </div>
   <br>
   <div class="container">
      <div class="row">
        <div class="col-2">
            <h1> <b>Sections  </b></h1>
        </div>
      </div>
   </div>


<center>

    <div class="formcontainer m-5 pb-5" style="max-width:80%; background-color: white; border:none;">
      <div class="container  h-100 ">
        <div class="row h-100 align-items-center ">
            <div class="col text-center" >
                <div class="dashboard_div section" style="  background-image:   linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('<?=base_url()?>/public/assets/images/rose.jpg');  background-size: cover;">
                <br>
                  <br><br>
                <h1 style="color:white;">Rose</h1>
                <br>
                <h3 style="color:white;">Grade 1</h3>
                <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 5%; margin-bottom: 5%;"> View Module</a>
                </div>
            </div>
            <div class="col text-center" >
                <div class="dashboard_div section" style="  background-image:   linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('<?=base_url()?>/public/assets/images/rosal.jpg');  background-size: cover;">
                <br>
                  <br><br>
                <h1 style="color:white;">Rosal</h1>
                <br>
                <h3 style="color:white;">Grade 1</h3>
                <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 5%; margin-bottom: 5%;"> View Module</a>
                </div>
            </div>
            <div class="col text-center" >
                <div class="dashboard_div section" style="  background-image:   linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('<?=base_url()?>/public/assets/images/adelfa.jpg');  background-size: cover;">
                <br>
                  <br><br>
                <h1 style="color:white;">Adelfa</h1>
                <br>
                <h3 style="color:white;">Grade 1</h3>
                <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 5%; margin-bottom: 5%;"> View Module</a>
                </div>
            </div>
            <div class="col text-center" >
                <div class="dashboard_div section" style="  background-image:   linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('<?=base_url()?>/public/assets/images/lily.jpg');  background-size: cover;">
                <br>
                  <br><br>
                <h1 style="color:white;">Lily</h1>
                <br>
                <h3 style="color:white;">Grade 2</h3>
                <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 5%; margin-bottom: 5%;"> View Module</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</center>
<center>
    <div class="formcontainer m-5 pb-5" style="max-width:80%; background-color: white; border:none;">
      <div class="container  h-100 ">
        <div class="row h-100 align-items-center ">
            <div class="col-3 text-center" >
                <div class="dashboard_div section" style="  background-image:   linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('<?=base_url()?>/public/assets/images/gumamela.jpg');  background-size: cover;">
                <br>
                  <br><br>
                <h1 style="color:white;">Gumamela</h1>
                <br>
                <h3 style="color:white;">Grade 2</h3>
                <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 5%; margin-bottom: 5%;"> View Module</a>
                </div>
            </div>
            <div class="col-3 text-center" >
                <div class="dashboard_div section" style="  background-image:   linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('<?=base_url()?>/public/assets/images/orchid.jpg');  background-size: cover;">
                <br>
                  <br><br>
                <h1 style="color:white;">Orchid</h1>
                <br>
                <h3 style="color:white;">Grade 2</h3>
                <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 5%; margin-bottom: 5%;"> View Module</a>
                </div>
            </div>
            <div class="col-3 text-center" >
                <div class="dashboard_div section" style="  background-image:   linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('<?=base_url()?>/public/assets/images/daisy.jpg');  background-size: cover;">
                <br>
                  <br><br>
                <h1 style="color:white;">Daisy</h1>
                <br>
                <h3 style="color:white;">Grade 2</h3>
                <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 5%; margin-bottom: 5%;"> View Module</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</center>


<script>
  $( ".dropdown" ).click(function() {
    $( ".menu").toggle();
});
</script>

<?= $this->endSection() ?>

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
     <div class="pt-3" style="cursor:pointer;">
       <a href="update">Update Password</a>
       </div>
        <div class="">
        <a href="logout">Logout</a>
        </div>
   </div>

        <div class="mask d-flex align-items-center h-100 gradient-custom-3 mb-5">
          <div class="container h-100" >
            <div class="row d-flex align-items-center h-100">
              <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card" style="border-radius: 15px; border:3px solid #00acee;width:100%;">
                  <div class="card-body p-5 row">


                    <div class="backbutton col-2">
                        <a href="manage" style="text-decoration: none; color: rgb(68, 68, 68);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                        </a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <script type="text/javascript">

          function myFunction(){
            var firstname = document.getElementById("pupil_firstname").value;
          //  trim(firstname);
          var trimfirstname=firstname.trim();
            var split = trimfirstname.split(" ");
            for (let i = 0; i < split.length; i++) {
                split[i] = split[i][0].toUpperCase() + split[i].substr(1);
              }
            var joined = split.join('');

            var lastname = document.getElementById("pupil_lastname").value;
            var nameCapitalized = lastname.charAt(0).toUpperCase() + lastname.slice(1)
            var trimlastname=nameCapitalized.trim();
            var username = trimlastname+'.'+joined;
             document.getElementById("pupil_username").value = username;
          }
        </script>

<script>
  $( ".dropdown" ).click(function() {
    $( ".menu").toggle();
});
</script>


</body>
</html>


<?= $this->endSection() ?>

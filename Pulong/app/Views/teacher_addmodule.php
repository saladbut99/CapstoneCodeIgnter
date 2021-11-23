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

<<<<<<< HEAD
   <div >
     <div class="container h-100" style="margin-bottom:5%;" >
        <div class="row">
          <div class="backbutton col-2">
              <a href="manage" style="text-decoration: none; color: rgb(68, 68, 68);">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
              </svg>
              </a>
          </div>
          <div>
          <h2 class="text-uppercase text-center">ADD MODULE</h2>
          <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert" style="margin-bottom:5%;">
              <h4><?= session()->get('success') ?></h4>
          </div>
        <?php endif; ?>
        <br>
      </div>
          <div class="col-10 col-md-8 offset-md-2">
            <form action="" method="post">
              <div class="form-group">
                  <label for="" style="font-size:30px;">Title</label>
                  <input type="text" id="" class="form-control" name="module_title" style="border-color: #00acee; border-width: 2px; border-radius:15px; height: 50px;">
                </div>
                <br>
                <div class="form-group">
                  <label for="" style="font-size:30px;">Description</label>
                  <textarea type="text" id="" class="form-control" name="post_content" rows="3" style="border-color: #00acee; border-width: 2px; border-radius:15px;"></textarea>
                </div>
                <br>
                <div class="form-group">
                  <label class="form-check-label mx-1" for="gradelevel" style="font-size:30px;"> Grade Level:  </label>
                   <input type="number" style="width: 100%; height: 50px; text-align: center; border: solid 2px #00acee; border-radius:15px;" id="gradelevel" placeholder="" class="mt-1" /> <br>
                </div>
=======
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

                    <form action="">
                    <div class="row mb-4 text-center">
                       <div class="col">
                        <center>
                        <div class="form-group">
                        <input type="text" style="width: 50%; text-align: center;" id="lessontitle" placeholder="TITLE" class="form-control mb-1" />
                        <textarea class="form-control" style="width: 70%; text-align: center;" id="lessondescription" placeholder="Description" rows="4"></textarea>
                        <label class="form-check-label mx-1" for="gradelevel" style="color:gray;"> Grade Level:   </label> <input type="number" style="width: 5%; text-align: center; border: solid 0.5px gray;" min="1" max="3" id="gradelevel" placeholder="" class="mt-1" /> <br>
                        <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Submit</button>
                      
                      </center>
                        </div>
                      </div>
                    </div>
      

                    </form>
>>>>>>> 2ce9b0c4a8b2304ba10361433fa7974d22ff1a24


                <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Submit</button>
        </form>
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

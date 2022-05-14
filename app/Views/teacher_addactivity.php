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

   <div >
     <div class="container h-100" style="margin-bottom:5%;" >
        <div class="row">
          <div class="backbutton col-2">
              <a href="<?php echo base_url(); ?>/public/teacher/view" style="text-decoration: none; color: rgb(68, 68, 68);" >
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
              </svg>
              </a>
          </div>
          <div>
          <h2 class="text-uppercase text-center">ADD ACTIVITY FOR <?= $lesson->lesson_name; ?></h2>

        <br>
      </div>
          <div class="col-10 col-md-8 offset-md-2">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="" style="font-size:25px;">Activity Title</label>
                  <input type="text" id="activity-txtarea" class="form-control" name="activity_name" style="height: 50px;" required>
              </div>
              <div class="text-danger" style="margin-top:3%;">
                <?php if (isset($validation)): ?>
                      <?php if ($validation->hasError('activity_name')): ?>
                            <p>  <?= $validation->getError('activity_name') ?></p>
                      <?php endif; ?>
                <?php endif; ?>
              </div>

                <div class="form-group">
                  <label for="" style="font-size:25px;">Activity Instruction</label>
                  <textarea type="text" id="activity-txtarea" class="form-control" name="activity_instruction" rows="3" style="" required></textarea>
                </div>
                <div class="text-danger" style="margin-top:2%;margin-bottom:2%;">
                  <?php if (isset($validation)): ?>
                        <?php if ($validation->hasError('activity_description')): ?>
                              <p>  <?= $validation->getError('activity_description') ?></p>
                        <?php endif; ?>
                  <?php endif; ?>
                </div>
                <label class="form-check-label mx-1" for="gradelevel" style="font-size:25px;"> Activity Type  </label>
                <div class="form-check container-activity-type">
                  <input class="form-check-input radio-btn" type="radio" id="flexRadioDefault1" name="activity_type" value='multiple_choice' required>
                  <label class="form-check-label label-activity-type" for="flexRadioDefault1">
                    Multiple Choice
                  </label>
                </div>
                <div class="form-check container-activity-type">
                  <input class="form-check-input radio-btn" type="radio" id="flexRadioDefault1" name="activity_type" value='enumeration' required>
                  <label class="form-check-label label-activity-type" for="flexRadioDefault1">
                    Enumeration
                  </label>
                </div>
                <div class="form-check container-activity-type">
                  <input class="form-check-input radio-btn" type="radio" id="flexRadioDefault1" name="activity_type" value='identification' required>
                  <label class="form-check-label label-activity-type" for="flexRadioDefault1">
                    Identification
                  </label>
                </div>
                <div class="text-danger" style="margin-top:3%;">
                  <?php if (isset($validation)): ?>
                        <?php if ($validation->hasError('activity_type')): ?>
                              <p>  <?= $validation->getError('activity_type') ?></p>
                        <?php endif; ?>
                  <?php endif; ?>
                </div>

                <center>
                <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Submit</button>
              </center>
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
             var loadFile = function(event) {
	           var image = document.getElementById('output');
	           image.src = URL.createObjectURL(event.target.files[0]);
              };
         </script>

<script>
  $( ".dropdown" ).click(function() {
    $( ".menu").toggle();
});
</script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>


</body>
</html>


<?= $this->endSection() ?>

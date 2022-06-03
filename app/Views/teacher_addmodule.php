<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-7">
               <a href="<?php echo base_url(); ?>/public/teacher/home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
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
        <a href="<?php echo base_url(); ?>/public/teacher/logout">Logout</a>
        </div>
   </div>

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

        <br>
      </div>
          <div class="col-10 col-md-8 offset-md-2">
            <form action="addmodule" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="" style="font-size:25px;">Title</label>
                  <input type="text" id="" class="form-control" name="lesson_name" style="border-color: #00acee; border-width: 2px; border-radius:15px; height: 50px;">
              </div>
              <div class="text-danger" style="margin-top:3%;">
                <?php if (isset($validation)): ?>
                      <?php if ($validation->hasError('lesson_name')): ?>
                            <p>  <?= $validation->getError('lesson_name') ?></p>
                      <?php endif; ?>
                <?php endif; ?>
              </div>

                <div class="form-group">
                  <label for="" style="font-size:25px;">Description/Instruction</label>
                  <textarea type="text" id="" class="form-control" name="lesson_description" rows="3" style="border-color: #00acee; border-width: 2px; border-radius:15px;"></textarea>
                </div>
                <div class="text-danger" style="margin-top:2%;margin-bottom:2%;">
                  <?php if (isset($validation)): ?>
                        <?php if ($validation->hasError('lesson_description')): ?>
                              <p>  <?= $validation->getError('lesson_description') ?></p>
                        <?php endif; ?>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label class="form-check-label mx-1" for="gradelevel" style="font-size:25px;"> Unit  </label>
                  <br>
                   <input type="number" style="margin-left: auto;width: 50%; height: 50px; text-align: center; border: solid 2px #00acee; border-radius:15px;" id="unit" name="unit" placeholder="" class="mt-1" min='1' max='4'/> <br>
                </div>
                <div class="text-danger" style="margin-top:3%;">
                  <?php if (isset($validation)): ?>
                        <?php if ($validation->hasError('unit')): ?>
                              <p>  <?= $validation->getError('unit') ?></p>
                        <?php endif; ?>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label for="" style="font-size:25px; margin-bottom:3%;">Media</label>

                  <div class="text-danger" style="margin-top:3%;">
                    <label class="btn btn-primary">
                      <i class="fa fa-image"></i> Add Media<input type="file" style="display: none;" name="image" id="image" class="form-control-file" onchange="loadFile(event)">
                    </label>

                  <center>
                  <img id="output" width="350" />
                </center>
                    <?php if (isset($validation)): ?>
                          <?php if ($validation->hasError('image')): ?>
                                <p>  <?= $validation->getError('image') ?></p>
                          <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>
                <br>
                <div class="form-group">
                  <label for="" style="font-size:25px; margin-bottom:3%;">Discussion</label>
                  <textarea class="form-control" style="width: 100%; border: 2px solid #00acee;" id="exampleFormControlTextarea1" placeholder="Discussion" rows="4" name="discussion"></textarea>
                  <div class="text-danger" style="margin-top:3%;">
                    <?php if (isset($validation)): ?>
                          <?php if ($validation->hasError('discussion')): ?>
                                <p>  <?= $validation->getError('discussion') ?></p>
                          <?php endif; ?>
                    <?php endif; ?>
                  </div>
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

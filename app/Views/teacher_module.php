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

<center>

  <div class="container h-100" style="margin-bottom:5%;" id="wrapper" >
     <div class="row">
       <div class="backbutton col-1">
           <a href="<?php echo base_url(); ?>/public/teacher/view" style="text-decoration: none; color: rgb(68, 68, 68);">
           <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
               <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
           </svg>
           </a>
       </div>
       <br><br><br>
      <div>
        <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert" style="margin-bottom:5%;">
              <h4><?= session()->get('success') ?></h4>
          </div>
        <?php endif; ?>
        <br>
   </div>
       <div class="mt-3">
         <br>
             <h1 style="text-align:left;font-size:80px;"><b><?= $users->lesson_name; ?></b></h1>
             <hr style="width:100%;height:2px;color:#00acee">
             <h3 style="text-align:left"><?= $users->lesson_description; ?></h3>
       </div>
       <!-- form for the lesson -->
      <div style="margin-top:2%;">
         <?php if (session()->get('updatesuccess')): ?>
           <div class="alert alert-success" role="alert" style="margin-bottom:2%;">
               <h4><?= session()->get('updatesuccess') ?></h4>
           </div>
         <?php endif; ?>
         <br>
    </div>

    <div class="imageview">
      <a href="<?=base_url()?>/public/uploads/images/<?= $image->file_name; ?>" target="_blank"><img src="<?=base_url()?>/public/uploads/images/<?= $image->file_name; ?>"  alt="" width="400" height="600" onclick="myFunction(this);"></a>
    </div>
    <!-- <div class="expandingcontainer">
      <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
      <img id="expandedImg" style="width:100%">
      <div id="imgtext"></div>
    </div> -->
    <div>
      <h1 style="margin-top:5%;"><?= $discussion->discussion; ?></h1>
    </div>
   </div>
 </div>

 <div class="container">
   <div class="row">
     <div class="mt-3">
        <h1 style="text-align:left">Examples</h1>
        <hr style="width:100%;height:2px;color:#00acee;">
        <h1 style="text-align:left;">   <button id="toggle" class="btn btn-info mb-4 mt-4" style="margin-bottom:1%; "  align="left"> Add Example</button></h1>
     </div>
   </div>
   <br>
 </div>
 <form class="" action="" method="post" id="form" style="display:none;">
   <div class="container" style="margin-top:5%;">
     <div class="row">
       <div class="col-sm">
               <div class="form-group">
                 <label for="" style="font-size:25px; margin-bottom:3%;">Example</label>
                 <textarea class="form-control" style="width: 100%; border: 2px solid #00acee;" id="exampleFormControlTextarea1" placeholder="Discussion" rows="4" name="discussion"></textarea>
                 <div class="text-danger" style="margin-top:3%;">
                   <?php if (isset($validation)): ?>
                         <?php if ($validation->hasError('discussion')): ?>
                               <p>  <?= $validation->getError('discussion') ?></p>
                         <?php endif; ?>
                   <?php endif; ?>
                 </div>
               </div>
       </div>
       <div class="col-sm" >
         <div class="form-group">
           <br>
           <input type="file" name="image" id="image" class="form-control-file" onchange="loadFile(event)">
           <div class="text-danger" style="margin-top:3%;">
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
       </div>
     </div>
   </div>
   <br>
   <center>
   <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Submit</button>
 </center>
</form>




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
<script>
function myFunction(imgs) {
  var expandImg = document.getElementById("expandedImg");
  var imgText = document.getElementById("imgtext");
  expandImg.src = imgs.src;
  imgText.innerHTML = imgs.alt;
  expandImg.parentElement.style.display = "block";
}
</script>

<script>
  $('#toggle').click(function(){
    $('#form').toggle();
  });
</script>


<?= $this->endSection() ?>

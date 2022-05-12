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
       <div class="col mt">
         <br>
             <h1 style="text-align:left;font-size:6 0px;"><b><?= $users->activity_name; ?></b></h1>
             <hr style="width:100%;height:2px;color:#00acee">
             <h3 style="text-align:left"><?= $users->activity_instruction; ?></h3>
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

   </div>
 </div>

 <form class="" action="<?php echo site_url('teacher/viewmodule/'.$users->lesson_id);?>" method="post" id="form" style="display:none;"  enctype="multipart/form-data">
   <div class="container" style="margin-top:5%;">
     <div class="row">
       <div class="col-sm">
               <div class="form-group">
                 <label for="" style="font-size:25px; margin-bottom:3%;">Example Content</label>
                 <textarea class="form-control" style="width: 100%; border: 2px solid #00acee;" id="exampleFormControlTextarea1" placeholder="Discussion" rows="4" name="example"></textarea>

               </div>
       </div>
       <div class="col-sm" >
         <div class="form-group ">

             <label class="btn btn-success" style="margin-top:10%;">
                <i class="fa fa-image"></i> Add Media<input type="file" style="display: none;" name="image" id="image" class="form-control-file" onchange="loadFile(event)" class="align-middle" style="border-top:5%;">
             </label>

           <center>
              <img id="output" width="350" />
          </center>

         </div>
       </div>

     </div>
   </div>
   <br>
   <center>
   <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Submit</button>
 </center>
</form>

</div>
<div class="container">
 <div class="row">
   <div class="col-mt">
     <h1 style="text-align:middle;">   <button id="toggle" class="btn btn-success mb-4 mt-4" style="margin-bottom:1%; "  align="left"> Add Activity</button></h1>
   </div>
 </div>
</div>



<a href="#" onclick="show('popup2')">Show popup (:before & :after)</a>

 <div class="popup" id="popup2">
   <h1 style="background-color:grey;">Question <?= $question_no ?></h1>
   <form action="" method="post" enctype="multipart/form-data">



       <div class="form-group">
         <label for="" style="font-size:25px;">Activity Instruction</label>
         <textarea type="text" id="" class="form-control" name="activity_question" rows="3" style="border-color: #00acee; border-width: 2px; "></textarea>
       </div>
       <div class="text-danger" style="margin-top:2%;margin-bottom:2%;">
         <?php if (isset($validation)): ?>
               <?php if ($validation->hasError('activity_description')): ?>
                     <p>  <?= $validation->getError('activity_description') ?></p>
               <?php endif; ?>
         <?php endif; ?>
       </div>
       <label class="form-check-label mx-1" for="gradelevel" style="font-size:25px;"> Activity Type  </label>
       <div class="form-check">
         <input class="form-check-input" type="radio" id="flexRadioDefault1" name="activity_type" value='multiple_choice' required>
         <label class="form-check-label" for="flexRadioDefault1">
           Multiple Choice
         </label>
       </div>
       <div class="form-check">
         <input class="form-check-input" type="radio" id="flexRadioDefault1" name="activity_type" value='enumeration' required>
         <label class="form-check-label" for="flexRadioDefault1">
           Enumeration
         </label>
       </div>
       <div class="form-check">
         <input class="form-check-input" type="radio" id="flexRadioDefault1" name="activity_type" value='identification' required>
         <label class="form-check-label" for="flexRadioDefault1">
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
   <a href="#" onclick="hide('popup2')">Ok!</a>
 </div>




<script>
$ = function(id) {
  return document.getElementById('popup2');
}

function show(id) {

  var set = document.getElementById('popup2');
  set.style.display ='block';
}


function hide(id) {

  var set = document.getElementById('popup2');
  set.style.display ='none';
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
<script>
function myFunction(imgs) {
  var expandImg = document.getElementById("expandedImg");
  var imgText = document.getElementById("imgtext");
  expandImg.src = imgs.src;
  imgText.innerHTML = imgs.alt;
  expandImg.parentElement.style.display = "block";
}
</script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready( function () {
      $('#users-list').DataTable({
         "bPaginate": false,
         "bInfo" : false,
         "searching": false,
      //   dom: 'Bfrtip',
         "language": {
           "emptyTable": "No examples uploaded"
         },
       //   buttons: [
       //     {
       //         text: 'Add Example',
       //         action: function ( e, dt, node, config ) {
       //             alert( 'Button activated' );
       //         }
       //     }
       // ],
          "responsive": true,
      });
      $('#users-list2').DataTable({
         "bPaginate": false,
         "bInfo" : false,
         "searching": false,
         "language": {
           "emptyTable": "No uploaded module for Unit 2"
         },
          "responsive": true,
      });
      $('#users-list3').DataTable({
         "bPaginate": false,
         "bInfo" : false,
         "searching": false,
         "language": {
           "emptyTable": "No uploaded module for Unit 3"
         },
          "responsive": true,
      });
      $('#users-list4').DataTable({
         "bPaginate": false,
         "bInfo" : false,
         "searching": false,
         "language": {
           "emptyTable": "No uploaded module for Unit 4"
         },
          "responsive": true,
      });
  } );
</script>


<?= $this->endSection() ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php $example_no=0; ?>

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

 <form class="" action="<?php echo site_url('teacher/update_example/'.$example->example_id);?>" method="post" id="form"  enctype="multipart/form-data">
   <div class="container" style="margin-top:5%;">
     <div class="row">
       <div class="col-sm">
               <div class="form-group">
                 <label for="" style="font-size:25px; margin-bottom:3%;">Example Content</label>
                 <textarea class="form-control" style="width: 50%; border: 2px solid #00acee;" id="exampleFormControlTextarea1" placeholder="Discussion" rows="4" name="example"><?= $example->example; ?></textarea>
               </div>
               <div class="text-danger" style="margin-top:3%;">
                 <?php if (isset($validation)): ?>
                       <?php if ($validation->hasError('example')): ?>
                             <p>  <?= $validation->getError('example') ?></p>
                       <?php endif; ?>
                 <?php endif; ?>
               </div>
       </div>
     </div>
   </div>
   <div class="container">
     <div class="row">
       <div class="col-sm" >
         <div class="form-group ">
           <h4 style="margin-bottom:5%;">Activity Media</h4>

             <?php if (strcmp($example->file_extension,'mp4')==0): ?>
               <video controls>
                   <source src="<?=base_url()?>/public/uploads/images/<?= $example->file_name; ?>" type="video/mp4">
             </video>
             <?php else: ?>
                 <a href="<?=base_url()?>/public/uploads/images/<?= $example->file_name; ?>" target="_blank"><img src="<?=base_url()?>/public/uploads/images/<?= $example->file_name; ?>"  alt="" width="70%" height="70$" onclick="myFunction(this);" class="img-fluid"></a>
             <?php endif; ?>
             <br>
             <label class="btn btn-success" style="margin-top:10%;">
                <i class="fa fa-image"></i> Update Media<input type="file" style="display: none;" name="image" id="image" class="form-control-file" onchange="loadFile(event)" class="align-middle" style="border-top:5%;">
             </label>
             <div class="text-danger" style="margin-top:3%;">
               <?php if (isset($validation)): ?>
                     <?php if ($validation->hasError('image')): ?>
                           <p>  <?= $validation->getError('image') ?></p>
                     <?php endif; ?>
               <?php endif; ?>
             </div>
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

<script>
  $('#toggle').click(function(){
    $('#form').toggle();
  });
</script>
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

<script>
  function doconfirm()
  {
      job=confirm("Are you sure to delete the question permanently?");
      if(job!=true)
      {
          return false;
      }
  }
  </script>


<?= $this->endSection() ?>

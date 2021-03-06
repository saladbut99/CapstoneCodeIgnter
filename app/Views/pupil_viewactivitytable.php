<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php $example_no=0;

      $display='none';
 ?>

<div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-7">
               <a href="<?php echo base_url(); ?>/public/pupil/home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
           </div>
           <div class="col-4 text-center pt-3">
               <p style="color:white; text-align:right;"><?= session()->get('firstname') ?> <?= session()->get('lastname') ?></p>
           </div>
           <div class="col-1 p-0 text-center">
               <div style="margin-right: 0%;">
                   <a href="#" class="dropdown"><img src="<?=base_url()?>/public/assets/images/student_logo.png" alt="" class="nav_img" height="60" width="60"></a>
                </div>
           </div>
       </nav>
   </div>
   <div class="menu p-2 text-center">

        <div class="">
        <a href="<?php echo base_url(); ?>/public/pupil/logout">Logout</a>
        </div>
   </div>



  <div class="container mt-5" style="margin-bottom:5%;">
    <div class="mt-3">
      <div class="backbutton py-2 px-2" style="background-color:teal; width: 12%; border: 1px solid black; border-radius: 20px; border-right: none;">
          <a style="text-decoration: none; color: rgb(68, 68, 68); cursor:pointer" href="<?php echo base_url(); ?>/public/pupil/viewmoduleactivity  " /onclick = "history.back()">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
          </svg>
          <h7>Go Back</h7>
          </a>
      </div>
      <center>
      <br>
       <h2 class="text-uppercase text-center">ACTIVITIES FOR MODULE: <?= $lesson->lesson_name; ?></h2>
      <?php if (!$users): ?>
         <h1 style="text-align:center;">No Added or Published Activity</h1>
     <?php else: ?>

       <table class="table table-borderless table-hover" id="users-list"  style=" border-bottom: none;">

            <tr>
               <th style="width:70%;">Activity Name</th>
               <th></th>
            </tr>


            <?php if($users): ?>
            <?php foreach($users as $user): ?>
              <?php if (strcmp(strtoupper($user['status']),strtoupper('published'))==0): ?>
                <?php foreach ($join as $joins): ?>
                  <?php if ($user['activity_id']==$joins['activity_id'] && $joins['pupil_id']==session()->get('t_id') ): ?>
                        <?php $display='block'; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
                    <tr style="text-align:center;">
                     <td style="text-align:left"><a href="<?php echo base_url(); ?>/public/pupil/viewperformance/<?= $user['activity_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['activity_name']; ?></a>  </td>
                     <td style="text-align:left;display:<?= $display ?>;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-check-lg" viewBox="0 0 16 16">
                       <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                     </svg>
                   </td>
                  </tr>
                  <?php $display='none';?>
              <?php endif; ?>
           <?php endforeach; ?>
           <?php endif; ?>
       </table>
      <?php endif; ?>

    </div>
  </div>



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
           "emptyTable": "No Added or Published Activity"
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

<style>
  .backbutton:hover {
    background-color: teal !important;
    transform: scale(1.04);
    transition: transform .2s ease-in-out;
  }

  .backbutton:hover > * {
   color: whitesmoke !important;
  }
</style>


<?= $this->endSection() ?>

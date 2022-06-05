<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php $section_id=$pupil->section_id;?>

<div class="navbar mb-0" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
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
   <audio id="beep-one" hidden preload="auto">
    <source src="<?=base_url()?>/public/assets/click2.mp3">
    <source src="audio/beep.ogg">
  </audio>

   <?php if (session()->get('updatesuccess')): ?>
   <div class="alert alert-success" role="alert" style="margin-bottom:5%;">
       <h4><?= session()->get('updatesuccess') ?></h4>
   </div>
  <?php endif; ?>



   <div class="container my-0 py-5" id="conviewmodact" style="height: 100vh;">
     <div class="row" style="background-image: url(<?=base_url()?>/public/assets/images/pupilbanner.jpg)">
      <!-- BACKBUTTON DIV -->
      <div class="backbutton col-3 d-flex align-items-center">
          <a href="home" style="text-decoration: none; color: rgb(68, 68, 68);">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="whitesmoke" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
          </a>
        <h6 style="margin-left:1rem !important; color:whitesmoke;">Return Home</h6>
      </div>

      <!-- BUTTONS FOR TABLE POP UP -->
      <div class="buttonforunit col d-flex align-items-center">
        <h4 id="kwarter"> KWARTER: </h4>
        <button class="btn btn-lg btn-unit" id="btn-unit1"> 1 </button>
        <button class="btn btn-lg btn-unit" id="btn-unit2" style="color: whitesmoke;"> 2 </button>
        <button class="btn btn-lg btn-unit" id="btn-unit3" style="color: whitesmoke;"> 3 </button>
        <button class="btn btn-lg btn-unit" id="btn-unit4" style="color: whitesmoke;"> 4 </button>
      </div>
    </div>
       <center>
       <div class="row">
          <div class="col mt-5">
                <h1>Choose Module to View Activity Scores</h1>
          </div>
       </div>
     </center>
       <br>
       <?php if (!$users): ?>
          <h1 style="text-align:center;">No Added Module</h1>
      <?php else: ?>

        <table class="table table-borderless table-hover" id="users-list"  style=" border-bottom: none;">
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 1</th>

             </tr>
          </thead>



             <?php if($users): ?>
             <?php foreach($users as $user): ?>
              <?php if ($user['unit']==1 && $user['section_id']==$section_id): ?>
                 <tr style="text-align:center;">
                    <td style="text-align:left"><a href="viewactivitytable/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>
                  </tr>
               <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <table class="table table-borderless table-hover" id="users-list2" style=" border-bottom: none;" >
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 2</th>

             </tr>
          </thead>

             <?php if($users): ?>
             <?php foreach($users as $user): ?>


               <?php if ($user['unit']==2 && $user['section_id']==$section_id): ?>
                 <tr style="text-align:center;">
                   <td style="text-align:left"><a href="viewactivitytable/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>

                  </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <table class="table table-borderless table-hover" id="users-list3" style=" border-bottom: none;" >
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 3</th>

             </tr>
          </thead>
             <?php if($users): ?>
             <?php foreach($users as $user): ?>
               <?php if ($user['unit']==3 && $user['section_id']==$section_id): ?>
                 <tr style="text-align:center;">
                   <td style="text-align:left"><a href="viewactivitytable/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>

                  </tr>
              <?php endif; ?>

            <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <table class="table table-borderless table-hover" id="users-list4" style=" border-bottom: none;" >
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 4</th>

             </tr>
          </thead>
             <?php if($users): ?>
             <?php foreach($users as $user): ?>
               <?php if ($user['unit']==4 && $user['section_id']==$section_id): ?>
                 <tr style="text-align:center">
                   <td style="text-align:left"><a href="viewactivitytable/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>

                  </tr>
              <?php endif; ?>

            <?php endforeach; ?>
            <?php endif; ?>
        </table>
       <?php endif; ?>

     </div>
   </div>

               <//script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
   <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   <script>
       $(document).ready( function () {
         $('#users-list').DataTable({
            "bPaginate": false,
            "bInfo" : false,
            "searching": false,
            "language": {
              "emptyTable": "No uploaded module for Unit 1"
            },
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
  $( ".dropdown" ).click(function() {
    $( ".menu").toggle();
});
</script>
<script>
  function doconfirm()
  {
      job=confirm("Are you sure to delete permanently?");
      if(job!=true)
      {
          return false;
      }
  }
  </script>

  <script>
    $( "#btn-unit1" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: whitesmoke !important; color: black;'});
    $( "#btn-unit2" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit3" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit4" ).css({'cssText':'color: whitesmoke;'});
    $( "#users-list").show();
    $( "#users-list2").hide();
    $( "#users-list3").hide();
    $( "#users-list4").hide();
    $('html, body').animate({
        scrollTop: $('#conviewmodact').offset().top
    }, 000);
});
$( "#btn-unit2" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: rgba(255,255,255,0) !important; color: whitesmoke;'});
    $( "#btn-unit2" ).css({'cssText':'color: black;'});
    $( "#btn-unit3" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit4" ).css({'cssText':'color: whitesmoke;'});
    $( "#users-list").hide();
    $( "#users-list2").show();
    $( "#users-list3").hide();
    $( "#users-list4").hide();
    $('html, body').animate({
        scrollTop: $('#conviewmodact').offset().top
    }, 000);
});
$( "#btn-unit3" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: rgba(255,255,255,0) !important; color: whitesmoke;'});
    $( "#btn-unit2" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit3" ).css({'cssText':'color: black;'});
    $( "#btn-unit4" ).css({'cssText':'color: whitesmoke;'});
    $( "#users-list").hide();
    $( "#users-list2").hide();
    $( "#users-list3").show();
    $( "#users-list4").hide();
    $('html, body').animate({
        scrollTop: $('#conviewmodact').offset().top
    }, 000);
});
$( "#btn-unit4" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: rgba(255,255,255,0) !important; color: whitesmoke;'});
    $( "#btn-unit2" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit3" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit4" ).css({'cssText':'color: black;'});
    $( "#users-list").hide();
    $( "#users-list2").hide();
    $( "#users-list3").hide();
    $( "#users-list4").show();
    $('html, body').animate({
        scrollTop: $('#conviewmodact').offset().top
    }, 000);
});

$(document).ready(function () {
    $('html, body').animate({
        scrollTop: $('#conviewmodact').offset().top
    }, 1000);
});

var beepOne = $("#beep-one")[0];
$(".btn-unit").click(function () {
beepOne.currentTime=0;
beepOne.play();
});



  </script>


<style>
  .btn:focus {
      outline: none !important;
      box-shadow: none !important;
    }
    
  #image-float {
    position: fixed;
    height: auto;
    width: auto;
    bottom: 0px;
    right: 0px;
    float: right;
  }
  #image-float > img {
    height: 400px
   }
  </style>

<div id="image-float">
  <img src="<?=base_url()?>/public/assets/images/cast-image.png" alt="">
</div>
<?= $this->endSection() ?>

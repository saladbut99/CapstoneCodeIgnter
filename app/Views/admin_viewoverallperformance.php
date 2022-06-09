<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

  <?php
    $question_no=0;
    $choice_id=0;
    $count=1;
    $display='block';
    $display2='none';
    $total=0;
    $range=0;
    $total_score=0;
    $message='';
  ?>

  <div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
         <nav class="nav row w-100 align-items-center">
             <div class="col-7">
                 <a href="<?php echo base_url(); ?>/public/admin/home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
             </div>
             <div class="col-4 text-center pt-3">
                  <p style="color:white; text-align:right;"><?= session()->get('firstname') ?> <?= session()->get('lastname') ?></p>
             </div>
             <div class="col-1 p-0 text-center">
                 <div style="margin-right: 0%;">
                     <a href="#" class="dropdown"><img src="<?=base_url()?>/public/assets/images/admin.png" alt="" class="nav_img" height="60" width="60"></a>
                  </div>
             </div>
         </nav>
     </div>
     <div class="menu p-2 text-center">
          <div class="">
          <a href="<?php echo base_url(); ?>/public/admin/logout">Logout</a>
          </div>
     </div>
     <script>
       $( ".dropdown" ).click(function() {
         $( ".menu").toggle();
     });
     </script>
<center>


  <div class="container h-100" style="margin-bottom:0%;" id="wrapper" >
     <div class="row">
       <div class="backbutton col-1">
           <a href="#" onclick="history.back()" style="text-decoration: none; color: rgb(68, 68, 68); cursor:pointer;">
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
        </div>
      </div>
<?php foreach ($pupil as $key ): ?>
 <?php
        $total=$total+$key['activity_score'];
        $range=$range+$key['perfect_score'];
    ?>
<?php endforeach; ?>
<?php if ($total == 0 && $range==0): ?>
        <?php $display='none'; ?>
        <?php $display2='block'; ?>
<?php else: ?>
    <?php   $total_score=$total/$range*100; ?>
    <?php if ($total_score>=50): ?>
        <?php $message='Theyre doing good, up the good work!'; ?>
    <?php else: ?>
      <?php $message='Monitoring of pupil is advised!'; ?>
    <?php endif; ?>
<?php endif; ?>

<!-- form for the question -->
<div class="container" style="display: <?= $display2 ?>">
  <div class="row">
      <div class="col">
          <h1><?= $pupilmodel->pupil_firstname ?> didn't answered the activities yet</h1>
      </div>
  </div>
</div>

<div class="container" style="display:<?= $display ?>;width:80%;border:10px solid #00acee;margin-bottom:2.5%; border-radius:4px; box-shadow:2px 3px 2px grey;padding:5%;border-radius:5%;">
    <div class="row">
      <div class="col">
          <h1>Hi Admin!</h1>
      </div>
    </div>
    <div class="row" style="margin-top:3%;">
      <div class="col">
          <h1><?= $pupilmodel->pupil_firstname ?>'s overall performance percentage is:</h1>
      </div>
    </div>
    <div class="row" style="margin-top:3%;">
      <div class="col">
          <h1><?= number_format((float)$total_score, 2, '.', ''); ?>%</h1>
      </div>
    </div>
    <div class="row" style="margin-top:3%;">
      <div class="col">
          <h1><?=$message ?></h1>
      </div>
    </div>
</div>






<script>
  function check() {
      var answer=  document.getElementById("answer").value;
      alert(answer);
  }
</script>


<script>
function addValueToRadioBtn() {
    if (document.getElementById("answer1").checked == true){
        document.getElementById("answer1").value = document.getElementById("question_1").value;
    }else   if (document.getElementById("answer2").checked == true){
            document.getElementById("answer2").value = document.getElementById("question_2").value;
    }else   if (document.getElementById("answer3").checked == true){
            document.getElementById("answer3").value = document.getElementById("question_3").value;
    }else {
        document.getElementById("answer4").value = document.getElementById("question_4").value;
    }


}

</script>

<script>
  $('#toggle').click(function(){
    $('#form').toggle();
    var set = document.getElementById('toggle');
    set.style.display ='none';

    var set1 = document.getElementById('border');
    set1.style.border ='1px solid green';
  });

</script>
<script>
$ = function(id) {
  return document.getElementById('popup2');
}

function show(id) {

  var set = document.getElementById('popup2');
  set.style.display ='block';

}


function hide(id) {

  var set = document.getElementById('form');
  set.style.display ='none';
  var set1 = document.getElementById('toggle');
  set1.style.display ='block';
  var set2 = document.getElementById('border');
  set2.style.border ='1px solid white';
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

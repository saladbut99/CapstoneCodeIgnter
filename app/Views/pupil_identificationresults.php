<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php $question_no=0;
    $choice_id=0;
 ?>
<div class="navbar mb-1" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
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
<center>

  <div class="container h-100 " style="margin-bottom:0%;" id="wrapper"  >
     <div class="row">
       <div class="backbutton col d-flex align-items-center">
           <a href="<?php echo base_url(); ?>/public/pupil/viewmodule/<?= $users->lesson_id; ?>" style="text-decoration: none; color: rgb(68, 68, 68); cursor:pointer;">
           <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
               <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
           </svg> Go Back
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

   <?php if ($performance->percentage_score>=50): ?>
       <?php $message='Keep up the good work!'; ?>
       <audio hidden autoplay>
           <source src="<?=base_url()?>/public/assets/joy.mp3" type="audio/mpeg">
       </audio>
   <?php else: ?>
     <?php $message='Whoops! Try the activity again!'; ?>
     <audio hidden autoplay>
         <source src="<?=base_url()?>/public/assets/sad.wav" type="audio/mpeg">
     </audio>
   <?php endif; ?>
   <br>
   <div class="container" style="width:80%;border:10px solid #00acee;margin-bottom:2.5%; border-radius:4px; box-shadow:2px 3px 2px grey;">
     <div class="row" style="margin-bottom:2%;">
         <div class="col">
              <h1><b>Activity Name:<br> <?= $users->activity_name; ?></b></h1>
         </div>
     </div>
       <div class="row" style="margin-bottom:2%;">
           <div class="col">
               <h1>Hi <?= session()->get('firstname') ?>!</h1>
           </div>
           <div class="col">
               <h1>Your Score:<?= $performance->activity_score ?>  / <?= $users->activity_perfect_score ?> </h1>
           </div>
       </div>
       <div class="row" style="margin-bottom:2%;">
       <div class="col" style="min-height: 60px;">
          <div class="metercontainer" style="min-height: 60px; width: 100%; text-align: start;">
            <div id="meterbody" style="min-height: 60px; width:<?= $performance->percentage_score ?>%; text-align: -webkit-right">
              <div id="meterhead" style="min-height: 60px; border: 2px solid black; border-radius: 50%; width: 4rem; display: flex; align-items: center;justify-content: center;">
                <h1 style="font-size:1.5rem;"><?= $performance->percentage_score ?>%</h1>
              </div>
            </div>
          </div>
        </div>
       </div>
       <div class="row">
           <div class="col">
               <h1><?= $message ?></h1>
           </div>
       </div>
   </div>
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

<center>

    <?php foreach ($question as $questions): ?>

     <?php $question_no++;  ?>
            <div class="container" style="width:80%;border:2px solid #00acee;margin-bottom:2.5%; border-radius:4px;box-shadow:2px 3px 2px grey;">
                <div class="row">
                    <div class="col">
                              <div class="row" style="margin-bottom:5%;">
                                  <div class="col-sm">
                                        <h3 style="text-align:left;margin-top:2%;margin-bottom:2%;">Question <?= $question_no; ?></h3>
                                  </div>

                              </div>

                        <h1 style="margin-bottom:2%;"><?= $questions['activity_question']; ?></h1>
                        <?php foreach ($media as $medias): ?>
                          <?php if ($medias['activity_content_id']==$questions['activity_content_id']): ?>
                            <?php if (strcmp($medias['file_extension'],'mp4')==0): ?>
                              <video controls>
                                  <source src="<?=base_url()?>/public/uploads/images/<?= $medias['file_name'] ?>" type="video/mp4">
                            </video>
                          <?php elseif (strcmp($medias['file_extension'],'mp3')==0): ?>
                              <audio controls>
                                  <source src="<?=base_url()?>/public/uploads/images/<?= $medias['file_name'] ?>" type="audio/mpeg">
                            </audio>
                          <?php elseif (strcmp($medias['file_extension'],'wav')==0): ?>
                              <audio controls>
                                  <source src="<?=base_url()?>/public/uploads/images/<?= $medias['file_name']; ?>" type="	audio/wav">
                            </audio>
                            <?php else: ?>
                                <a href="<?=base_url()?>/public/uploads/images/<?= $medias['file_name']; ?>" target="_blank"><img src="<?=base_url()?>/public/uploads/images/<?= $medias['file_name']; ?>"  alt="" width="70%" height="70$" onclick="myFunction(this);" class="img-fluid"></a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endforeach; ?>

                        <div class="strike" >
                          <span style="color:grey;">Corret Answer</span>
                        </div>

                                <div class="" style="margin-bottom:2%; " >
                                        <h3 style="padding: 2%;border: 2px solid green; width:50%; border-radius:10px; color:green;"><?= $questions['activity_answer']; ?></h3>
                                </div>
                                <div class="strike" >
                                  <span style="color:grey;">Your Answer</span>
                                </div>
                                <?php foreach ($results as $result): ?>
                                    <?php if ($questions['activity_content_id']==$result['activity_content_id']): ?>
                                      <?php if (strcmp(trim(ucfirst($questions['activity_answer'])),trim(ucfirst($result['answer'])))==0): ?>
                                              <?php $color='green'; ?>
                                      <?php else: ?>
                                              <?php $color='red'; ?>
                                      <?php endif; ?>
                                      <div class="" style="margin-bottom:2%; " >
                                              <h3 style="padding: 2%;border: 2px solid <?= $color; ?>; width:50%; border-radius:10px; color:<?= $color; ?>;"><?= $result['answer']; ?></h3>
                                      </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <?php $choice_id+=1; ?>
    <?php endforeach; ?>
</center>
   </div>
 </div>


<!-- form for the question -->


<div id='border' style="border:1px solid white; width:70%; margin-bottom:5%; border-radius:10px;">


</div>

</div>


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
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
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


<?= $this->endSection() ?>

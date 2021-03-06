<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

  <?php
    $question_no=0;
    $choice_id=0;
    $display='block';
  ?>

  <div class="navbar my-0" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
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
              <script>
                $( ".dropdown" ).click(function() {
                  $( ".menu").toggle();
              });
              </script>
         </nav>
     </div>
     <div class="menu p-2 text-center">

          <div class="">
          <a href="<?php echo base_url(); ?>/public/pupil/logout">Logout</a>
          </div>
     </div>

<center>

  <div class="container h-100" style="margin-bottom:0%;" id="wrapper" >
     <div class="row">
       <div class="backbutton_multiplec col-1 p-2  mt-2 d-flex align-items-center" style="background-color: teal; border: 1px solid black; border-radius: 20px; border-right: none; width: max-content;">
           <a onclick = "history.back()" style="text-decoration: none; color: rgb(68, 68, 68); cursor:pointer;">
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
       <div class="col mt">
         <br>
             <div class="row">
               <div class="col">
                  <h1 style="text-align:left;font-size:6 0px;" id='sample'><b> <?= $users->activity_name; ?></b></h1>
               </div>
               <div class="col">
                  <h1 style="text-align:right;font-size:6 0px;"><b><?= $users->activity_perfect_score ?> / <?= $users->activity_perfect_score ?></b></h1>
               </div>
             </div>
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

<!-- QUESTIONS HERE -->
<center>
  <?php if (!$question): ?>
      <h1>This activity has no question yet, pleae try again later!</h1>
      <?php $display='none'; ?>
  <?php endif; ?>

  <form class=""  action="<?php echo site_url('pupil/check/'.$users->activity_id);?>" method="post" id="form" style="display:block; margin-bottom:5%;"  enctype="multipart/form-data">
    <?php foreach ($question as $questions): ?>

     <?php $question_no++;  ?>

            <div class="container p-5" style="width:80%;border:0.5px solid #00acee;margin-bottom:2.5%; border-radius:4px; box-shadow:2px 3px 2px grey;">
                <div class="row">
                    <div class="col">
                      <!--
                              <div class="row" style="margin-bottom:5%;">
                                  <div class="col-sm">
                                        <h3 style="text-align:left;margin-top:2%;margin-bottom:2%;">Question <?= $question_no; ?></h3>
                                  </div>
                              </div>
                      -->
                        <h1 style="margin-bottom:2%;"><?= $question_no; ?>. <?= $questions['activity_question']; ?></h1>
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
                                <a href="<?=base_url()?>/public/uploads/images/<?= $medias['file_name']; ?>" target="_blank"><img src="<?=base_url()?>/public/uploads/images/<?= $medias['file_name']; ?>"  alt="" width="70%" height="70%" onclick="myFunction(this);" class="img-fluid"></a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endforeach; ?>



                        <div class="strike" >
                          <span style="color:grey;"></span>
                        </div>
                        <?php foreach ($choice as $choices): ?>

                          <?php if ($choices['activity_content_id']==$questions['activity_content_id']): ?>


                                <div class="form-check d-flex justify-content-center" style="width:100%;" id="choice_radio">
                                  <input class="form-check-input radiobtn-mc"  type="radio" name="<?= $choice_id ?>[answer]" id="answer"  value="<?= $choices['choice']; ?>"  required >

                                  <label class="form-check-label choice_label" for="flexRadioDefault1" style="border: 2px solid grey; width:50%; border-radius:10px; color:grey;" id="choice_label">
                                    <?= $choices['choice']; ?>
                                    <input type="hidden" name="<?= $choice_id ?>[activity_content_id]" value="<?= $choices['activity_content_id'] ?>">
                                </div>


                          <?php endif; ?>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>


          <?php $choice_id+=1; ?>

    <?php endforeach; ?>
    <button type="submit" form="form" style="display: <?= $display;?>"  class="btn btn-primary btn-block mb-4 mt-4">Submit Quiz</button>
  </form>


</center>
   </div>
 </div>


<!-- form for the question -->



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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

  $(document).ready(function(){
  $("label").click(function(e){
    e.preventDefault();
    $check = $(this).prev();
    if($check.prop('checked'))
      $check.prop( "checked", false );
    else
      $check.prop( "checked", true );
  });
});

$(document).ready(function () {
    $('html, body').animate({
        scrollTop: $('#wrapper').offset().top
    }, 1000);
});



$(window).scroll(example);

function example() {
scrollTop = window.pageYOffset;
if (scrollTop == $('.navbar').offset().top) {
    console.log('Hi');
    $('html, body').stop(true, true).delay(2000).animate({
        scrollTop: $('#wrapper').offset().top
    }, 500);
  }}  ;
  </script>


<style>
  .backbutton_multiplec:hover {
    background-color: teal !important;
    transform: scale(1.04);
    transition: transform .2s ease-in-out;
  }

  .backbutton_multiplec:hover > * {
   color: whitesmoke !important;
  }

  #choice_label, #answer {
    cursor: pointer;
  }

  #choice_label:hover {
      background-color: rgba(0, 219, 0, 0.3);
  }

  #choice_label:active{
      background-color: rgba(0, 219, 0, 1);
  }

  #choice_label:active > #answer:checked{
      background-color: rgba(0, 219, 0, 1);
  }

  #answer:checked + label {
    background-color: rgba(0, 219, 0, 0.3);
  }
</style>

<?= $this->endSection() ?>

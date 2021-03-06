<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php $question_no=0; ?>

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

  <div class="container h-100" style="margin-bottom:0%;" id="wrapper" >
     <div class="row">
       <div class="backbutton col-1">
           <a href="<?php echo base_url(); ?>/public/teacher/viewmoduletable" style="text-decoration: none; color: rgb(68, 68, 68);">
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
         <div class="col">
            <h1 style="text-align:left;font-size:6 0px;"><b><?= $users->activity_name; ?></b></h1>
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
                                  <div class="col-sm" style="text-align:right;">
                                    <a href="<?php echo site_url('teacher/delete_identificationactivity/'.$questions['activity_content_id']);?>"  class="deletebutton" onclick="return doconfirm()" style="text-decoration:none;">
                                      <button type="button"  class="btn btn-outline-secondary" style="margin-top:2%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                      <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg> Delete
                                  </button>
                                    </a>
                                    <a href="<?php echo site_url('teacher/update_identification/'.$questions['activity_content_id']);?>" class="deletebutton" style="text-decoration:none;">
                                      <button type="button" class="btn btn-outline-secondary" style="margin-top:2%;">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                      </svg> Edit
                                      </button>
                                    </a>
                                  </div>
                              </div>

                        <h1 style="margin-bottom:2%;"><?= $questions['activity_question']; ?></h1>
                        <?php foreach ($media as $medias): ?>
                          <?php if ($medias['activity_content_id']==$questions['activity_content_id']): ?>
                            <?php if (strcmp($medias['file_extension'],'mp4')==0): ?>
                              <video controls>
                                  <source src="<?=base_url()?>/public/uploads/images/<?= $medias['file_name'] ?>" type="video/mp4">
                            </video>
                            <?php else: ?>
                                <a href="<?=base_url()?>/public/uploads/images/<?= $medias['file_name']; ?>" target="_blank"><img src="<?=base_url()?>/public/uploads/images/<?= $medias['file_name']; ?>"  alt="" width="70%" height="70$" onclick="myFunction(this);" class="img-fluid"></a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endforeach; ?>



                        <div class="strike" >
                          <span style="color:grey;">Answer</span>
                        </div>

                                <div class="" style="margin-bottom:2%; " >
                                        <h3 style="padding: 2%;border: 2px solid green; width:50%; border-radius:10px; color:green;"><?= $questions['activity_answer']; ?></h3>
                                </div>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
</center>
   </div>
 </div>
 <div class="container">
  <div class="row">
    <div class="col-mt">
      <h1 style="text-align:middle;">   <button id="toggle" class="btn btn-success mb-4 mt-4" style="margin-bottom:1%; display: block;"  > Add Question</button></h1>
    </div>
  </div>
 </div>

<!-- form for the question -->


<div id='border' style="border:1px solid white; width:70%; margin-bottom:5%; border-radius:10px;">
 <form class="" action="<?php echo site_url('teacher/addquestion_identification/'.$users->activity_id);?>" method="post" id="form" style="display:none; margin-bottom:5%;"  enctype="multipart/form-data">
  <div class="container">
    <div class="row">
      <div class="col">
        <a href="#" onclick="hide('popup2')" >
          <p style="text-align:right;"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
          </svg></p>
        </a>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 style="margin-bottom:5%;">Question <?= $question_no+=1; ?></h1>
      </div>
    </div>
  </div>

   <div class="container" style="margin-top:0%;">
     <div class="row">
       <div class="col-sm">
               <div class="form-group">
                 <label for="" style="font-size:25px; margin-bottom:3%;">Activity Question</label>
                 <textarea class="form-control" style="width: 100%; border: 2px solid #00acee;" id="exampleFormControlTextarea1" placeholder="" rows="4" name="activity_question"></textarea>
               </div>
               <div class="text-danger" style="margin-top:3%;">
                 <?php if (isset($validation)): ?>
                       <?php if ($validation->hasError('activity_question')): ?>
                             <p>  <?= $validation->getError('activity_question') ?></p>
                       <?php endif; ?>
                 <?php endif; ?>
               </div>
       </div>
       <div class="col-sm" >
         <div class="form-group ">
             <label class="btn btn-success" style="margin-top:10%;margin-bottom:3%">
                <i class="fa fa-image"></i> Add Media<input type="file" style="display: none;" name="image" id="image" class="form-control-file" onchange="loadFile(event)" class="align-middle" style="border-top:5%;">
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

   <div style="width:90%;">
     <h2 style="margin-bottom:2%;"> Question Answer</h2>
     <div class="form-check grupouno">

       <label class="form-check-label" for="flexRadioDefault1" >
           <input type="text" id="question_4" class="form-control input-mc" name="activity_answer" style="border-color: #00acee; border-width: 2px; border-radius:15px; height: 50px;" required>
       </label>
     </div>

   </div>

   <center>
   <button type="submit" onclick ="addValueToRadioBtn();" class="btn btn-primary btn-block mb-4 mt-4">Submit</button>
 </center>
</form>

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

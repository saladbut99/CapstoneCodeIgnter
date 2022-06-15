<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php $num=1; $num2=1;?>

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
   <div id='border' style="border:1px solid white; width:70%; margin-bottom:5%; border-radius:10px; display:block;">
    <form class="" action="<?php echo site_url('teacher/update_question/'.$activity->activity_content_id);?>" method="post" id="form" style="display:block; margin-bottom:5%;"  enctype="multipart/form-data">
     <div class="container">
       <div class="row">
         <div class="col">
           <a style="cursor:pointer;" onclick="history.back()">
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
           <h1 style="margin-bottom:5%;">Updte Question </h1>
         </div>
       </div>
     </div>


      <div class="container" style="margin-top:0%;">
        <div class="row">
          <div class="col-sm">
                  <div class="form-group">
                    <label for="" style="font-size:25px; margin-bottom:3%;">Activity Question</label>
                    <textarea class="form-control" style="width: 60%; border: 2px solid #00acee;" id="exampleFormControlTextarea1" placeholder="" rows="4" name="activity_question"><?= $activity->activity_question ?></textarea>
                  </div>
                  <div class="text-danger" style="margin-top:3%;">
                    <?php if (isset($validation)): ?>
                          <?php if ($validation->hasError('activity_question')): ?>
                                <p>  <?= $validation->getError('activity_question') ?></p>
                          <?php endif; ?>
                    <?php endif; ?>
                  </div>
          </div>
        </div>
      </div>
      <br>
      <div class="container">
        <div class="row">
          <div class="col-sm" >
            <div class="form-group ">
              <h4 style="margin-bottom:5%;">Activity Media</h4>

                <?php if (strcmp($medias->file_extension,'mp4')==0): ?>
                  <video controls>
                      <source src="<?=base_url()?>/public/uploads/images/<?= $medias->file_name; ?>" type="video/mp4">
                </video>
                <?php else: ?>
                    <a href="<?=base_url()?>/public/uploads/images/<?= $medias->file_name; ?>" target="_blank"><img src="<?=base_url()?>/public/uploads/images/<?= $medias->file_name; ?>"  alt="" width="70%" height="70$" onclick="myFunction(this);" class="img-fluid"></a>
                <?php endif; ?>
                <br>
                <label class="btn btn-success" style="margin-top:10%;margin-bottom:3%">
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
                 <img style="margin-top:5%;" id="output" width="auto" />
             </center>

            </div>
          </div>
        </div>
      </div>


      <div style="width:90%;">
        <h2 style="margin-bottom:2%; margin-top:5%;"> Answer Options  </h2>

        <?php foreach ($choices as $choice): ?>

                  <div class="form-check grupouno">
                    <input class="form-check-input radiobtn-mc" type="radio" name="activity_answer" id="answer<?= $num ?>"  value="" required>
                    <label class="form-check-label" for="flexRadioDefault1" >
                        <input type="text" id="question_<?= $num2 ?>" class="form-control input-mc" name="choice[]" maxlength="255" style="border-color: #00acee; border-width: 2px; border-radius:15px; height: 50px;" value="<?= $choice['choice'] ?>" required>
                    </label>
                  </div>
                  <?php if (strcmp($activity->activity_answer,$choice['choice'])==0): ?>
                      <?php echo '<script>
                          radiobtn = document.getElementById("answer'.$num.'");
                          radiobtn.checked = true;
                        </script>' ?>
                  <?php endif; ?>

              <?php $num+=1; $num2+=1; ?>
        <?php endforeach; ?>
      </div>

      <center>
      <button type="submit" onclick ="addValueToRadioBtn();" class="btn btn-primary btn-block mb-4 mt-4">Submit</button>
    </center>
   </form>

   </div>

   </div>
</center>

<script>
  var jsvar = <?php echo json_encode($activity->activity_answer); ?>;



  if (jsvar.localeCompare(choice)==0) {
    radiobtn = document.getElementById("answer1");
    radiobtn.checked = true;
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
     var loadFile = function(event) {
     var image = document.getElementById('output');
     image.src = URL.createObjectURL(event.target.files[0]);
      };

 </script>
 <script>
 $(document).ready(function() {
          $('input[type="file"]').change(function(e) {
              var geekss = e.target.files[0].name;
              $("h5").text(geekss + ' is the selected file.');

          });
      });
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

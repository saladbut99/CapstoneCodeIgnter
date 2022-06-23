<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
  $display='block';

    $question_no=0;
    $choice_id=0;
    $count=1;
    $display='block';
    $display2='none';
    $total=0;
    $range=0;
    $total_score=0;
    $message='';
    $message1='-';
    $number;

 ?>

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
   <script>
     $( ".dropdown" ).click(function() {
       $( ".menu").toggle();
   });
   </script>



<?php $fname; $lname; $section_name;?>



      <div class="container mt-5" style="margin-bottom:5%;">

        <div class="mt-3">
          <div class="backbutton col-2">
              <a href="#" onclick="history.back()" style="text-decoration: none; color: rgb(68, 68, 68);">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
              </svg> Go Back
              </a>
          </div>
          <br>


          <br>
          <?php if (!$users): ?>
             <h1 style="text-align:center;">No Added Module</h1>

         <?php else: ?>
           <table class="table table-borderless table-hover" id="users-list"  style=" border-bottom: none;">
             <thead style="text-align:left; font-size:3rem">
                <tr>
                   <th>Module Name</th>
                   <th>Unit</th>
                   <th></th>
                </tr>
             </thead>

                <?php if($users): ?>
                <?php foreach($users as $user): ?>
                  <?php if ($user['section_id']==$section->section_id): ?>
                    <?php foreach ($join as $joins): ?>
                      <?php if ($joins['lesson_id']==$user['lesson_id']): ?>
                        <?php if (strcmp(strtoupper($joins['account_status']),strtoupper('active'))==0): ?>
                          <?php
                                 $total=$total+$joins['activity_score'];
                                 $range=$range+$joins['perfect_score'];
                                 $total_score=$total/$range*100;
                                 if ($total_score>0) {
                                   $number = number_format((float)$total_score, 2, '.', '');
                                   $message1= $number.'%';
                                 }else {
                                   $message1='-';
                                 }
                             ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>

                    <tr>
                        <td style="text-align:left"><?php echo $user['lesson_name']; ?></td>
                        <td style="text-align:center"><?php echo $user['unit']; ?></td>
                        <td style="text-align:center"> <?= $message1 ?> </td>
                         <!-- <td style="text-align:center">number_format((float)$total_score, 2, '.', '') ?>%</td> -->
                     </tr>
                  <?php endif; ?>
                  <?php $total_score=0;
                  $total=0;
                   $range=0;?>
                  <?php $message1='-'; ?>
               <?php endforeach; ?>
               <?php endif; ?>
           </table>

          <?php endif; ?>

        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script>
      $(document).ready( function () {
        $('#users-list').DataTable({
           "bPaginate": false,
           "bInfo" : false,
           "searching": false,
           "language": {
             "emptyTable": "No uploaded module for section Rose"
           },
            "responsive": true,
            "order": [[ 1, "asc" ]],
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

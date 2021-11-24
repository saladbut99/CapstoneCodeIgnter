<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>


<body>
 <div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-7">
               <a href="home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
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
      <div class="pt-3" style="cursor:pointer;">
        <p class="menup m-0">Update Password</p>
        </div>
        <div class="" style="cursor:pointer;">
        <p class="menup m-0">Logout</p>
        </div>
   </div>


<center>
    <div class="formcontainer m-5 pb-5" style="max-width:80%; background-color: white; border:none;">
      <div class="container  h-100">
        <div class="row h-100 align-items-center ">
            <div class="col-md text-center" >
                <div class="dashboard_div section addmod"  href="teacher_managelesson.html">
                <br>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-file-plus" viewBox="0 0 16 16">
                  <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                </svg>
                  <br><br>
                  <p>Add Module</p>
                </div>
            </div>

            <div class="col-md text-center">
                <div class="dashboard_div section addact" href="teacher_managelesson.html">
                <br>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
                  <br><br>
                  <p>Add Activity</p>
                </div>
            </div>

            <div class="col-md text-center">
                <div class="dashboard_div section viewmod" href="teacher_managelesson.html">
                <br>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-file-earmark-easel" viewBox="0 0 16 16">
                  <path d="M8.5 6a.5.5 0 1 0-1 0h-2A1.5 1.5 0 0 0 4 7.5v2A1.5 1.5 0 0 0 5.5 11h.473l-.447 1.342a.5.5 0 1 0 .948.316L7.027 11H7.5v1a.5.5 0 0 0 1 0v-1h.473l.553 1.658a.5.5 0 1 0 .948-.316L10.027 11h.473A1.5 1.5 0 0 0 12 9.5v-2A1.5 1.5 0 0 0 10.5 6h-2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-2z"/>
                  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
                  <br><br>
                  <p>View Module</p>
                </div>
            </div>

            <div class="row"></div>

            <div class="col-md text-center">
                <div class="dashboard_div section upmod" href="teacher_managelesson.html">
                    <br>
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-file-check" viewBox="0 0 16 16">
                      <path d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                      <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                    </svg>
                      <br><br>
                      <p>Update Module</p>
                    </div>
            </div>


            <div class="col-md text-center">
                <div class="dashboard_div section remmod" href="teacher_managelesson.html">
                <br>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-file-x" viewBox="0 0 16 16">
                  <path d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/>
                  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                </svg>
                  <br><br>
                  <p>Remove Module</p>
                </div>
            </div>

        </div>
      </div>
    </div>
  </center>

  <script>
    $( ".dropdown" ).click(function() {
      $( ".menu").toggle();
  });

  $(".addmod").click(function(){
    window.location = 'addmodule';
    //
});

  $(".addact").click(function(){
    window.location = 'addmodule';
    //
});

  $(".remmod").click(function(){
    window.location = $(this).attr('href');
    alert("REMOVE MODULE");

});

  $(".viewmod").click(function(){
    window.location = 'view'
    
});

  $(".upmod").click(function(){
    window.location = $(this).attr('href');
    alert("UPDATE MODULE");
});
  </script>

  <style>
    .addmod:hover, .remmod, .viewmod, .upmod ,.addact{
      cursor: pointer;
    }
  </style>
  <?= $this->endSection() ?>

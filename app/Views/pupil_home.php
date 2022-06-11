<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<?php $display='block';
      $display2='none'; ?>

<div class="navbar navbar_pupil mb-0" style="height:76px !important; background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/public/assets/images/banner.png);">
       <nav class="nav row w-100 align-items-center">
           <div class="col-7">
               <a href="home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
           </div>
           <div class="col-4 text-center pt-3">
               <p style="color:white; text-align:right;"><?= session()->get('firstname') ?> <?= session()->get('lastname') ?></p>
           </div>
           <div class="col-1 p-0 text-center">
               <div style="margin-right: 0%;">
                   <a href="#" class="dropdown"><img src="<?=base_url()?>/public/assets/images/student_logo.png" alt="" class="nav_img" height="60" width="60"></a>
                </div>
           </div>`
       </nav>
   </div>
   <div class="menu p-2 text-center">
     <div class="pt-3" style="cursor:pointer;">

       </div>
        <div class="">
        <a href="logout">Logout</a>
        </div>
   </div>

    <audio id="bgmusic" hidden autoplay loop> 
      <source src="<?=base_url()?>/public/assets/AngryBirdsTheme.mp3">
    </audio>
    <audio id="beep-one" hidden preload="auto">
      <source src="<?=base_url()?>/public/assets/clickar.mp3">
    </audio>

<?php if (strcmp(trim($users->account_status),'Inactive')==0): ?>
  <?php $display='none'; ?>
  <?php $display2='block'; ?>
<?php endif; ?>
<center>
  <div class="container" style="display:<?= $display2 ?>">
      <div class="row">
          <div class="col">
              <h1 style="color:red;">Account is disabled please contact your teacher to access your account again</h1>
          </div>
      </div>
  </div>
</center>
<center id="cntr">
  <br>
    <div class="formcontainer pt-2 mt-0 pb-5" style="height:80vh !important; max-width:90%; background-color: rgba(255, 255, 255, 0.0); border:none; height:70vh;display:<?= $display ?>">
      <div class="container  h-100">

      <div class="d-flex justify-content-center h-10 align-items-center pt-3 section_menu_container" style="width: 70vw;">
          <div class="col-md text-center section_menu">
                <div class="dashboard_div section_pupil" id="sec1">
                    <br>
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-book isbigi" viewBox="0 0 16 16">
                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                      </svg>
                    <h6 style="color:green;" class="section_h6"> LEARN LESSON </h6>
                </div>
            </div>

            <div class="col-md text-center section_menu">
                <div class="dashboard_div section_pupil" id="sec2">
                <br>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-clipboard-check isbigi" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                  </svg>
                  <h6 style="color:green;" class="section_h6"> VIEW PERFORMANCE </h6>
                </div>
            </div>

            <div class="col-md text-center section_menu">
                <div class="dashboard_div section_pupil" id="sec3">
                <br>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-person-check isbigi" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                  </svg>
                  <h6 style="color:green;" class="section_h6"> CHANGE PASSWORD </h6>
                </div>
            </div>
        </div>
        <hr style="width: 70vw;">
        <div class="row h-60 align-items-center mt-2 pop-up" style="" id="pop-up1">
          <h1 style="padding:20px; background-color: rgba(100,255,100,0.5)"> LEARN A LESSON </h1>
          <h3><b>LEARN CEBUANO</b> FROM MODULES AND <b>ANSWER</b> ACTIVITIES.</h3>
          <div class="pop-up d-flex">
          <a href="viewmoduletable" class=" btn btn-light btn-outline-primary" style="margin-top: 10%; margin-bottom: 10%;"> Learn Lesson</a>
          </div>
        </div>
        <div class="row h-60 align-items-center mt-2 pop-up" style="" id="pop-up2">
        <h1 style="padding:20px; background-color: rgba(100,255,100,0.5)"> VIEW YOUR SCORE </h1>
        <h3><b>VIEW</b> ACTIVITY SCORES AND <b>VIEW</b> OVERALL PERFORMANCE.</h3>
          <div class="pop-up d-flex">
          <a href="viewmoduleactivity" class=" btn btn-light btn-outline-primary" style="margin-top: 10%; margin-bottom: 10%; margin-right:5%;"> View Activity Performance</a>
          <a href="viewoverallperformance" class=" btn btn-light btn-outline-primary" style="margin-top: 10%; margin-bottom: 10%;"> View Overall Performance</a>
          </div>
        </div>
        <div class="row h-60 align-items-center mt-2 pop-up" style="" id="pop-up3">
        <h1 style="padding:20px; background-color: rgba(100,255,100,0.5)"> CHANGE YOUR PASSWORD </h1>
        <h3>WANT TO <b>CHANGE</b> PASSWORD?</h3>
        
          <div class="pop-up d-flex align-items-center" style="flex-direction:column">
          <h5>ALWAYS <b>REMEMBER</b> YOUR PASSWORD</h5>
          <a href="update" class=" btn btn-light btn-outline-primary" style="margin-top: 6.6%; margin-bottom: 10%;"> Change Password</a>
          </div>
        </div>

      </div>
    </div>
</center>


<style>
  .menu {
    display: block ;
  }
</style>
<script>
  setTimeout(function() {
    $('.menu').fadeOut('fast');
}, 2000); // <-- time in milliseconds

  $( ".dropdown" ).click(function() {
    $( ".menu").toggle();
});

  $( "#sec1" ).click(function() {
    $( "#pop-up1").show();
    $('#sec1').css({
        'cssText': 'background-color: rgba(255,255,255,0.8) !important;'
    });
    $('#sec2').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $('#sec3').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $( "#pop-up2").hide();
    $( "#pop-up3").hide();
    $('html, body').animate({
        scrollTop: $('#cntr').offset().top
    }, 0);
 });
 $( "#sec2" ).click(function() {
    $( "#pop-up2").show();
    $('#sec1').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $('#sec2').css({
        'cssText': 'background-color: rgba(255,255,255,0.8) !important'
    });
    $('#sec3').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $( "#pop-up1").hide();
    $( "#pop-up3").hide();
    $('html, body').animate({
        scrollTop: $('#cntr').offset().top
    }, 0);
 });
 $( "#sec3" ).click(function() {
    $( "#pop-up3").show();
    $('#sec1').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $('#sec2').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $('#sec3').css({
        'cssText': 'background-color: rgba(255,255,255,0.8) !important'
    });
    $( "#pop-up1").hide();
    $( "#pop-up2").hide();
    $('html, body').animate({
        scrollTop: $('#cntr').offset().top
    }, 0);
 });

var beepOne = $("#beep-one")[0];
$(".section_menu").click(function () {
beepOne.currentTime=0;
beepOne.play();
});


var bgmusic = $("#bgmusic")[0];
$(document).ready(function() {
  bgmusic.play();
  bgmusic.volume = 0.2;
});

$("#cntr").mousemove(function(e){
    var amountMovedX = (e.pageX * -1 / 20);
    var amountMovedY = (e.pageY * -1 / 50);
    $(this).css('background-position', amountMovedX + 'px ' + amountMovedY + 'px');
});

$(document).ready(function () {
    $('html, body').animate({
        scrollTop: $('#cntr').offset().top
    }, 2000);
});


$(window).on('scroll', function() {
    console.log( $(this).scrollTop() );
});

$(window).on('resize', function() {
  var win = $(this);
  if (win.width() > 480) {

    $('.section_menu_container').addClass('row');
    $('.section_menu').addClass('col');

  } else {
    $('.section_menu_container').removeClass('row');
    $('.section_menu').removeClass('col-md');
  }
});


</script>


<style>

.dashboard_div{
  border:3px solid #00acee;
  margin-bottom: 2%;
  border-radius: 5%;
  background-color: rgba(255,255,255,0.8);
  height: 100%;
  max-height: 90%;
}

#cntr {
  background-image: url("http://localhost/CapstoneCodeIgnter/Pulong/public/assets/images/pupil_bg.jpg") !important;
  background-size: 150%;
  background-repeat: no-repeat;
  background-position: center;
  height: 100vh !important;
}

.section_h6 {
  font-size:15px;
}


/* mobile */
@media only screen and (max-width: 480px) {
  body {
  background-image: url("http://localhost/CapstoneCodeIgnter/Pulong/public/assets/images/pupil_bg.jpg") !important;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  }

  #cntr {
    background: none !important;
    height: 100vh !important;
  }

  .section_pupil {
    height: 70%;
    width: 40%;
  }
  svg {
    height: 24px;
    width: 24px;
  }
  .section_h6 {
    font-size: 10px;
  }
 
  .formcontainer {
    max-width: 90% !important;
  }

  .section_menu_container {
    display: flex;
    width: 100% !important;
  }

  .section_menu {
    width: 100% !important;
  }

  .section_pupil {
    width: 80% !important;
  }

  #pop-up3 {
    height: 80% !important;
  }
  #pop-up3 > .pop-up {
    height: 40% !important;
  }
}

@media only screen and (min-width: 481px) and (max-width: 1024px) {
  body {
  background-image: url("http://localhost/CapstoneCodeIgnter/Pulong/public/assets/images/pupil_bg.jpg") !important;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  }

  #cntr {
    background: none !important;
    height: 100vh !important;
  }
  .section_pupil {
    height: 20vh;
    width: 20vw;
  }
  svg {
    height: 24px;
    width: 24px;
  }
  .section_h6 {
    font-size: 10px;
  }
 
  .formcontainer {
    max-width: 90% !important;
  }

  .section_menu_container {
    display: flex;
    width: 100% !important;
  }

  .section_menu {
    width: 100% !important;
  }

  .section_pupil {
    width: 80% !important;
  }

  #pop-up3 {
    height: 80% !important;
  }
  #pop-up3 > .pop-up {
    height: 50% !important;
  }
}

</style>

<?= $this->endSection() ?>

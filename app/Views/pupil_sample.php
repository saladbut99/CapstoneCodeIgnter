<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

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

  <?php foreach ($sample as $samples): ?>
      <h1><?= $samples['answer'] ?></h1>
  <?php endforeach; ?>



<script>
  $( ".dropdown" ).click(function() {
    $( ".menu").toggle();
});

  $( "#sec1" ).click(function() {
    $( "#pop-up1").show();
    $('#sec1').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.8) !important'
    });
    $('#sec2').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $('#sec3').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $( "#pop-up2").hide();
    $( "#pop-up3").hide();
 });
 $( "#sec2" ).click(function() {
    $( "#pop-up2").show();
    $('#sec1').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $('#sec2').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.8) !important'
    });
    $('#sec3').css({
        'cssText': 'background-color: rgba(255, 255, 255, 0.4) !important'
    });
    $( "#pop-up1").hide();
    $( "#pop-up3").hide();
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
        'cssText': 'background-color: rgba(255, 255, 255, 0.8) !important'
    });
    $( "#pop-up1").hide();
    $( "#pop-up2").hide();
 });

var beepOne = $("#beep-one")[0];
$(".section_menu").click(function () {
beepOne.currentTime=0;
beepOne.play();
});

$("#cntr").mousemove(function(e){
    var amountMovedX = (e.pageX * -1 / 20);
    var amountMovedY = (e.pageY * -10 / 50);
    $(this).css('background-position', amountMovedX + 'px ' + amountMovedY + 'px');
});


</script>

<?= $this->endSection() ?>

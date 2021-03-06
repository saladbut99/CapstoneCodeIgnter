<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pulong</title>
    <link rel="stylesheet" href="<?php echo base_url('/public/assets/css/mystyle.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  </head>
<body>
  <audio id="musicindex" hidden autoplay loop>
    <source src="<?=base_url()?>/public/assets/bgmusic.mp3">
  </audio>
  <div class="bg" style="">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-md text-center">

        </div>
        <div class="col-md-1 text-center">

        </div>
        <div class="col-md text-center loginbutton">
            <a href="pupil_login" class="button text-decoration-none" id="loginbtn">Log In</a>
        </div>
      </div>
    </div>
  </div>

  <br><br>

<div class="whitebg reveal">
  <div class="container h-50">
    <div class="row h-100 align-items-center">
      <div class="col-md text-center">
        <h1 style="color :#03256C;"><b>AN INTERACTIVE WEB APPLICATION TUTORIAL</b></h1>
        <br>
        <h2 style="color :#554F4F; font-size:25px;">Learning the Mother Tongue Language is fun with Pulong.</h2>
      </div>
    </div>
  </div>

  <center>
  <hr style="width:70%;", size="4", color=black>
  </center>

  <div class="container h-50">
      <div class="row h-100 align-items-center reveal">
        <div class="col-md text-center">
          <h1 style="color :#03256C;"><b>MONITOR YOUR PERFORMANCE AND LEARNING</b></h1>
          <br>
          <h2 style="color :#554F4F; font-size:25px;">Monitoring of performance and applying learing is made easier with the help of Pulong.</h2>
        </div>
      </div>
  </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>


<script>
  window.addEventListener('scroll', reveal);

function reveal(){
    var reveals = document.querySelectorAll('.reveal');

    for (var i = 0; i < reveals.length; i++) {

       var windowheight = window.innerHeight;
       var revealtop = reveals[i].getBoundingClientRect().top;
       var revealpoint = 75;

       if(revealtop < windowheight - revealpoint){
           reveals[i].classList.add('active');
        }
           else{
           reveals[i].classList.remove('active');
           }
    }
};
</script>

<script>
var x = document.getElementById("musicindex");
x.volume = 0.05;
</script>

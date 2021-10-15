<?= $this->extend('layouts/loginlayout') ?>
<?= $this->section('logintemplate') ?>
    <center>
    <div class="formcontainer m-5 pb-5" style="max-width:50%;">
      <div class="container h-100">
        <br>
        <div class="row h-100 align-items-center">
          <div class="col-3 text-center">
              <a href="homepage" class="login_a">Back</a>
          </div>
          <div class="col-6 text-center">
              <h1><b>Admin Login</b></h1>
          </div>
        </div>
        <br>
        <div class="row h-100 align-items-center">

                <div class="col-md text-center">

                      <a href="pupil_login"><img src="<?=base_url()?>/assets/images/student_logo.png" class="login_image" ></a>
                      <br>
                      <h1 href="pupil_login.php" style="font-size:30px;"><b>Pupil</b></h1>
                </div>
                <div class="col-md text-center">
                      <a href="teacher_login"><img src="<?=base_url()?>/assets/images/teacher.png" class="login_image" alt=""></a>
                      <br>
                      <h1 href="pupil_login.php" style="font-size:30px;"><b>Teacher</b></h1>
                </div>
                <div class="col-md text-center">
                      <a href="admin_login"><img src="<?=base_url()?>/assets/images/admin.png" class="login_image" alt="" style="border: 5px solid #59CF02;"></a>
                      <br>
                      <h1 href="pupil_login.php" style="font-size:30px; color: #59CF02;"><b>Admin</b></h1>
                </div>
          </div>
          <br><br><br>
          <div class="row h-100 align-items-center">
            <div class="col-md text-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                  <div class="form">
                    <span class="error"><?php// echo $mainErr;?></span>
                    <div class="input_field">
                      <input  type="text" name="email" class="input" placeholder="Username">
                    </div>
                    <span class="error"><?php //echo $emailErr;?></span>
                    <div class="input_field">
                      <input  type="password" name="password"class="input" placeholder="Password">
                    </div>
                    <span class="error"><?php// echo $passwordErr;?></span>
                    <center>
                      <div class="input_field"  >
                        <input type="submit" name="Submit" target="_self" class="button">
                      </div>
                    </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </center>
<?= $this->endSection() ?>

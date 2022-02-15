<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

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
                   <a href="#" class="dropdown"><img src="<?=base_url()?>/public/assets/images/admin.png" alt="" class="nav_img" height="60" width="60"></a>
                </div>
           </div>
       </nav>
   </div>
   <div class="menu p-2 text-center">
        <div class="">
        <a href="logout">Logout</a>
        </div>
   </div>
   <script>
     $( ".dropdown" ).click(function() {
       $( ".menu").toggle();
   });
   </script>
<div class="mask d-flex align-items-center h-100 gradient-custom-3 m-5 pb-5">
      <div class="container-lg h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px; border:3px solid #00acee;width:100%;">
              <div class="card-body p-5 row">


                <div class="backbutton col-2">
                    <a href="manage" style="text-decoration: none; color: rgb(68, 68, 68);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    </a>
                </div>

                <h2 class="text-uppercase text-center mb-5 col-10">Update Password</h2>
                <?php if (session()->get('updatesuccess')): ?>
                <div class="alert alert-success" role="alert" style="margin-bottom:5%;">
                    <h4><?= session()->get('updatesuccess') ?></h4>
                </div>
              <?php endif; ?>
              <br>
                <form method="post" action="update">

                  <?php if (isset($validation)): ?>
                      <div class="col-12" style="margin-bottom:5%;">
                        <div class="alert alert-danger" role="aler">
                          <?php if ($validation->hasError('password')): ?>
                                  <p>  <?= $validation->getError('password') ?></p>
                          <?php endif; ?>
                          <?php if ($validation->hasError('password_confirm')): ?>
                                  <p>  <?= $validation->getError('password_confirm') ?></p>
                          <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                  <div class="form-outline mb-4 row align-items-center">
                    <label class="form-label col-4 p-0" for="form3Example1cg">FIRST NAME</label>
                    <input type="text" id="teacher_firstname" name='teacher_firstname' class="form-control form-control-lg col"  readonly value="<?= session()->get('firstname') ?>"/>
                    <center>
                    <div class="text-danger" style="margin-top:3%;">
                      <?php if (isset($validation)): ?>
                            <?php if ($validation->hasError('teacher_firstname')): ?>
                                  <p>  <?= $validation->getError('teacher_firstname') ?></p>
                            <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </center>
                  </div>

                  <div class="form-outline mb-4 row align-items-center">
                    <label class="form-label col-4 p-0" for="form3Example3cg">LAST NAME</label>
                    <input type="text" id="teacher_lastname" name='teacher_lastname' class="form-control form-control-lg col"   readonly value="<?= session()->get('lastname')?>"/>
                    <center>
                    <div class="text-danger" style="margin-top:3%;">
                      <?php if (isset($validation)): ?>
                            <?php if ($validation->hasError('teacher_lastname')): ?>
                                  <p>  <?= $validation->getError('teacher_lastname') ?></p>
                            <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </center>
                  </div>

                  <div class="form-outline mb-4 row align-items-center">
                        <label class="form-label col-4 p-0" for="form3Example3cg">USERNAME</label>
                        <input type="text" id="teacher_username" name='teacher_username' class="form-control form-control-lg col" readonly value="<?= session()->get('username')?>" />
                        <center>
                        <div class="text-danger" style="margin-top:3%;">
                          <?php if (isset($validation)): ?>
                                <?php if ($validation->hasError('teacher_username')): ?>
                                      <p>  <?= $validation->getError('teacher_username') ?></p>
                                <?php endif; ?>
                          <?php endif; ?>
                        </div>
                      </center>
                  </div>

                    <div class="form-outline mb-4 row align-items-center">
                      <label class="form-label col-4 p-0" for="form3Example3cg">NEW PASSWORD</label>
                      <input type="password" id="teacher_lastname" name='password' class="form-control form-control-lg col"  />
                      <center>
                    </div>
                    <div class="form-outline mb-4 row align-items-center">
                      <label class="form-label col-4 p-0" for="form3Example3cg">CONFIRM PASSWORD</label>
                      <input type="password" id="teacher_lastname" name='password_confirm' class="form-control form-control-lg col"  />
                      <center
                    </center>
                    </div>

                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-block btn-lg registerbutton">Update</button>
                  </div>

                </form>

                  <script type="text/javascript">

                    function myFunction(){
                      var firstname = document.getElementById("teacher_firstname").value;
                      var split = firstname.split(" ");
                      var joined = split.join('');
                      var lastname = document.getElementById("teacher_lastname").value;
                      var username = lastname+'.'+joined;
                       document.getElementById("teacher_username").value = username;
                    }
                  </script>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?= $this->endSection() ?>

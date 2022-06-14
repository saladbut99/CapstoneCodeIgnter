<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

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

   <?php if (session()->get('updatesuccess')): ?>
   <div class="alert alert-success" role="alert" style="margin-bottom:5%;">
       <h4><?= session()->get('updatesuccess') ?></h4>
   </div>
  <?php endif; ?>

   <div class="container mt-5" style="margin-bottom:5%;">
     <div class="mt-3">
     <div class="row" style="align-items: center; background-image: url(<?=base_url()?>/public/assets/images/pupilbanner.jpg)">
       <div class="backbutton col d-flex align-items-center"> 
                <a href="home" style="text-decoration: none; color: whitesmoke;">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="whitesmoke" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg> Return Home
                </a>   
            </div>
            <!-- BUTTONS FOR TABLE POP UP -->
            <div class="buttonforunit col d-flex align-items-center">
              <h4 id="kwarter"> KWARTER: </h4>
              <button class="btn btn-lg btn-unit" id="btn-unit1" style=""> 1 </button>
              <button class="btn btn-lg btn-unit" id="btn-unit2" style="color: whitesmoke;"> 2 </button>
              <button class="btn btn-lg btn-unit" id="btn-unit3" style="color: whitesmoke;"> 3 </button>
              <button class="btn btn-lg btn-unit" id="btn-unit4" style="color: whitesmoke;"> 4 </button>
            </div>
        </div>
       <div class="container">
         <div class="row">
           <div class="mt-3" style="margin-left:1%;">
               <a href="addmodule" style="text-decoration:none;">
                 <button type="button" class="btn btn-success">
                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                     <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                   </svg> Add Module
               </button>
               </a>
         </div>
         </div>
       </div>
       <br>
       <?php if (!$users): ?>
          <h1 style="text-align:center;">No Added Module</h1>
      <?php else: ?>
        
        <table class="table table-borderless table-hover" id="users-list"  style=" border-bottom: none;">
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 1</th>
                <th></th>
             </tr>
          </thead>

             <?php if($users): ?>
             <?php foreach($users as $user): ?>

              <?php if ($user['unit']==1): ?>
                 <tr style="text-align:center;">
                    <td style="text-align:left"><a href="viewmodule/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>
                    <td class="d-grid gap-2 d-md-block">
                        <a href="delete\<?= $user['lesson_id'] ?>" onclick="return doconfirm()" style="text-decoration:none;">
                          <button type="button" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg> Delete
                      </button>
                        </a>

                        <a href="updatemodule\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                          <button type="button" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                            </svg> Update
                        </button>
                        </a>
                        <a href="addactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                          <button type="button" class="btn btn-outline-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg> Add Activity
                        </button>
                        </a>
                        <a href="viewactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                          <button type="button" class="btn btn-outline-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg> View Activity
                        </button>
                        </a>
                  </td>
                  </tr>
               <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <table class="table table-borderless table-hover" id="users-list2" style=" border-bottom: none;" >
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 2</th>
                <th></th>
             </tr>
          </thead>

             <?php if($users): ?>
             <?php foreach($users as $user): ?>


               <?php if ($user['unit']==2): ?>
                 <tr style="text-align:center;">
                   <td style="text-align:left"><a href="viewmodule/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>
                   <td class="d-grid gap-2 d-md-block">
                     <a href="delete\<?= $user['lesson_id'] ?>" onclick="return doconfirm()" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-danger">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                       <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                     </svg> Delete
                   </button>
                     </a>

                     <a href="updatemodule\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-primary">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                           <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                           <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                         </svg> Update
                     </button>
                     </a>
                     <a href="addactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-success">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                           <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                         </svg> Add Activity
                     </button>
                     </a>
                     <a href="viewactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-info">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                           <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                           <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                         </svg> View Activity
                     </button>
                     </a>
                 </td>
                  </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <table class="table table-borderless table-hover" id="users-list3" style=" border-bottom: none;" >
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 3</th>
                <th></th>
             </tr>
          </thead>
             <?php if($users): ?>
             <?php foreach($users as $user): ?>
               <?php if ($user['unit']==3): ?>
                 <tr style="text-align:center;">
                   <td style="text-align:left"><a href="viewmodule/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>
                   <td class="d-grid gap-2 d-md-block">
                     <a href="delete\<?= $user['lesson_id'] ?>" onclick="return doconfirm()" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-danger">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                       <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                     </svg> Delete
                   </button>
                     </a>

                     <a href="updatemodule\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-primary">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                           <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                           <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                         </svg> Update
                     </button>
                     </a>
                     <a href="addactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-success">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                           <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                         </svg> Add Activity
                     </button>
                     </a>
                     <a href="viewactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-info">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg> View Activity
                     </button>
                     </a>
                 </td>
                  </tr>
              <?php endif; ?>

            <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <table class="table table-borderless table-hover" id="users-list4" style=" border-bottom: none;" >
          <thead style="text-align:left; font-size:3rem">
             <tr>
                <th style="width:50%;">Unit 4</th>
                <th></th>
             </tr>
          </thead>
             <?php if($users): ?>
             <?php foreach($users as $user): ?>
               <?php if ($user['unit']==4): ?>
                 <tr style="text-align:center">
                   <td style="text-align:left"><a href="viewmodule/<?= $user['lesson_id'] ?>" style="text-decoration:none; font-size:20px;"><?php echo $user['lesson_name']; ?></a>  </td>
                   <td class="d-grid gap-2 d-md-block">
                     <a href="delete\<?= $user['lesson_id'] ?>" onclick="return doconfirm()" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-danger">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                       <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                     </svg> Delete
                   </button>
                     </a>

                     <a href="updatemodule\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-primary">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                           <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                           <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                         </svg> Update
                     </button>
                     </a>
                     <a href="addactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-success">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                           <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                         </svg> Add Activity
                     </button>
                     </a>
                     <a href="viewactivity\<?= $user['lesson_id'] ?>" style="text-decoration:none;">
                       <button type="button" class="btn btn-outline-info">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg> View Activity
                     </button>
                     </a>
                 </td>
                  </tr>
              <?php endif; ?>

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
              "emptyTable": "No uploaded module for Unit 1"
            },
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
  $( ".dropdown" ).click(function() {
    $( ".menu").toggle();
});
</script>
<script>
  function doconfirm()
  {
      job=confirm("Are you sure to delete permanently?");
      if(job!=true)
      {
          return false;
      }
  }
  </script>

  <style>

  </style>


<script>
  $( "#btn-unit1" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: whitesmoke !important; color: black;'});
    $( "#btn-unit2" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit3" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit4" ).css({'cssText':'color: whitesmoke;'});
    $( "#users-list").show();
    $( "#users-list2").hide();
    $( "#users-list3").hide();
    $( "#users-list4").hide();
    $('html, body').animate({
        scrollTop: $('#conviewtable').offset().top
    }, 0);
});
$( "#btn-unit2" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: rgba(255,255,255,0) !important; color: whitesmoke;'});
    $( "#btn-unit2" ).css({'cssText':'color: black;'});
    $( "#btn-unit3" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit4" ).css({'cssText':'color: whitesmoke;'});
    $( "#users-list").hide();
    $( "#users-list2").show();
    $( "#users-list3").hide();
    $( "#users-list4").hide();
    $('html, body').animate({
        scrollTop: $('#conviewtable').offset().top
    }, 0);
});
$( "#btn-unit3" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: rgba(255,255,255,0) !important; color: whitesmoke;'});
    $( "#btn-unit2" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit3" ).css({'cssText':'color: black;'});
    $( "#btn-unit4" ).css({'cssText':'color: whitesmoke;'});
    $( "#users-list").hide();
    $( "#users-list2").hide();
    $( "#users-list3").show();
    $( "#users-list4").hide();
    $('html, body').animate({
        scrollTop: $('#conviewtable').offset().top
    }, 0);
});
$( "#btn-unit4" ).click(function() {
    $( "#btn-unit1" ).css({'cssText': 'background-color: rgba(255,255,255,0) !important; color: whitesmoke;'});
    $( "#btn-unit2" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit3" ).css({'cssText':'color: whitesmoke;'});
    $( "#btn-unit4" ).css({'cssText':'color: black;'});
    $( "#users-list").hide();
    $( "#users-list2").hide();
    $( "#users-list3").hide();
    $( "#users-list4").show();
    $('html, body').animate({
        scrollTop: $('#conviewtable').offset().top
    }, 0);
});g
</script>
<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="mask d-flex align-items-center h-100 gradient-custom-3 mb-5">
      <div class="container h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px; border:3px solid #00acee;width:100%;">
              <div class="card-body p-5 row">


                <div class="backbutton col-2">
                    <a href="home" style="text-decoration: none; color: rgb(68, 68, 68);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    </a>
                </div>

                <h2 class="text-uppercase text-center mb-5 col-10">Register Teacher Account</h2>

                <form>

                  <div class="form-outline mb-4 row align-items-center">
                    <label class="form-label col-4 p-0" for="form3Example1cg">FIRST NAME</label>
                    <input type="text" id="firstname" class="form-control form-control-lg col" />

                  </div>

                  <div class="form-outline mb-4 row align-items-center">
                    <label class="form-label col-4 p-0" for="form3Example3cg">LAST NAME</label>
                    <input type="text" id="lastname" class="form-control form-control-lg col" />

                  </div>

                  <div class="form-outline mb-4 row align-items-center">
                    <label class="form-label col-4 p-0" for="form3Example4cg">USERNAME</label>
                    <input type="text" id="username" class="form-control form-control-lg col" />

                  </div>

                  <select class="form-select form-select-md mb-0">
                    <option selected>SECTION</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>

                  <div class="form-check d-flex justify-content-center mb-5">
                  </div>

                  <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-success btn-block btn-lg registerbutton">Register</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?= $this->endSection() ?>

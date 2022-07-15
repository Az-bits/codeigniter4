<div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <?= view('user/control/_session')?>
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fwlight fs-5">Login</h5>
            <form action="<?= route_to("user_login_post")?>" method="Post">
              <div class="form-floating mb-3">
                <input name="email" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
              </div>
              <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Login</button>
              </div>
              <hr class="my-4">
              
            </form>
          </div>
        </div>
      </div>
    </div>
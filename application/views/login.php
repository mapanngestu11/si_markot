<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php';?>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Si</b> Markot</a>
      </div>
      <div class="card-body">
       <?php if ($this->session->flashdata('msg')): ?>
        <p class="text-danger">
          <?= $this->session->flashdata('msg'); ?>
        </p>
        <?php else: ?>
          <p class="login-box-msg">Silahkan login untuk mengelola Surat.</p>
        <?php endif; ?>
        <form action="<?= site_url('login/auth') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required
            oninvalid="this.setCustomValidity('Harap isi bagian ini')"
            oninput="this.setCustomValidity('')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required
            oninvalid="this.setCustomValidity('Harap isi bagian ini')"
            oninput="this.setCustomValidity('')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <?php include 'layouts/js.php';?>
</body>
</html>

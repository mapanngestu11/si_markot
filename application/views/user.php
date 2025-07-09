<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php';?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include 'layouts/navbar.php';?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include 'layouts/aside.php';?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data User Pegawai</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data User Pegawai</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-divisi">
                    <i class="fas fa-plus"></i> Tambah User
                  </button>
                  <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#reset">
                   <i class="fas fa-key"></i> Reset Password
                 </button>

                 <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Pegawai</th>
                      <th>Jabatan</th>
                      <th>Hak Akses</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    foreach ($users->result_array() as $row) :

                      $no++;
                      $id_user           = $row['id_user'];
                      $nama           = $row['nama'];
                      $jabatan                = $row['jabatan'];
                      $user_level                = $row['user_level'];
                      ?>
                      <tr>
                        <td style="width: 5%"><?php echo $no;?></td>
                        <td><?php echo $nama;?></td>
                        <td><?php echo $jabatan;?></td>
                        <td>
                          <?php
                          if ($user_level == '1') { ?>
                            <span class="badge badge-primary">Pimpinan</span>
                          <?php }elseif ($user_level =='2') { ?>
                           <span class="badge badge-danger">Admin</span>
                         <?php }else{ ?>
                           <span class="badge badge-success">Admin Divisi</span>
                         <?php }?>

                       </td>
                       <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit<?php echo $id_user;?>" style="color: white;"> Edit </button> 
                        <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?php echo $id_user;?>"> Hapus</button> 
                      </td>
                    </tr>

                  <?php endforeach; ?>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.modal -->



<!-- awal modal -->
<div class="modal fade" id="modal-divisi">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('user/create') ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
           <div class="row mt-2">
            <div class="col-md-12">
              <label>NIP</label>
              <input type="text" name="nip_pegawai" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <label>Nama*</label>
              <input type="text" name="nama" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
            </div>
            <div class="col-md-6">
              <label>Email</label>
              <input type="text" name="email" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <label>Jabatan</label>
              <input type="text" name="jabatan" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
            </div>
            <div class="col-md-6">
              <label>Tanda Tangan</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="ttd" id="exampleInputFile" accept="image/*" required
                oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                oninput="this.setCustomValidity('')">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-4">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
            </div>
            <div class="col-md-4">
              <label>Password</label>
              <input type="password" name="password" class="form-control" minlength="8" required
              oninvalid="this.setCustomValidity('Password minimal 8 Karakter !')"
              oninput="this.setCustomValidity('')">
            </div>
            <div class="col-md-4">
              <label>Hak Akses</label>
              <select class="form-control" class="form-control" name="user_level" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
              <option value=""> Pilih </option>
              <option value="1"> Pimpinan </option>
              <option value="2"> Admin (Operator) </option>
              <option value="3"> Admin Divisi </option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
</div>

<!-- /.modal -->
<?php
$no = 0;
foreach ($users->result_array() as $row) :

  $no++;
  $id_user           = $row['id_user'];
  $nama         = $row['nama'];
  ?>
  <!-- awal modal -->
  <div class="modal fade" id="modal-hapus<?php echo $id_user;?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('user/delete') ?>" method="POST">
            <div class="form-group">
              <p>Apakah anda yakin ingin menghapus, <strong><?php echo $nama;?></strong> ? </p>
              <input type="hidden" name="id_user" value="<?php echo $id_user;?>">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<?php endforeach;?>



<!-- /.modal -->

<!-- awal modal -->
<div class="modal fade" id="reset">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reset Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?php echo base_url('user/reset_password') ?>" method="POST">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
               <label>Pilih Nama</label>
               <select class="form-control" name="nip_pegawai" class="form-control" required="">
                <option value=""> Pilih </option>
                <?php
                $no = 0;
                foreach ($users->result_array() as $row) :

                  $no++;
                  $id_user           = $row['id_user'];
                  $nama         = $row['nama'];
                  $nip_pegawai  = $row['nip_pegawai'];
                  ?>
                  <option value="<?= $nip_pegawai;?>"><?= $nama;?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <label>Password</label>
              <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                    <i class="fas fa-eye" id="icon-eye"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<style type="text/css">
  .photo{
    width: 300px;
    height: 150px;
    border: 2px solid #000;
  }
</style>
<?php
$no = 0;
foreach ($users->result_array() as $row) :

  $no++;
  $id_user           = $row['id_user'];
  $nip = $row['nip_pegawai'];
  $nama = $row['nama'];
  $email = $row['email'];
  $jabatan = $row['jabatan'];
  $username = $row['username'];
  $ttd = $row['ttd'];
  $user_level = $row['user_level'];

  ?>
  <!-- awal modal -->
  <div class="modal fade" id="modal-edit<?php echo $id_user;?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('user/update') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
             <div class="row mt-2">
              <div class="col-md-12">
                <label>NIP</label>
                <input type="text" name="nip_pegawai" class="form-control" value="<?= $nip;?>">
                <input type="hidden" name="nip_lama" value="<?= $nip ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user;?>">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <label>Nama*</label>
                <input type="text" name="nama" class="form-control" required="" value="<?php echo $nama;?>">
              </div>
              <div class="col-md-6">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email;?>">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-5">
                <label>Gambar Tanda Tangan</label>
                <img src="<?php echo base_url()."assets/upload/"; ?><?php echo $ttd;?>" class="photo">
              </div>
              <div class="col-md-7">
                <div class="row">
                 <div class="col-md-6">
                  <label>Jabatan</label>
                  <input type="text" name="jabatan" class="form-control" value="<?php echo $jabatan;?>">
                </div>
                <div class="col-md-6">
                  <label>Tanda Tangan</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="ttd" id="exampleInputFile" accept="image/*">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row mt-2">
            <div class="col-md-4">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required="" value="<?php echo $username;?>">
            </div>
            <div class="col-md-4">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')" minlength="8">
            </div>
            <div class="col-md-4">
              <label>Hak Akses</label>
              <select class="form-control" class="form-control" name="user_level" required="">
                <option value="<?php echo $user_level;?>"> 
                  <?php 
                  if ($user_level == '1') {
                   $hak_akses = 'Pimpinan';
                 }elseif($user_level =='2'){
                  $hak_akses = 'Admin (Operator)';
                }else{
                  $hak_akses = 'Admin Divisi';
                }
                ?>

                <?php echo $hak_akses;?>
              </option>
              <option value="1"> Pimpinan </option>
              <option value="2"> Admin (Operator) </option>
              <option value="3"> Admin Divisi </option>
            </select>
          </div>

        </div>
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</form>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<?php endforeach;?>





<?php include 'layouts/footer.php';?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'layouts/js.php';?>
<script>
  function togglePassword() {
    const passwordInput = document.getElementById("password");
    const iconEye = document.getElementById("icon-eye");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      iconEye.classList.remove("fa-eye");
      iconEye.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      iconEye.classList.remove("fa-eye-slash");
      iconEye.classList.add("fa-eye");
    }
  }
</script>

</body>
</html>

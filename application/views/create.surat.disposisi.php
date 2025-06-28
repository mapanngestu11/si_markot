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
              <h1>Buat Surat Disposisi</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Surat Disposisi</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  Buat Surat Disposisi
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Tanggal Surat</label>
                      <input type="date" name="tgl_agenda" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col-md-12">
                      <label>Surat Masuk</label>
                      <select class="form-control" name="id_surat_masuk">
                        <option value=""> Pilih </option>
                        <?php foreach ($masuk->result_array() as $ms ) : 
                          $id_surat_masuk = $ms['id_surat_masuk'];
                          $no_surat       = $ms['no_surat'];

                          ?>
                          <option value="<?php echo $id_surat_masuk;?>"><?php echo $no_surat;?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="row mt-5">
                   <div class="col-md-12">
                    <label>Informasik</label>
                    <div class="card card-outline card-info">
                      <div class="card-header">
                        <h3 class="card-title">
                          Tuliskan informasi
                        </h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <textarea id="summernote"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-8">
                    <label>Ditujukan Oleh :</label>
                    <select class="select2" name="nip_pegawai[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                      <?php foreach ($pegawai->result_array() as $pg): ?>
                        <option value="<?php echo $pg['nip']; ?>">
                          <?php echo $pg['nama']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-primary">Buat Surat</button>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'layouts/footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'layouts/js.php';?>

</body>
</html>

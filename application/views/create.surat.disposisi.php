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
                <form action="<?php echo base_url('surat/proses_add_disposisi') ?>" method="POST">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Tanggal Surat</label>
                        <input type="date" name="tgl_agenda" class="form-control" value="<?= date('Y-m-d') ?>">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <?php foreach ($dp->result_array() as $data_dp) :
                        $no_surat_masuk = $data_dp['no_surat'];
                        $id_surat_masuk = $data_dp['id_surat_masuk'];
                        $perihal        = $data_dp['perihal'];
                        ?>
                        <div class="col-md-6">
                          <label>Nomor Surat</label>
                          <input type="text" class="form-control" readonly="" value="<?php echo $no_surat_masuk;?>">
                          <input type="hidden" name="id_surat_masuk" class="form-control" value="<?php echo $id_surat_masuk;?>">
                        </div>
                        <div class="col-md-6">
                          <label>Perihal</label>
                          <input type="text" class="form-control" readonly="" value="<?php echo $perihal;?>">
                        </div>
                      <?php endforeach ;?>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-12">
                        <label>Informasi</label>
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 class="card-title">
                              Tuliskan informasi
                            </h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <textarea id="summernote" name="informasi"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-6">
                        <label>Di sahkan Oleh:</label>
                        <?php
                        $nama_login =  $this->session->userdata('nama');
                        $nip =  $this->session->userdata('nip_pegawai');
                        ?>
                        <input type="text" class="form-control" readonly="" value="<?php echo $nama_login;?>">
                        <input type="hidden" name="nip_pegawai" value="<?php echo $nip;?>">
                      </div>
                      <div class="col-md-6">
                        <label>Ditujukan Oleh :</label>
                        <select class="select2" name="diteruskan[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                          <?php foreach ($pegawai->result_array() as $pg): ?>
                            <option value="<?php echo $pg['nip_pegawai']; ?>">
                              <?php echo $pg['nama']; ?> |  <?php echo $pg['nama_divisi']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo base_url('surat/disposisi') ?>" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-primary">Buat Surat</button>
                </div>
              </form>
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

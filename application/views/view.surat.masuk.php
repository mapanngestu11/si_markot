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
              <h1>Lihat Surat Masuk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Surat Masuk</li>
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
                  Lihat Data Surat Masuk
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <form action="#" method="POST" enctype="multipart/form-data">
                    <?php foreach ($data_ms->result_array() as $ms): ?>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Sifat Surat</label>
                          <input type="text" class="form-control" value="<?php echo $ms['sifat_surat'];?>" readonly>
                        </div>
                        <div class="col-md-6">
                          <label>Tanggal Terima</label>
                          <?php

                          $tgl_terima = $ms['tgl_terima'];
                          list($th, $bln, $tgl_hari) = explode('-', $tgl_terima);
                          $bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                          ?>
                          
                          <input type="text" class="form-control" value="<?php echo $tgl_hari . ' ' . $bulan[(int)$bln] . ' ' . $th;?>" readonly>

                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <label>Nomor Agenda</label>
                          <input type="text" name="no_agenda" class="form-control" value="<?php echo $ms['no_agenda'];?>" readonly>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <label>Perihal</label>
                          <input type="text" name="perihal" class="form-control" required="" value="<?php echo $ms['perihal'];?>" readonly>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <label>Nomor Surat.</label>
                          <input type="text" name="no_surat" class="form-control" value="<?php echo $ms['no_surat'];?>" readonly>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <label>Tanggal Surat</label>
                          <?php
                          $tgl_surat = $ms['tgl_surat_masuk'];
                          list($th, $bln, $tgl_hari) = explode('-', $tgl_surat);
                          $bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                          ?>
                          <input type="text" name="tgl_surat_masuk" class="form-control" required="" value="<?php echo $tgl_hari . ' ' . $bulan[(int)$bln] . ' ' . $th;?>" readonly>
                        </div>
                        <div class="col-md-6">
                          <label>Asal Surat</label>
                          <input type="text" name="asal_surat" class="form-control" required="" placeholder="Asal Surat" value="<?php echo $ms['asal_surat'];?>" readonly>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <label>Download File Surat</label><br>
                          <embed type="application/pdf" src="<?php echo base_url()."assets/upload/"; ?><?= $ms['file_surat_masuk'];?>" width="100%" height="400"></embed>
                        </div>
                      </div>

                    <?php endforeach;?>
                  </div>
                  <hr>
                  <a href="<?= site_url('surat/masuk') ?>" class="btn btn-primary">Kembali</a>
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

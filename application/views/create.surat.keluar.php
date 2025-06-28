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
              <h1>Buat Surat Keluar</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Surat Keluar</li>
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
                  Buat Surat Keluar
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Tanggal Surat keluar</label>
                      <input type="date" name="tgl_surat_keluar" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label>Kode Surat</label>
                      <select class="form-control" name="id_kode">
                        <option value=""> Pilih </option>
                        <?php foreach ($kode_surat->result_array() as $ks ):
                          $kode_surat = $ks['no_surat'];
                          ?> 
                          <option value="<?php echo $kode_surat;?>"><?php echo $kode_surat;?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col-md-6">
                      <label>Bulan</label>
                      <select class="form-control" name="bulan">
                        <option value=""> Pilih </option>
                        <option value=""> Pilih </option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Tahun</label>
                      <select class="form-control" name="tahun">
                        <option value=""> Pilih </option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col-md-12">
                      <label>Lampiran</label>
                      <input type="file" name="lampiran" class="form-control">
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col-md-12">
                      <label>Perihal</label>
                      <input type="text" name="perihal" class="form-control">
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col-md-12">
                      <label>Isi Surat</label>
                      <div class="card card-outline card-info">
                        <div class="card-header">
                          <h3 class="card-title">
                            Tuliskan informasi
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <textarea name="isi_surat" id="summernote"></textarea>
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

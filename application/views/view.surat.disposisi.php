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
              <h1>Lihat Surat Disposisi</h1>
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
                  Lihat Surat Disposisi
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?php echo base_url('surat/proses_update_surat_disposisi') ?>" method="POST">
                  <div class="form-group">
                   <div class="row">
                    <?php 
                    foreach ($dpid->result_array() as $data_disposisi) : ?>

                      <div class="col-md-12">
                        <label>Tanggal Surat</label>
                        <input type="date" name="tgl_agenda" class="form-control" value="<?php echo $data_disposisi['tgl_agenda'];?>" readonly>
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
                           <div class="form-control" style="background-color: #f8f9fa;">
                            <?= $data_disposisi['informasi']; ?>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-12">
                      <label>File Lampiran</label><br>
                      <embed type="application/pdf" src="<?php echo base_url()."assets/upload/"; ?><?php echo $data_disposisi['file_surat_masuk'];?>" width="100%" height="400"></embed>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-6">
                      <label>Disahkan Oleh :</label>
                      <input type="text" name="" class="form-control" value="<?php echo $data_disposisi['nama'];?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Status Surat</label>

                      <?php

                      $hak_akses =  $this->session->userdata('user_level');
                      if ($hak_akses == '1') { ?>
                        <select class="form-control" name="status" required="">
                          <option value=""> Pilih </option>
                          <option value="Pending">Pending</option>
                          <option value="Approve">Approve</option>
                        </select>
                      <?php }else{ ?>
                        <?php 
                        $status = $data_disposisi['status'];
                        if ($status == 'Pending') { ?>
                          <input type="text" name="status" class="form-control bg-warning" value="<?php echo $status;?>" readonly>
                        <?php }else{?>
                          <input type="text" name="status" class="form-control bg-success" value="<?php echo $status;?>" readonly>
                        <?php } ?>
                      <?php }?>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo base_url('surat/disposisi') ?>" class="btn btn-secondary">Kembali</a>
                </div>
              <?php endforeach; ?>
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

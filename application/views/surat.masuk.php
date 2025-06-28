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
              <h1>Data Surat Masuk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Surat Masuk</li>
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
                  <h3 class="card-title">Data Surat Masuk</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <a href="<?= site_url('surat/create_surat_masuk') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Surat Masuk</a>
                  <br>
                  <br>

                  <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Surat</th>
                        <th>perihal</th>
                        <th>Asal Surat</th>
                        <th>Ditujukan Oleh</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      foreach ($masuk->result_array() as $row) :

                        $no++;
                        $id_surat_masuk           = $row['id_surat_masuk'];
                        $no_surat           = $row['no_surat'];
                        $perihal                = $row['perihal'];
                        $asal_surat                = $row['asal_surat'];
                        $nip_pegawai = $row['nip_pegawai'];
                        ?>
                        <tr>
                          <td style="width: 5%"><?php echo $no;?></td>
                          <td><?php echo $no_surat;?></td>
                          <td><?php echo $perihal;?></td>
                          <td><?php echo $asal_surat;?></td>
                          <td><?php echo $nip_pegawai;?></td>
                          <td>
                            <a href="<?= site_url('surat/update_surat_masuk/' . $id_surat_masuk); ?>" class="btn btn-warning" style="color: white"> Edit </a> 
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?php echo $id_surat_masuk;?>"> Hapus</button> 
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


      <!-- /.modal -->

      <style type="text/css">
        .photo{
          width: 300px;
          height: 150px;
          border: 2px solid #000;
        }
      </style>
      <?php
      $no = 0;
      foreach ($masuk->result_array() as $row) :

        $no++;
        $id_surat_masuk           = $row['id_surat_masuk'];

        ?>
        <!-- awal modal -->
        <div class="modal fade" id="modal-edit<?php echo $id_surat_masuk;?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Data Surat Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                  <div class="form-group">

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




    </div>

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

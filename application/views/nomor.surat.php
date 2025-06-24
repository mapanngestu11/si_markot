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
              <h1>Data Penomoran Surat</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Data Penomoran Surat</li>
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
                  <h3 class="card-title">Data Data Penomoran Surat</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-divisi">
                    <i class="fas fa-plus"></i> Tambah Data Nomor Surat
                  </button>

                  <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Surat</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      foreach ($nomor->result_array() as $row) :

                        $no++;
                        $id_kode           = $row['id_kode'];
                        $no_surat           = $row['no_surat'];
                        $judul                = $row['judul'];

                        ?>
                        <tr>
                          <td style="width: 5%"><?php echo $no;?></td>
                          <td><?php echo $no_surat;?></td>
                          <td><?php echo $judul;?></td>
                          <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit<?php echo $id_kode;?>" style="color: white;"> Edit </button> 
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?php echo $id_kode;?>"> Hapus</button> 
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
            <h4 class="modal-title">Tambah Data Penomoran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('nomor/create') ?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">
               <div class="row mt-2">
                <div class="col-md-12">
                  <label>Kode Surat</label>
                  <input type="text" name="kode_surat" class="form-control">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-12">
                  <label>Judul</label>
                  <input type="text" name="judul" class="form-control">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-12">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan"></textarea>
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

  <!-- /.modal -->
  <?php
  $no = 0;
  foreach ($nomor->result_array() as $row) :

    $no++;
    $id_kode           = $row['id_kode'];
    $kode_surat         = $row['kode_surat'];
    $no_surat = $row['no_surat'];

    ?>
    <!-- awal modal -->
    <div class="modal fade" id="modal-hapus<?php echo $id_kode;?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus Data Nomor Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('nomor/delete') ?>" method="POST">
              <div class="form-group">
                <p>Apakah anda yakin ingin menghapus, <strong><?php echo $no_surat;?></strong> ? </p>
                <input type="hidden" name="id_kode" value="<?php echo $id_kode;?>">
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

  <style type="text/css">
    .photo{
      width: 300px;
      height: 150px;
      border: 2px solid #000;
    }
  </style>
  <?php
  $no = 0;
  foreach ($nomor->result_array() as $row) :

    $no++;
    $id_kode           = $row['id_kode'];
    $kode_surat = $row['kode_surat'];
    $keterangan = $row['keterangan'];
    $judul = $row['judul'];
    $tanggal = $row['tanggal'];
    $no_surat = $row['no_surat'];

    ?>
    <!-- awal modal -->
    <div class="modal fade" id="modal-edit<?php echo $id_kode;?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Penomoran Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('nomor/update') ?>" method="POST" enctype="multipart/form-data">
             <div class="form-group">
               <div class="row mt-2">
                <div class="col-md-12">
                  <label>Kode Surat</label>
                  <input type="text" name="kode_surat" class="form-control" value="<?php echo $kode_surat;?>">
                  <input type="hidden" name="id_kode" value="<?php echo $id_kode;?>">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-12">
                  <label>Nomor Surat</label>
                  <input type="text" name="no_surat" class="form-control" value="<?php echo $no_surat;?>">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-12">
                  <label>Judul</label>
                  <input type="text" name="judul" class="form-control" value="<?php echo $judul;?>">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-12">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan"><?php echo $keterangan;?></textarea>
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
</body>
</html>

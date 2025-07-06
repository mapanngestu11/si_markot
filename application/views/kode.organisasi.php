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
              <h1>Data Organisasi</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Unit Organisasi</li>
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
                  <h3 class="card-title">Data Unit Organisasi</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-divisi">
                    <i class="fas fa-plus"></i> Tambah Divisi
                  </button>

                  <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Kode Unor</th>
                        <th>Divisi</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      foreach ($kode->result_array() as $row) :

                        $no++;
                        $id_divisi           = $row['id_divisi'];
                        $kode_unor           = $row['kode_unor'];
                        $nama_divisi                = $row['nama_divisi'];
                        ?>
                        <tr>
                          <td style="width: 5%"><?php echo $no;?></td>
                          <td><?php echo $kode_unor;?></td>
                          <td><?php echo $nama_divisi;?></td>
                          <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit<?php echo $id_divisi;?>" style="color: white;"> Edit </button> 
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?php echo $id_divisi;?>"> Hapus</button> 
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
            <h4 class="modal-title">Tambah Data Divisi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('kode/create') ?>" method="POST">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Kode Divisi</label>
                    <input type="text" name="kode_unor" class="form-control" required
                    oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                    oninput="this.setCustomValidity('')">
                  </div>
                  <div class="col-md-6">
                    <label>Nama Divisi</label>
                    <input type="text" name="nama_divisi" class="form-control" required
                    oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                    oninput="this.setCustomValidity('')">
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-12">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" placeholder="(Opsional)"></textarea>
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
    foreach ($kode->result_array() as $row) :

      $no++;
      $id_divisi           = $row['id_divisi'];
      $kode_unor           = $row['kode_unor'];
      $nama_divisi                = $row['nama_divisi'];
      $keterangan                = $row['keterangan'];
      ?>
      <!-- awal modal -->
      <div class="modal fade" id="modal-edit<?php echo $id_divisi;?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Divisi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?php echo base_url('kode/update') ?>" method="POST">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Kode Divisi</label>
                      <input type="text" name="kode_unor" class="form-control" value="<?php echo $kode_unor;?>" readonly>
                      <input type="hidden" name="id_divisi" value="<?php echo $id_divisi;?>">
                    </div>
                    <div class="col-md-6">
                      <label>Nama Divisi</label>
                      <input type="text" name="nama_divisi" class="form-control" value="<?php echo $nama_divisi;?>" required="">
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-12">
                      <label>Keterangan</label>
                      <textarea class="form-control" name="keterangan" placeholder="(Opsional)"><?php echo $keterangan;?></textarea>
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


    <?php
    $no = 0;
    foreach ($kode->result_array() as $row) :

      $no++;
      $id_divisi           = $row['id_divisi'];
      $nama_divisi         = $row['nama_divisi'];
      ?>
      <!-- awal modal -->
      <div class="modal fade" id="modal-hapus<?php echo $id_divisi;?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data Divisi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?php echo base_url('kode/delete') ?>" method="POST">
                <div class="form-group">
                  <p>Apakah anda yakin ingin menghapus, <strong><?php echo $nama_divisi;?></strong> ? </p>
                  <input type="hidden" name="id_divisi" value="<?php echo $id_divisi;?>">
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

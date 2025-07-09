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
              <h1>Data Surat Disposisi</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Surat Disposisi</li>
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
                  <h3 class="card-title">Data Surat Disposisi</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">

                  <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Agenda</th>
                        <th>Informasi</th>
                        <th>Diteruskan Kepada</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      foreach ($disposisi->result_array() as $row) :

                        $no++;
                        $id_disposisi            = $row['id_disposisi'];
                        $id_surat_masuk          = $row['id_surat_masuk'];
                        $no_surat           = $row['no_surat'];
                        $tgl_agenda                = $row['tgl_agenda'];
                        $informasi                = $row['informasi'];
                        $status = $row['status'];
                        $diteruskan = $row['diteruskan'];
                        $nama = $row['nama'];

                        list($th, $bln, $tgl_hari) = explode('-', $tgl_agenda);
                        $bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                        ?>
                        <tr>
                          <td style="width: 5%"><?php echo $no;?></td>
                          <td><?php echo $no_surat;?></td>
                          <td><?php echo $tgl_hari . ' ' . $bulan[(int)$bln] . ' ' . $th;?></td>
                          <td><?php echo $informasi;?></td>
                          <td><?php echo $nama;?></td>
                          <td>
                            <?php if ($status == 'Pending') { ?>
                              <span class="badge badge-warning" style="color: white;">Belum Verifikasi</span>
                            <?php }else{?>
                              <span class="badge badge-success">Sudah</span>
                            <?php } ?>
                          </td>
                          <td>
                            <?php if ($hak_akses == '2' || $hak_akses == '3'): ?>
                              <?php if ($status == 'Approve'): ?>
                                <button class="btn btn-success"><i class="nav-icon fas fa-print"></i> Cetak</button>
                                <a href="<?= site_url('surat/view_surat_disposisi/' . $id_surat_masuk); ?>" class="btn btn-primary">
                                  <i class="nav-icon fas fa-eye"></i> Lihat Surat
                                </a>
                                <?php else : ?>

                                  <a href="<?= site_url('surat/view_surat_disposisi/' . $id_surat_masuk); ?>" class="btn btn-primary">
                                    <i class="nav-icon fas fa-eye"></i> Lihat Surat
                                  </a>

                                <?php endif;?>
                                <?php elseif ($hak_akses == '1'): ?>
                                  <?php if ($status == 'Approve'): ?>
                                    <a href="<?= site_url('surat/view_surat_disposisi/' . $id_surat_masuk); ?>" class="btn btn-primary">
                                      <i class="nav-icon fas fa-eye"></i> Lihat Surat
                                    </a>
                                    <?php else: ?>
                                      <a href="<?= site_url('surat/update_surat_disposisi/' . $id_surat_masuk); ?>" class="btn btn-warning" style="color: white">
                                        <i class="nav-icon fas fa-pen"></i> Edit
                                      </a>
                                      <a href="<?= site_url('surat/view_surat_disposisi/' . $id_surat_masuk); ?>" class="btn btn-danger">
                                        <i class="nav-icon fas fa-trash"></i> Hapus
                                      </a>
                                    <?php endif; ?>

                                  <?php endif; ?>

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
            <?php
            $no = 0;
            foreach ($disposisi->result_array() as $row) :

              $no++;
              $id_disposisi           = $row['id_disposisi'];

              ?>
              <!-- awal modal -->
              <div class="modal fade" id="modal-hapus<?php echo $id_disposisi;?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Data Surat</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url('user/delete') ?>" method="POST">
                        <div class="form-group">
                          <p>Apakah anda yakin ingin menghapus, <strong><?php echo $id_disposisi;?></strong> ? </p>
                          <input type="hidden" name="id_disposisi" value="<?php echo $id_disposisi;?>">
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
            foreach ($disposisi->result_array() as $row) :

              $no++;
              $id_disposisi           = $row['id_disposisi'];

              ?>
              <!-- awal modal -->
              <div class="modal fade" id="modal-edit<?php echo $id_disposisi;?>">
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

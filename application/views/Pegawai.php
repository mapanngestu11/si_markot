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
              <h1>Data Pegawai</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Pegawai</li>
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
                  <h3 class="card-title">Data Pegawai</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-divisi">
                    <i class="fas fa-plus"></i> Tambah Data Pegawai
                  </button>

                  <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      foreach ($pegawai->result_array() as $row) :

                        $no++;
                        $id_pegawai           = $row['id_pegawai'];
                        $nip           = $row['nip'];
                        $nama                = $row['nama'];
                        $jabatan                = $row['jabatan'];
                        ?>
                        <tr>
                          <td style="width: 5%"><?php echo $no;?></td>
                          <td><?php echo $nip;?></td>
                          <td><?php echo $nama;?></td>
                          <td><?php echo $jabatan;?></td>
                          <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit<?php echo $id_pegawai;?>" style="color: white;"> Edit </button> 
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?php echo $id_pegawai;?>"> Hapus</button> 
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

    <!-- modal tambah -->

    <!-- endwal modal -->
    <div class="modal fade" id="modal-divisi">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data Pegawai</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('pegawai/create') ?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">
               <div class="row mt-2">
                <div class="col-md-6">
                  <label>NIP</label>
                  <input type="text" name="nip" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                  oninput="this.setCustomValidity('')">
                </div>
                <div class="col-md-6">
                  <label>NIK</label>
                  <input type="text" name="nik" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                  oninput="this.setCustomValidity('')">
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-4">
                  <label>Nama*</label>
                  <input type="text" name="nama" class="form-control" required
                  oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                  oninput="this.setCustomValidity('')">
                </div>
                <div class="col-md-4">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jk" required
                  oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                  oninput="this.setCustomValidity('')">
                  <option value=""> Pilih </option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="col-md-4">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required
                oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                oninput="this.setCustomValidity('')">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" required
                oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                oninput="this.setCustomValidity('')"></textarea>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" required
                    oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                    oninput="this.setCustomValidity('')">
                  </div>
                  <div class="col-md-6">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" required
                    oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                    oninput="this.setCustomValidity('')">
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-8">
                <label>Pendidikan</label>
                <select class="form-control" name="pendidikan" required
                oninvalid="this.setCustomValidity('Harap isi bagian ini')"
                oninput="this.setCustomValidity('')">
                <option value=""> Pilih </option>
                <option value="SMA/SMK">SMA/SMK</option>
                <option value="DI/DII/DIII">DI/DII/DIII</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
              </select>
            </div>
            <div class="col-md-4">
              <label>No.Hp</label>
              <input type="text" name="no_hp" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-4">
              <label>Jabatan</label>
              <input type="text" name="jabatan" class="form-control" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
            </div>
            <div class="col-md-4">
              <label>status</label>
              <select class="form-control" name="status" required
              oninvalid="this.setCustomValidity('Harap isi bagian ini')"
              oninput="this.setCustomValidity('')">
              <option value=""> Pilih </option>
              <option value="Pegawai Tetap"> Pegawai Tetap </option>
              <option value="Kontrak"> Kontrak </option>
              <option value="Relawan diperbantukan"> Relawan diperbantukan </option>
              <option value="Tenaga Harian Lepas (THL)"> Tenaga Harian Lepas (THL) </option>
            </select>
          </div>
          <div class="col-md-4"> 
            <label>Divisi</label>
            <select class="form-control" name="kode_unor" required
            oninvalid="this.setCustomValidity('Harap isi bagian ini')"
            oninput="this.setCustomValidity('')">
            <option value=""> Pilih </option>
            <option value="admin">admin operator</option>
            <option value="pimpinan">pimpinan</option>
            <?php
            foreach ($divisi->result_array() as $nd) :
              $kode_unor = $nd['kode_unor'];
              $nama_divisi = $nd['nama_divisi'];
              ?>
              <option value="<?php echo $kode_unor;?>"> <?php echo $nama_divisi;?></option>
            <?php endforeach;?>
          </select>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-4">
          <label>No.SK</label>
          <input type="text" name="no_sk" class="form-control" required
          oninvalid="this.setCustomValidity('Harap isi bagian ini')"
          oninput="this.setCustomValidity('')">
        </div>
        <div class="col-md-4">
          <label>TMK</label>
          <input type="date" name="tmk" class="form-control" required
          oninvalid="this.setCustomValidity('Harap isi bagian ini')"
          oninput="this.setCustomValidity('')">
        </div>
        <div class="col-md-4">
          <label>TBK</label>
          <input type="date" name="tbk" class="form-control" required
          oninvalid="this.setCustomValidity('Harap isi bagian ini')"
          oninput="this.setCustomValidity('')">
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
foreach ($pegawai->result_array() as $row) :

  $no++;
  $id_pegawai           = $row['id_pegawai'];
  $nama         = $row['nama'];
  ?>
  <!-- awal modal -->
  <div class="modal fade" id="modal-hapus<?php echo $id_pegawai;?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data pegawai</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('pegawai/delete') ?>" method="POST">
            <div class="form-group">
              <p>Apakah anda yakin ingin menghapus, <strong><?php echo $nama;?></strong> ? </p>
              <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai;?>">
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
foreach ($pegawai->result_array() as $row) :

  $no++;
  $id_pegawai           = $row['id_pegawai'];
  $nip           = $row['nip'];
  $nik           = $row['nik'];
  $nama          = $row['nama'];
  $jk            = $row['jk'];
  $alamat        = $row['alamat'];
  $tempat_lahir  = $row['tempat_lahir'];
  $tgl_lahir     = $row['tgl_lahir'];
  $pendidikan    = $row['pendidikan'];
  $no_hp         = $row['no_hp'];
  $email         = $row['email'];
  $status        = $row['status'];
  $no_sk         = $row['no_sk'];
  $tmk           = $row['tmk'];
  $tbk           = $row['tbk'];
  $jabatan       = $row['jabatan'];
  $kode_unor     = $row['kode_unor'];

  ?>
  <!-- awal modal -->
  <div class="modal fade" id="modal-edit<?php echo $id_pegawai;?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('pegawai/update') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
             <div class="row mt-2">
              <div class="col-md-6">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control" value="<?= set_value('nip', $nip); ?>">
                <input type="hidden" name="nip_lama" value="<?= $nip ?>">
                <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai;?>">
              </div>
              <div class="col-md-6">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="<?php echo $nik;?>">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <label>Nama*</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $nama;?>" required="">
              </div>
              <div class="col-md-4">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jk" required="">
                  <option value="<?php echo $jk;?>"> <?php echo $jk;?> </option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="col-md-4">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email;?>">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat"><?php echo $alamat;?></textarea>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $tempat_lahir;?>">
                  </div>
                  <div class="col-md-6">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $tgl_lahir;?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-8">
                <label>Pendidikan</label>
                <select class="form-control" name="pendidikan">
                  <option value="<?php echo $pendidikan;?>"> <?php echo $pendidikan;?> </option>
                  <option value="SMA/SMK">SMA/SMK</option>
                  <option value="DI/DII/DIII">DI/DII/DIII</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                </select>
              </div>
              <div class="col-md-4">
                <label>No.Hp</label>
                <input type="text" name="no_hp" class="form-control" value="<?php echo $no_hp;?>">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="<?php echo $jabatan;?>">
              </div>
              <div class="col-md-4">
                <label>status</label>
                <select class="form-control" name="status" required="">
                  <option value="<?php echo $status;?>"> <?php echo $status;?> </option>
                  <option value="Pegawai Tetap"> Pegawai Tetap </option>
                  <option value="Kontrak"> Kontrak </option>
                  <option value="Relawan diperbantukan"> Relawan diperbantukan </option>
                  <option value="Tenaga Harian Lepas (THL)"> Tenaga Harian Lepas (THL) </option>
                </select>
              </div>
              <div class="col-md-4"> 
                <label>Divisi</label>
                <?php
                if ($kode_unor == 'admin' || $kode_unor == 'pimpinan') { ?>
                  <input type="text" class="form-control" value="<?php echo $kode_unor;?>" readonly>
                <?php }else{ ?>
                  <select class="form-control" name="kode_unor" required="">
                    <option value="<?php echo $kode_unor;?>"> <?php echo $nama_divisi;?> </option>

                    <option value="admin">admin operator</option>
                    <option value="pimpinan">pimpinan</option>
                    <?php
                    foreach ($divisi->result_array() as $nd) :
                      $kode_unor = $nd['kode_unor'];
                      $nama_divisi = $nd['nama_divisi'];
                      ?>
                      <option value="<?php echo $kode_unor;?>"> <?php echo $nama_divisi;?></option>
                    <?php endforeach;?>
                  </select>
                <?php } ?>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <label>No.SK</label>
                <input type="text" name="no_sk" class="form-control" value="<?php echo $no_sk;?>">
              </div>
              <div class="col-md-4">
                <label>TMK</label>
                <input type="date" name="tmk" class="form-control" value="<?php echo $tmk;?>">
              </div>
              <div class="col-md-4">
                <label>TBK</label>
                <input type="date" name="tbk" class="form-control" value="<?php echo $tbk;?>">
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

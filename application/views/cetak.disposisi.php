<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lembar Disposisi</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 40px;
    }

    .disposisi {
      border: 2px solid black;
      padding: 20px;
    }

    .header {
      text-align: center;
    }

    .header img {
      height: 60px;
      vertical-align: middle;
    }

    .judul {
      font-weight: bold;
      font-size: 20px;
      margin-top: 10px;
      text-decoration: underline;
      margin-bottom: 10px;
    }

    .opsi-sifat td {
      padding-right: 20px;
    }

    .table-info {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    .table-info td {
      padding: 4px 8px;
      vertical-align: top;
    }

    .instruksi {
      margin-top: 20px;
      border-top: 2px solid black;
      display: flex;
    }

    .instruksi div {
      flex: 1;
      padding: 10px;
      min-height: 100px;
      border-right: 2px solid black;
    }

    .instruksi div:last-child {
      border-right: none;
    }

    .ttd {
      margin-top: 30px;
      text-align: right;
      font-style: italic;
    }
    .logo{
      margin-bottom: 20px;
    }
    .bawah-disposisi {
      display: flex;
      margin-top: 20px;
      border-top: 2px solid black;
      border-bottom: 2px solid black;
    }

    .bawah-disposisi .kiri {
      width: 50%;
      padding: 10px;
      border-right: 2px solid black;
    }

    .bawah-disposisi .kanan {
      width: 50%;
      display: flex;
      flex-direction: column;
    }

    .kanan .atas,
    .kanan .bawah {
      padding: 10px;
      min-height: 80px;
      border-bottom: 2px solid black;
    }

    .kanan .bawah {
      text-align: center;
      font-style: italic;
      border-bottom: none;
    }
    .img_ttd{
      width: 30%;
      margin-top: -20px;
    }

  </style>

</head>
<body>

  <div class="disposisi">
    <div class="header">
      <img class="logo" src="<?= base_url('assets/upload/pmi.png'); ?>" alt="PMI Logo">
      <div><strong>PALANG MERAH INDONESIA<br>KOTA TANGERANG</strong></div>
      <div>Jl. Mayjen Sutoyo Nomor 15 Telp. (021) 5524 521 Tangerang 15111</div>
      <div class="judul">LEMBAR DISPOSISI</div>
    </div>
    <?php 
    foreach ($cetak->result_array() as $cd) :

      ?>
      <table class="opsi-sifat">
        <tr>
          <td>
            <input type="checkbox" disabled <?= ($cd['sifat_surat'] == 'Rahasia') ? 'checked' : ''; ?>>
            Rahasia
          </td>
          <td>
            <input type="checkbox" disabled <?= ($cd['sifat_surat'] == 'Penting') ? 'checked' : ''; ?>>
            Penting
          </td>
          <td>
            <input type="checkbox" disabled <?= ($cd['sifat_surat'] == 'Rutin/Biasa') ? 'checked' : ''; ?>>
            Rutin/Biasa
          </td>
          <td>
            <input type="checkbox" disabled <?= ($cd['sifat_surat'] == 'Segera/Darurat') ? 'checked' : ''; ?>>
            Segera/Darurat
          </td>
        </tr>
      </table>

      <table class="table-info">
        <tr>
          <td style="width: 200px;">Tanggal Terima</td>
          <td>: <?= format_tanggal_indo($cd['tgl_terima']); ?>
        </td>
      </tr>
      <tr>
        <td>Agenda Nomor (Agno)</td>
        <td>: <?= $cd['no_agenda'];?></td>
      </tr>
      <tr>
        <td>Agenda Tanggal</td>
        <td>: <?= format_tanggal_indo($cd['tgl_agenda']); ?></td>
      </tr>
      <tr>
        <td>Perihal Dalam Surat</td>
        <td>: <?= $cd['perihal']; ?></td>
      </tr>
      <tr>
        <td>Nomor Surat</td>
        <td>: <?= $cd['no_surat'];?></td>
      </tr>
      <tr>
        <td>Tanggal Surat</td>
        <td>: <?= format_tanggal_indo($cd['tgl_surat_masuk']); ?></td>
      </tr>
      <tr>
        <td>Asal / Sumber Surat</td>
        <td>: <?= $cd['asal_surat'];?></td>
      </tr>
    </table>
    <div class="bawah-disposisi">
      <div class="kiri">
        <strong>INFORMASI / INSTRUKSI</strong><br><br>
        <?= $cd['informasi'] ?>
      </div>
      <div class="kanan">
        <div class="atas">
          <strong>DITERUSKAN KEPADA</strong><br><br>
          • <?= $cd['nama']; ?> | <strong><?= $cd['nama_divisi']; ?></strong>
        </div>
        <div class="bawah">
          <div style="text-align: right;">
            Tangerang, <?= format_tanggal_indo($cd['tgl_agenda']); ?>
          </div>
          <br><br><br>
          <img class="img_ttd"src="<?= base_url('assets/upload/'); ?><?= $cd['ttd_pimpinan'];?>">
          <p>(<?= $cd['pimpinan'] ?>)</p>
        </div>
      </div>
    </div>
  </div>

<?php  endforeach;?>
<script>
  window.onload = function () {
    window.print();
  };
</script>

</body>
</html>

<?php 
$hak_akses =  $this->session->userdata('user_level');

if ($hak_akses == '1') { ?>
 <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   <li class="nav-item menu-open">
    <a href="<?= site_url('homepage') ?>" class="nav-link <?= ($this->uri->segment(1) == 'homepage') ? 'active' : '' ?>">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>
  <li class="nav-header"><hr></li>
  <?php
  $segment1 = $this->uri->segment(1);
  $segment2 = $this->uri->segment(2);
  $segment3 = $this->uri->segment(3);
  $isSurat = ($segment1 == 'surat');
  ?>
  <li class="nav-item <?= $isSurat ? 'menu-open' : '' ?>">
    <a href="#" class="nav-link <?= $isSurat ? 'active' : '' ?>">
      <i class="nav-icon fas fa-envelope"></i>
      <p>
        Surat
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="<?= site_url('surat/masuk') ?>"
         class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'masuk') ? 'active' : '' ?>">
         <i class="far fa-circle nav-icon"></i>
         <p>Surat Masuk</p>
       </a>
     </li>
     <li class="nav-item">
      <a href="<?= site_url('surat/keluar') ?>"
       class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'keluar') ? 'active' : '' ?>">
       <i class="far fa-circle nav-icon"></i>
       <p>Surat Keluar</p>
     </a>
   </li>
   <li class="nav-item">
    <a href="<?= site_url('surat/disposisi') ?>"
     class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'disposisi') ? 'active' : '' ?>">
     <i class="far fa-circle nav-icon"></i>
     <p>Surat Disposisi</p>
   </a>
 </li>
</ul>
</li>
<li class="nav-header"><hr></li>
<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
$isLaporan = ($segment1 == 'laporan');
?>
<li class="nav-item <?= $isLaporan ? 'menu-open' : '' ?>">
  <a href="#" class="nav-link <?= $isLaporan ? 'active' : '' ?>">
    <i class="nav-icon fas fa-folder"></i>
    <p>
      Laporan
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="<?= site_url('laporan/masuk') ?>"
       class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'masuk') ? 'active' : '' ?>">
       <i class="far fa-circle nav-icon"></i>
       <p>Laporan Surat Masuk</p>
     </a>
   </li>
   <li class="nav-item">
    <a href="<?= site_url('laporan/keluar') ?>"
     class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'keluar') ? 'active' : '' ?>">
     <i class="far fa-circle nav-icon"></i>
     <p>Laporan Surat Keluar</p>
   </a>
 </li>
 <li class="nav-item">
  <a href="<?= site_url('laporan/disposisi') ?>"
   class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'disposisi') ? 'active' : '' ?>">
   <i class="far fa-circle nav-icon"></i>
   <p>Laporan Surat Disposisi</p>
 </a>
</li>
</ul>
</li>
<li class="nav-header"><hr></li>
<li class="nav-item">
 <a href="<?= site_url('pegawai') ?>" class="nav-link <?= ($this->uri->segment(1) == 'pegawai') ? 'active' : '' ?>">
  <i class="nav-icon fas fa-users"></i>
  <p>
    Data Pegawai
  </p>
</a>
</li>
<hr>
<li class="nav-item">
  <a href="<?= site_url('login/logout') ?>" class="nav-link">
    <i class="nav-icon fas fa-key"></i>
    <p>
      Logout
    </p>
  </a>
</li>
</ul>
</nav>
<?php }elseif ($hak_akses == '2') { ?>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     <li class="nav-item menu-open">
      <a href="<?= site_url('homepage') ?>" class="nav-link <?= ($this->uri->segment(1) == 'homepage') ? 'active' : '' ?>">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-header"><hr></li>
    <?php
    $segment1 = $this->uri->segment(1);
    $segment2 = $this->uri->segment(2);
    $segment3 = $this->uri->segment(3);
    $isSurat = ($segment1 == 'surat');
    ?>
    <li class="nav-item <?= $isSurat ? 'menu-open' : '' ?>">
      <a href="#" class="nav-link <?= $isSurat ? 'active' : '' ?>">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
          Surat
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= site_url('surat/masuk') ?>"
           class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'masuk') ? 'active' : '' ?>">
           <i class="far fa-circle nav-icon"></i>
           <p>Surat Masuk</p>
         </a>
       </li>
       <li class="nav-item">
        <a href="<?= site_url('surat/keluar') ?>"
         class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'keluar') ? 'active' : '' ?>">
         <i class="far fa-circle nav-icon"></i>
         <p>Surat Keluar</p>
       </a>
     </li>
     <li class="nav-item">
      <a href="<?= site_url('surat/disposisi') ?>"
       class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'disposisi') ? 'active' : '' ?>">
       <i class="far fa-circle nav-icon"></i>
       <p>Surat Disposisi</p>
     </a>
   </li>
 </ul>
</li>
</li>
<li class="nav-header"><hr></li>
<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
$isLaporan = ($segment1 == 'laporan');
?>
<li class="nav-item <?= $isLaporan ? 'menu-open' : '' ?>">
  <a href="#" class="nav-link <?= $isLaporan ? 'active' : '' ?>">
    <i class="nav-icon fas fa-folder"></i>
    <p>
      Laporan
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="<?= site_url('laporan/masuk') ?>"
       class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'masuk') ? 'active' : '' ?>">
       <i class="far fa-circle nav-icon"></i>
       <p>Laporan Surat Masuk</p>
     </a>
   </li>
   <li class="nav-item">
    <a href="<?= site_url('laporan/keluar') ?>"
     class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'keluar') ? 'active' : '' ?>">
     <i class="far fa-circle nav-icon"></i>
     <p>Laporan Surat Keluar</p>
   </a>
 </li>
 <li class="nav-item">
  <a href="<?= site_url('laporan/disposisi') ?>"
   class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'disposisi') ? 'active' : '' ?>">
   <i class="far fa-circle nav-icon"></i>
   <p>Laporan Surat Disposisi</p>
 </a>
</li>
</ul>
</li>

<li class="nav-header"><hr></li>
<li class="nav-item">
  <a href="<?= site_url('nomor') ?>" class="nav-link <?= ($this->uri->segment(1) == 'nomor') ? 'active' : '' ?>">
    <i class="nav-icon far fa-copy"></i>
    <p>
      Kode Surat
    </p>
  </a>
</li>
<li class="nav-item">
 <a href="<?= site_url('kode') ?>" class="nav-link <?= ($this->uri->segment(1) == 'kode') ? 'active' : '' ?>">
  <i class="nav-icon fas fa-users"></i>
  <p>
    Kode Unit Organisasi
  </p>
</a>
</li>
<li class="nav-item">
 <a href="<?= site_url('pegawai') ?>" class="nav-link <?= ($this->uri->segment(1) == 'pegawai') ? 'active' : '' ?>">
  <i class="nav-icon fas fa-users"></i>
  <p>
    Data Pegawai
  </p>
</a>
</li>
<li class="nav-item">
 <a href="<?= site_url('user') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user') ? 'active' : '' ?>">
  <i class="nav-icon fas fa-users"></i>
  <p>
    Data User
  </p>
</a>
</li>
<hr>
<li class="nav-item">
  <a href="<?= site_url('login/logout') ?>" class="nav-link">
    <i class="nav-icon fas fa-key"></i>
    <p>
      Logout
    </p>
  </a>
</li>
</ul>
</nav>
<?php }elseif($hak_akses == '3'){ ?>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     <li class="nav-item menu-open">
      <a href="<?= site_url('homepage') ?>" class="nav-link <?= ($this->uri->segment(1) == 'homepage') ? 'active' : '' ?>">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-header"><hr></li>
    <?php
    $segment1 = $this->uri->segment(1);
    $segment2 = $this->uri->segment(2);
    $segment3 = $this->uri->segment(3);
    $isSurat = ($segment1 == 'surat');
    ?>
    <li class="nav-item <?= $isSurat ? 'menu-open' : '' ?>">
      <a href="#" class="nav-link <?= $isSurat ? 'active' : '' ?>">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
          Surat
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= site_url('surat/masuk') ?>"
           class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'masuk') ? 'active' : '' ?>">
           <i class="far fa-circle nav-icon"></i>
           <p>Surat Masuk</p>
         </a>
       </li>
       <li class="nav-item">
        <a href="<?= site_url('surat/keluar') ?>"
         class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'keluar') ? 'active' : '' ?>">
         <i class="far fa-circle nav-icon"></i>
         <p>Surat Keluar</p>
       </a>
     </li>
     <li class="nav-item">
      <a href="<?= site_url('surat/disposisi') ?>"
       class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'disposisi') ? 'active' : '' ?>">
       <i class="far fa-circle nav-icon"></i>
       <p>Surat Disposisi</p>
     </a>
   </li>
 </ul>
</li>

<li class="nav-item">
  <a href="<?= site_url('login/logout') ?>" class="nav-link">
    <i class="nav-icon fas fa-key"></i>
    <p>
      Logout
    </p>
  </a>
</li>
</ul>
</nav><?php } ?>


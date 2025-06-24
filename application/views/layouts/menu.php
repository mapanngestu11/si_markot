    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item menu-open">
            <a href="<?= site_url('dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Informasi Surat</li>
          <li class="nav-item">
           <a href="<?= site_url('surat/create') ?>" class="nav-link <?= ($this->uri->segment(1) == 'surat/create') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Buat Surat
            </p>
          </a>
        </li>
        <?php
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $isSurat = ($segment1 == 'surat');
        ?>
        <li class="nav-item <?= $isSurat ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isSurat ? 'active' : '' ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Surat
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('surat/masuk') ?>" class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'masuk') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('surat/keluar') ?>" class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'keluar') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('surat/disposisi') ?>" class="nav-link <?= ($segment1 == 'surat' && $segment2 == 'disposisi') ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Disposisi</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">Pengaturan</li>
        <li class="nav-item">
          <a href="<?= site_url('nomor') ?>" class="nav-link <?= ($this->uri->segment(1) == 'nomor') ? 'active' : '' ?>">
            <i class="nav-icon far fa-copy"></i>
            <p>
              Nomor Surat
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
    <a href="pages/kanban.html" class="nav-link">
      <i class="nav-icon fas fa-key"></i>
      <p>
        Logout
      </p>
    </a>
  </li>


</ul>
</nav>
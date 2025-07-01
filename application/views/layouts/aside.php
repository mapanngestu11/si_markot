    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= site_url('homepage') ?>" class="brand-link">
        <img src="<?php echo base_url()."assets/"; ?>dist/img/si_markot.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Si Markot</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url()."assets/"; ?>dist/img/user_logo.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <?php
            $hak_akses =  $this->session->userdata('user_level');

            if ($hak_akses == '1') {
              $user_level = 'Pimpinan';
            }elseif ($hak_akses == '2') {
              $user_level ='Admin';
            }else{
              $user_level ='Admin Divisi';
            }
            ?>
            <a href="#" class="d-block">  <?= $this->session->userdata('nama'); ?> | <strong><?php echo $user_level;?></strong>  </a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- Sidebar Menu -->
        <?php include 'menu.php';?>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
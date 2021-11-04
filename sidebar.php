<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<?php
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	?>
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Nako<sub>Pay</sub></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
	  
      <li class="nav-item <?php if ($curPageName == "home.php") echo "active"; ?>">
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>
	  
	  <!-- List Menu -->
	  <li class="nav-item <?php if ($curPageName == "mutasi.php") echo "active"; ?>">
      <a class="nav-link" href="mutasi.php">
        <i class="fas fa-sync-alt"></i>
        <span>Mutasi</span></a>
    </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php if ($curPageName == "tambah-penduduk.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-paper-plane"></i>
          <span>Transfer</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="transfer-kerekening.php">Antar Rekening</a>
			      <a class="collapse-item" href="transfer-kevakun.php">NakoPay Virtual Account</a>
          </div>
        </div>
      </li>
      <?php
      if ($_SESSION['status'] == "user") {
      ?>
      <li class="nav-item <?php if ($curPageName == "akun_bisnis.php") echo "active"; ?>">
        <a class="nav-link" href="akun_bisnis.php">
          <i class="fas fa-sync-alt"></i>
          <span>Akun Bisnis</span></a>
      </li>
      <?php } ?>
	  <?php
	  if ($_SESSION['status'] == "bisnis") {
	  ?>
	  <li class="nav-item <?php if ($curPageName == "developer.php") echo "active"; ?>">
        <a class="nav-link" href="developer.php">
          <i class="fas fa-code"></i>
          <span>Developer</span></a>
      </li>
	  <?php
	  }
	  ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
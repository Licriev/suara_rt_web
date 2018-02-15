<ul class="sidebar-menu" id="nav-accordion">
              
  <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
  <h5 class="centered"><?php echo $_SESSION['nama_usr'];?></h5>
  	
  <li class="mt">
      <a class="<?php echo (!isset($_GET['pg']) ? 'active' : '');?>" href="index.php">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
      </a>
  </li>

  <?php if($_SESSION['role_usr']==1 || $_SESSION['role_usr']==2){ ?>
    <?php $ref=array('dhs','dgp','dtc','dct','dic');?>
    <li class="sub-menu">
        <a href="javascript:;" class="<?php echo (in_array($_GET['pg'], $ref) ? 'active' : '');?>">
            <i class="fa fa-file-text"></i>
            <span>Manajemen</span>
        </a>
        <ul class="sub">
            <li><a href="?pg=dic">Icon</a></li>
            <li><a href="?pg=dct">Kota</a></li>
            <li><a href="?pg=dhs">Housing </a></li>
            <li><a href="?pg=dgp">Group Housing</a></li>
            <li><a href="?pg=dtc">Kategori Informasi</a></li>
        </ul>
    </li>
  <?php } ?>

  <li class="sub-menu">
      <a class="<?php echo ($_GET['pg']=='dusr' ? 'active' : '');?>" href="?pg=dusr">
          <i class="fa fa-users"></i>
          <span>Users</span>
      </a>
  </li>

  <li class="sub-menu">
      <a class="<?php echo ($_GET['pg']=='ndr' ? 'active' : '');?>" href="?pg=ndr">
          <i class="fa fa-exclamation-triangle"></i>
          <span>Nomor Darurat</span>
      </a>
  </li>


  <li class="sub-menu">
      <a class="<?php echo ($_GET['pg']=='thm' ? 'active' : '');?>" href="?pg=thm">
          <i class="fa fa-calendar"></i>
          <span>Informasi Warga</span>
      </a>
  </li>

  <li class="sub-menu">
      <a class="<?php echo ($_GET['pg']=='pkr' ? 'active' : '');?>" href="?pg=pkr">
          <i class="fa fa-comments-o"></i>
          <span>Pemilihan Ketua RT</span>
      </a>
  </li>

  <li class="sub-menu">
      <a class="<?php echo ($_GET['pg']=='lrt' ? 'active' : '');?>" href="?pg=lrt">
          <i class="fa fa-comments-o"></i>
          <span>Layanan RT</span>
      </a>
  </li>
</ul>
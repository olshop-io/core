<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">OLSHOP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="waweb/index.php" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Whatsapp Web <span class="badge badge-success" style="font-size:50%">NEW</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."autoreply";?>">
                    <i class="fas fa-reply-all"></i>
                    Auto-reply <span class="badge badge-success" style="font-size:50%">NEW</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."nomor";?>">
                    <i class="fas fa-fw fa-phone-alt"></i>
                    <span>Data Nomor</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."operator";?>">
                    <i class="fas fa-fw fa-mobile"></i>
                    <span>Operator</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."domain";?>">
                    <i class="fas fa-fw fa-globe"></i>
                    <span>Domain</span></a>
            </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."link";?>">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Link</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."sendbyall";?>">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Kirim Masal</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."sendbyone";?>">
                    <i class="fas fa-fw fa-comment-alt"></i>
                    <span>Tes Kirim</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."penjualan";?>">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Penjualan</span></a>
            </li>

           <!--  <li class="nav-item">
                <a class="nav-link" href="rest_api.php">
                    <i class="fas fa-fw fa-code"></i>
                    <span>Rest API</span></a>
            </li>
 -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl."pengaturan";?>">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Pengaturan</span></a>
            </li>
        </ul>
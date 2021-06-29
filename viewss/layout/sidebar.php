<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!--<i class="fas fa-laugh-wink"></i>-->
                </div>
                <div class="sidebar-brand-text mx-3">OLSHOP.IO</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php if($_SESSION['menu'] == "dashboard"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php if($_SESSION['menu'] == ""){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="waweb/index.php" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Whatsapp Web <span class="badge badge-success" style="font-size:50%">NEW</span></a>
            </li>

            <?php if($_SESSION['menu'] == "auto_reply"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="auto_reply">
                    <i class="fas fa-reply-all"></i>
                    Auto-reply <span class="badge badge-success" style="font-size:50%">NEW</span></a>
            </li>

            <?php if($_SESSION['menu'] == "nomor"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="nomor">
                    <i class="fas fa-fw fa-phone-alt"></i>
                    <span>Data Nomor</span></a>
            </li>

            <?php if($_SESSION['menu'] == "operator"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="operator">
                    <i class="fas fa-fw fa-mobile"></i>
                    <span>Operator</span></a>
            </li>

            <?php if($_SESSION['menu'] == "domain"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="domain">
                    <i class="fas fa-fw fa-globe"></i>
                    <span>Domain</span></a>
            </li>

              <?php if($_SESSION['menu'] == "link"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="link">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Link</span></a>
            </li>

            <?php if($_SESSION['menu'] == "sendbyall"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="sendbyall">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Kirim Masal</span></a>
            </li>

            <?php if($_SESSION['menu'] == "sendbyone"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="sendbyone">
                    <i class="fas fa-fw fa-comment-alt"></i>
                    <span>Tes Kirim</span></a>
            </li>

           <!--  <?php if($_SESSION['menu'] == ""){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="rest_api.php">
                    <i class="fas fa-fw fa-code"></i>
                    <span>Rest API</span></a>
            </li>
 -->
            <!--<?php if($_SESSION['menu'] == "link_rotator"){ ?>-->
            <!--<li class="nav-item active">-->
            <!--<?php }else{ ?>-->
            <!--    <li class="nav-item">-->
            <!--<?php } ?>-->
            <!--    <a class="nav-link" href="link_rotator">-->
            <!--        <i class="fas fa-fw fa-code"></i>-->
            <!--        <span>Link Rotator</span></a>-->
            <!--</li>-->
            
            <?php if($_SESSION['menu'] == "pengaturan"){ ?>
            <li class="nav-item active">
            <?php }else{ ?>
                <li class="nav-item">
            <?php } ?>
                <a class="nav-link" href="pengaturan">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Pengaturan</span></a>
            </li>
        </ul>
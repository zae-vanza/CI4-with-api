<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="position-relative d-flex flex-column">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4 pt-5">
            <h1><a href="index.html" class="logo">LaCi API</a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-home"></i> Master
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="<?= base_url('user') ?>"><i class="fa fa-user"></i> User</a>
                        </li>
                        <!-- <li>
                            <a href="<?= base_url('city') ?>"><i class="fa fa-building"></i> City</a>
                        </li>
                        <li>
                            <a href="<?= base_url('province') ?>"><i class="fa fa-map"></i> Province</a>
                        </li> -->
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-info-circle"></i> About</a>
                </li>
            </ul>
            <!-- <ul class="list-unstyled logout-section">
                <li>
                    <a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul> -->
        </div>
    </nav>
    <div id="content" class="p-4 p-md-5 pt-5">
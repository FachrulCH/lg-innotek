<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <br/>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <li>
                    <a href="<?= base_url('dashboard'); ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

            <li>
                <a href="<?= base_url('customer/service/'); ?>">
                    <i class="fa fa-comments"></i> <span>Customer Service </span>
                </a>
            </li>
            <?php
            if ($this->session->level != 'CUS') {
                ?>
                <li>
                    <a href="<?= base_url('customer/'); ?>">
                        <i class="fa fa-users"></i> <span>Customer</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('product/'); ?>">
                        <i class="fa fa-tags"></i> <span>Product</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('employee/'); ?>">
                        <i class="fa fa-male"></i> <span>Employees</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('history/incoming'); ?>">
                        <i class="fa fa-user"></i> <span>NG Customer</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-history"></i> <span>History</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url('history/ngdata'); ?>"><i class="fa fa fa-user"></i> Detail NG Data</a></li>
                        <li><a href="<?= base_url('history/ngcust'); ?>"><i class="fa fa-user-md"></i> CA Customer</a></li>
                        <li><a href="<?= base_url('history/ngcar'); ?>"><i class="fa fa-user-md"></i> CAR</a></li>
                        <li><a href="<?= base_url('history/pengiriman'); ?>"><i class="fa fa-user-md"></i> CA Pengiriman</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-mortar-board"></i> <span>Analisa</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url('analisa/sp'); ?>"><i class="fa fa-mortar-board "></i> Surat Perintah Analisa</a></li>
                        <li><a href="<?= base_url('analisa/result'); ?>"><i class="fa fa-mortar-board "></i> Result Analisa</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-clipboard"></i> <span>Report</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-clipboard"></i> Report by Periodic</a></li>
                        <li><a href="#"><i class="fa fa-clipboard"></i> Report by Customer</a></li>
                        <li><a href="#"><i class="fa fa-clipboard"></i> Report by Status</a></li>
                        <li><a href="#"><i class="fa fa-clipboard"></i> Report by Employee</a></li>
                        <li><a href="#"><i class="fa fa-clipboard"></i> Report by Model</a></li>

                    </ul>
                </li>
                <?php
            }
            ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
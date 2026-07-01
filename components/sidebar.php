<?php
// lấy tên file hiện tại để active menu
$current = basename($_SERVER['PHP_SELF']);

// base project
$base = "/Warehouse-App";
?>

<div class="sidebar">

    <div class="logo">
        <img src="<?= $base ?>/assets/img/logo.png" alt="logo">

        <div class="logo-text">
            <h2>TÍN PHÁT</h2>
            <span>Warehouse Management</span>
        </div>
    </div>

    <ul class="menu">

        <!-- Dashboard -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'dashboard.php') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/admin/dashboard.php">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Quản lý hàng hóa -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'products') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/products/index.php">
                <i class="fa-solid fa-box"></i>
                <span>Quản lý hàng hóa</span>
            </a>
        </li>

        <!-- Quản lý nhân sự (Admin) -->
        <?php if($_SESSION['admin']['role'] == 'admin'){ ?>
        <li class="<?= strpos($_SERVER['PHP_SELF'],'employees') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/employees/index.php">
                <i class="fa-solid fa-users"></i>
                <span>Quản lý nhân sự</span>
            </a>
        </li>
        <?php } ?>

        <!-- Nhà cung cấp -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'suppliers') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/suppliers/index.php">
                <i class="fa-solid fa-truck"></i>
                <span>Nhà cung cấp</span>
            </a>
        </li>

        <!-- Khách hàng -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'customers') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/customers/index.php">
                <i class="fa-solid fa-user-group"></i>
                <span>Khách hàng</span>
            </a>
        </li>

        <!-- Nhập kho -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'imports') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/imports/index.php">
                <i class="fa-solid fa-file-import"></i>
                <span>Nhập kho</span>
            </a>
        </li>

        <!-- Xuất kho -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'exports') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/exports/index.php">
                <i class="fa-solid fa-file-export"></i>
                <span>Xuất kho</span>
            </a>
        </li>

        <!-- Bán hàng -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'sales') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/sales/index.php">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Bán hàng</span>
            </a>
        </li>

        <!-- Hợp đồng (Admin) -->
        <?php if($_SESSION['admin']['role'] == 'admin'){ ?>
        <li class="<?= strpos($_SERVER['PHP_SELF'],'contracts') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/contracts/index.php">
                <i class="fa-solid fa-file-contract"></i>
                <span>Quản lý hợp đồng</span>
            </a>
        </li>
        <?php } ?>

        <!-- Báo cáo -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'reports') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/reports/index.php">
                <i class="fa-solid fa-chart-column"></i>
                <span>Báo cáo</span>
            </a>
        </li>

        <!-- Backup / Restore (Admin) -->
        <?php if($_SESSION['admin']['role'] == 'admin'){ ?>
        <li class="<?= strpos($_SERVER['PHP_SELF'],'backup') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/backup/index.php">
                <i class="fa-solid fa-database"></i>
                <span>Backup / Restore</span>
            </a>
        </li>
        <?php } ?>

        <!-- Tài khoản -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'account') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/account/index.php">
                <i class="fa-solid fa-user"></i>
                <span>Tài khoản</span>
            </a>
        </li>

        <!-- Cài đặt -->
        <li class="<?= strpos($_SERVER['PHP_SELF'],'settings') !== false ? 'active' : '' ?>">
            <a href="<?= $base ?>/modules/settings/index.php">
                <i class="fa-solid fa-gear"></i>
                <span>Cài đặt</span>
            </a>
        </li>
        <li>
    <a href="/Warehouse-App/admin/logout.php" onclick="return confirm('Bạn có chắc muốn đăng xuất?')">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Đăng xuất</span>
    </a>
</li>

    </ul>

</div>
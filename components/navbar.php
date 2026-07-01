<?php
$base = "/Warehouse-App";
?>
<div class="navbar">

    <div class="nav-left">

        <button id="toggleSidebar">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Tìm kiếm...">
        </div>

    </div>

    <div class="nav-right">

        <div class="clock" id="clock"></div>

        <div class="notification">

            <i class="fa-solid fa-bell"></i>

            <span>3</span>

        </div>

        <div class="profile">

            <img src="<?= $base ?>/assets/img/avatar.png" alt="avatar">

            <div>

                <h4><?php echo $_SESSION['admin']['fullname']; ?></h4>

                <span>Administrator</span>

            </div>

        </div>

    </div>

</div>
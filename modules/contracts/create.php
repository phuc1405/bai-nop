<?php
include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

if(isset($_POST['save'])){

    $code = $_POST['contract_code'];
    $partner = $_POST['partner_name'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $status = $_POST['status'];

    $fileName = "";

    if(isset($_FILES['file']) && $_FILES['file']['name'] != ""){

        $fileName = time()."_".$_FILES['file']['name'];

        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            "../../assets/contracts/".$fileName
        );

    }

    mysqli_query(
        $conn,
        "INSERT INTO contracts
        (contract_code,partner_name,start_date,end_date,status,file)
        VALUES
        ('$code','$partner','$start','$end','$status','$fileName')"
    );

    header("Location:index.php");
    exit;
}
?>

<link rel="stylesheet" href="../../assets/css/dashboard.css">
<link rel="stylesheet" href="../../assets/css/products.css">

<div class="wrapper">

    <?php include("../../components/sidebar.php"); ?>

    <div class="main">

        <?php include("../../components/navbar.php"); ?>

        <div class="content">

            <div class="container">

                <div class="page-title">

                    <div>
                        <h1>Thêm hợp đồng</h1>
                        <p>Tạo hợp đồng mới</p>
                    </div>

                </div>

                <div class="form-box">

                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Mã hợp đồng</label>
                            <input
                                type="text"
                                name="contract_code"
                                class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Tên đối tác</label>
                            <input
                                type="text"
                                name="partner_name"
                                class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Ngày bắt đầu</label>
                            <input
                                type="date"
                                name="start_date"
                                class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Ngày kết thúc</label>
                            <input
                                type="date"
                                name="end_date"
                                class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>

                            <select
                                name="status"
                                class="form-control">

                                <option value="Đang hiệu lực">Đang hiệu lực</option>
                                <option value="Hết hạn">Hết hạn</option>
                                <option value="Tạm dừng">Tạm dừng</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>File hợp đồng</label>

                            <input
                                type="file"
                                name="file"
                                class="form-control">

                        </div>

                        <button
                            class="btn-save"
                            name="save">

                            Lưu hợp đồng

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>
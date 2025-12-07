<?php include 'views/layouts/header.php'; ?>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <?php include 'views/layouts/sidebar.php'; ?>

        <!-- Main content -->
        <main class="col-sm p-4 min-vh-100">

            <h2 class="mb-3">Dashboard</h2>
            <hr>

            <!-- ====== THỐNG KÊ ====== -->
            <div class="row g-3 mb-4">

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Tổng khóa học</h6>
                        <h3>24</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Đã hoàn thành</h6>
                        <h3>12</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Đang học</h6>
                        <h3>8</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Tiến độ trung bình</h6>
                        <h3>64%</h3>
                    </div>
                </div>

            </div>

            <!-- ====== KHÓA HỌC ĐANG HỌC ====== -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-3">Khóa học đang học</h5>

                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Khóa học</th>
                            <th>Giảng viên</th>
                            <th>Tiến độ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>PHP & MySQL Cơ bản</td>
                            <td>Trần Minh</td>
                            <td>70%</td>
                            <td><a href="#" class="btn btn-primary btn-sm">Tiếp tục</a></td>
                        </tr>

                        <tr>
                            <td>HTML/CSS Nâng cao</td>
                            <td>Nguyễn Hưng</td>
                            <td>40%</td>
                            <td><a href="#" class="btn btn-primary btn-sm">Tiếp tục</a></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </main>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>

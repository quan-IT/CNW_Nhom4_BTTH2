<?php include 'views/layouts/header.php'; ?>

<div class="container-fluid">
    <div class="row">

        <?php include 'views/layouts/sidebar.php'; ?>

        <main class="col-sm p-4 min-vh-100">

            <h2 class="mb-3">Student Dashboard</h2>
            <hr>

            <!-- STAT CARDS -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Tổng khóa học</h6>
                        <h3>12</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Đang học</h6>
                        <h3>5</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Đã hoàn thành</h6>
                        <h3>4</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Thời gian học</h6>
                        <h3>42 giờ</h3>
                    </div>
                </div>
            </div>

            <!-- RECENT PROGRESS -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-3">Tiến độ gần đây</h5>

                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Khóa học</th>
                            <th>Tiến độ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>PHP & MySQL Cơ bản</td>
                            <td style="width: 250px;">
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                </div>
                                <small class="text-muted">70%</small>
                            </td>
                            <td><a class="btn btn-primary btn-sm">Tiếp tục</a></td>
                        </tr>

                        <tr>
                            <td>HTML/CSS Nâng cao</td>
                            <td style="width: 250px;">
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-info" style="width: 40%"></div>
                                </div>
                                <small class="text-muted">40%</small>
                            </td>
                            <td><a class="btn btn-primary btn-sm">Tiếp tục</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>

    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>

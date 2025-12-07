<?php include 'views/layouts/header.php'; ?>


<div class="col-sm p-4 min-vh-100">
    <?php include 'views/layouts/sidebar.php'; ?>
    <h2 class="mb-3">Dashboard</h2>
    <hr>

    <!-- ====== GIÁ TRỊ THỐNG KÊ ====== -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Tổng khách hàng</h6>
                <h3>120</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Đơn hàng hôm nay</h6>
                <h3>18</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Doanh thu</h6>
                <h3>₫12,500,000</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Sản phẩm tồn kho</h6>
                <h3>540</h3>
            </div>
        </div>
    </div>

    <!-- ====== BIỂU ĐỒ (GIẢ LẬP) ====== -->
    <div class="card shadow-sm p-4 mb-4">
        <h5 class="mb-3">Biểu đồ doanh thu (demo)</h5>
        <div style="height: 200px; background:#e9ecef; border-radius:10px;"></div>
    </div>

    <!-- ====== BẢNG DỮ LIỆU ====== -->
    <div class="card shadow-sm p-4">
        <h5 class="mb-3">Danh sách đơn hàng mới</h5>

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Ngày</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1001</td>
                    <td>Nguyễn Văn A</td>
                    <td>2025-12-06</td>
                    <td>₫1,200,000</td>
                    <td><span class="badge bg-success">Hoàn thành</span></td>
                </tr>
                <tr>
                    <td>1002</td>
                    <td>Trần Thị B</td>
                    <td>2025-12-06</td>
                    <td>₫850,000</td>
                    <td><span class="badge bg-warning text-dark">Đang xử lý</span></td>
                </tr>
                <tr>
                    <td>1003</td>
                    <td>Lê Minh C</td>
                    <td>2025-12-06</td>
                    <td>₫540,000</td>
                    <td><span class="badge bg-danger">Hủy</span></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<?php include 'layouts/footer.php'; ?>
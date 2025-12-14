// course-detail.js hoặc thêm vào file JS chung

document.addEventListener("DOMContentLoaded", function () {
  const btnEnroll = document.getElementById("btnEnroll");
  if (!btnEnroll) return;

  // Hàm hiển thị toast
  function showToast(message, type = "success") {
    const container = document.getElementById("toastContainer");
    if (!container) {
      console.warn("Thiếu #toastContainer trong HTML!");
      return;
    }

    // Xóa toast cũ nếu có (tránh chồng)
    document.querySelectorAll(".toast").forEach((t) => t.remove());

    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;

    // Icon theo loại
    const icons = {
      info: '<i class="fas fa-info-circle toast-icon"></i>',
      success: '<i class="fas fa-check-circle toast-icon"></i>',
      warning: '<i class="fas fa-exclamation-triangle toast-icon"></i>',
      danger: '<i class="fas fa-times-circle toast-icon"></i>',
    };

    toast.innerHTML = `
            ${icons[type] || icons.success}
            <span>${message}</span>
            <button type="button" class="close-btn">&times;</button>
        `;

    container.appendChild(toast);

    // Hiển thị
    setTimeout(() => toast.classList.add("show"), 100);

    // Tự ẩn sau 4 giây
    const timer = setTimeout(() => {
      toast.classList.remove("show");
      setTimeout(() => toast.remove(), 500);
    }, 4000);

    // Đóng thủ công
    toast.querySelector(".close-btn").onclick = () => {
      clearTimeout(timer);
      toast.classList.remove("show");
      setTimeout(() => toast.remove(), 500);
    };
  }

  // Bấm nút Đăng kí học → hiện toast
  btnEnroll.addEventListener("click", function (e) {
    // Ngăn submit form nếu còn form bao ngoài
    e.preventDefault();

    // Có thể thay đổi loại toast tùy ý
    showToast("Đăng ký khóa học thành công!", "success");

    // Ví dụ các loại khác:
    // showToast("Bạn đã đăng ký khóa học này rồi!", "warning");
    // showToast("Vui lòng đăng nhập để đăng ký!", "info");
    // showToast("Có lỗi xảy ra, vui lòng thử lại!", "danger");
  });
});

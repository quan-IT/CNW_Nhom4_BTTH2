// assets/js/student/profile.js

document.addEventListener("DOMContentLoaded", function () {
    // Elements
    const form = document.getElementById("profileForm");
    const avatarPreview = document.getElementById("avatarPreview");
    const avatarError = document.getElementById("avatarError");
    const btnUpdateAvatar = document.getElementById("btnUpdateAvatar");
    const btnDeleteAvatar = document.getElementById("btnDeleteAvatar");
    const btnSubmitProfile = document.getElementById("btnSubmitProfile");

    // Inputs
    const inputs = {
        firstName: document.getElementById("firstName"),
        lastName: document.getElementById("lastName"),
        username: document.getElementById("username"),
        email: document.getElementById("email"),
        oldPassword: document.getElementById("oldPassword"),
        newPassword: document.getElementById("newPassword")
    };

    // Hidden file input for avatar
    const fileInput = document.createElement("input");
    fileInput.type = "file";
    fileInput.accept = "image/png,image/jpeg";
    fileInput.style.display = "none";
    document.body.appendChild(fileInput);

    let selectedFile = null;

    // ================================
    // TOAST FUNCTION - ĐẸP NHƯ ẢNH BẠN GỬI
    // ================================
    function showToast(message, type = "success") {
        const container = document.getElementById("toastContainer");
        if (!container) return;

        // Xóa toast cũ
        document.querySelectorAll('.toast').forEach(t => t.remove());

        const toast = document.createElement("div");
        toast.className = `toast toast-${type}`;

        const icons = {
            info: "ℹ️",
            success: "✅",
            warning: "⚠️",
            danger: "❌"
        };

        toast.innerHTML = `
            <span class="toast-icon">${icons[type] || icons.success}</span>
            <span>${message}</span>
            <button type="button" class="close-btn">&times;</button>
        `;

        container.appendChild(toast);

        setTimeout(() => toast.classList.add("show"), 100);

        const timer = setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 500);
        }, 4000);

        toast.querySelector(".close-btn").onclick = () => {
            clearTimeout(timer);
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 500);
        };
    }

    // ================================
    // AVATAR HANDLING
    // ================================
    btnUpdateAvatar.addEventListener("click", () => fileInput.click());

    fileInput.addEventListener("change", function () {
        const file = this.files[0];
        avatarError.textContent = "";

        if (!file) return;

        if (!["image/png", "image/jpeg"].includes(file.type)) {
            avatarError.textContent = "Chỉ chấp nhận PNG hoặc JPG!";
            showToast("File không hợp lệ. Chỉ chấp nhận PNG hoặc JPG.", "danger");
            return;
        }

        const img = new Image();
        img.onload = function () {
            if (img.width > 800 || img.height > 800) {
                avatarError.textContent = "Kích thước tối đa 800x800px!";
                showToast("Ảnh quá lớn! Tối đa 800x800px.", "warning");
                return;
            }

            avatarPreview.src = URL.createObjectURL(file);
            selectedFile = file;
            showToast("Avatar đã được chọn thành công!", "success");
        };
        img.src = URL.createObjectURL(file);
    });

    btnDeleteAvatar.addEventListener("click", function () {
        if (confirm("Bạn có chắc muốn xóa avatar?")) {
            avatarPreview.src = "assets/img/avatar-default.jpg";
            selectedFile = null;
            fileInput.value = "";
            showToast("Avatar đã được xóa!", "info");
        }
    });

    // ================================
    // FORM VALIDATION & SUBMIT
    // ================================
    function clearErrors() {
        document.querySelectorAll(".error-message").forEach(el => el.textContent = "");
        document.querySelectorAll(".form-group input").forEach(input => input.classList.remove("error"));
    }

    function showFieldError(id, message) {
        const input = document.getElementById(id);
        if (input) {
            input.classList.add("error");
            input.parentElement.querySelector(".error-message").textContent = message;
        }
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        clearErrors();

        let valid = true;

        if (!inputs.firstName.value.trim()) { showFieldError("firstName", "Vui lòng nhập First Name"); valid = false; }
        if (!inputs.lastName.value.trim()) { showFieldError("lastName", "Vui lòng nhập Last Name"); valid = false; }
        if (!inputs.username.value.trim()) { showFieldError("username", "Vui lòng nhập Username"); valid = false; }
        if (!inputs.email.value.trim()) { showFieldError("email", "Vui lòng nhập Email"); valid = false; }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (inputs.email.value.trim() && !emailRegex.test(inputs.email.value.trim())) {
            showFieldError("email", "Email không hợp lệ");
            valid = false;
        }

        if (inputs.newPassword.value.trim()) {
            if (inputs.newPassword.value.length < 6) {
                showFieldError("newPassword", "Mật khẩu mới ít nhất 6 ký tự");
                valid = false;
            }
            if (!inputs.oldPassword.value.trim()) {
                showFieldError("oldPassword", "Nhập mật khẩu cũ để thay đổi");
                valid = false;
            }
        }

        if (!valid) {
            showToast("Vui lòng kiểm tra lại thông tin!", "danger");
            return;
        }

        // Thành công → hiện toast success
        showToast("Cập nhật hồ sơ thành công!", "success");

        // Reset password fields (demo)
        inputs.oldPassword.value = "";
        inputs.newPassword.value = "";
    });
});
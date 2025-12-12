// validate-profile.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.profile-form');
    const avatarImg = document.querySelector('.avatar-img');
    const updateBtn = document.querySelector('.btn-update');
    const deleteBtn = document.querySelector('.btn-delete');

    // Biến lưu file ảnh tạm thời
    let tempAvatarFile = null;

    // === 1. Xử lý upload và preview avatar ===
    // Tạo input file ẩn để chọn ảnh
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/png,image/jpeg,image/jpg';
    fileInput.style.display = 'none';
    document.body.appendChild(fileInput);

    // Khi click nút Update → mở chọn file
    updateBtn.addEventListener('click', () => {
        fileInput.click();
    });

    // Xử lý khi chọn file
    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        // Kiểm tra định dạng
        const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('Chỉ chấp nhận file PNG hoặc JPG/JPEG.');
            return;
        }

        // Kiểm tra kích thước ảnh (tối đa 800x800px)
        const img = new Image();
        const objectUrl = URL.createObjectURL(file);
        img.onload = function () {
            if (img.width > 800 || img.height > 800) {
                alert('Kích thước ảnh tối đa là 800x800px.');
                URL.revokeObjectURL(objectUrl);
                return;
            }

            // Hiển thị preview
            avatarImg.src = objectUrl;
            tempAvatarFile = file; // Lưu tạm file để sau này submit nếu cần

            // Thông báo thành công (tùy chọn)
            console.log('Avatar tạm thời đã được chọn:', file.name);
            URL.revokeObjectURL(objectUrl); // Giải phóng bộ nhớ (src đã được gán)
        };
        img.src = objectUrl;
    });

    // Xóa avatar (quay về ảnh mặc định)
    deleteBtn.addEventListener('click', function () {
        if (confirm('Bạn có chắc muốn xóa avatar hiện tại?')) {
            avatarImg.src = 'assets/img/avatar-default.jpg';
            tempAvatarFile = null;
            fileInput.value = ''; // Reset input file
        }
    });

    // === 2. Validate form khi submit ===
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Ngăn submit thật (vì đây chỉ là demo)

        let isValid = true;
        let errorMessages = [];

        // Lấy các trường
        const firstName = form.querySelector('input[placeholder="First Name"]');
        const lastName = form.querySelector('input[placeholder="Last Name"]');
        const username = form.querySelector('input[placeholder="UserName"]');
        const email = form.querySelector('input[placeholder="Email"]');
        const oldPassword = form.querySelector('input[type="password"]:nth-of-type(1)');
        const newPassword = form.querySelector('input[type="password"]:nth-of-type(2)');

        // Reset border lỗi trước đó
        [firstName, lastName, username, email, oldPassword, newPassword].forEach(input => {
            input.style.borderColor = '';
        });

        // Validate First Name
        if (!firstName.value.trim()) {
            isValid = false;
            firstName.style.borderColor = 'red';
            errorMessages.push('Vui lòng nhập First Name.');
        }

        // Validate Last Name
        if (!lastName.value.trim()) {
            isValid = false;
            lastName.style.borderColor = 'red';
            errorMessages.push('Vui lòng nhập Last Name.');
        }

        // Validate Username (chỉ chữ cái, số, gạch dưới, ít nhất 3 ký tự)
        const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/;
        if (!username.value.trim()) {
            isValid = false;
            username.style.borderColor = 'red';
            errorMessages.push('Vui lòng nhập Username.');
        } else if (!usernameRegex.test(username.value)) {
            isValid = false;
            username.style.borderColor = 'red';
            errorMessages.push('Username chỉ chứa chữ cái, số, gạch dưới và từ 3-20 ký tự.');
        }

        // Validate Email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim()) {
            isValid = false;
            email.style.borderColor = 'red';
            errorMessages.push('Vui lòng nhập Email.');
        } else if (!emailRegex.test(email.value)) {
            isValid = false;
            email.style.borderColor = 'red';
            errorMessages.push('Email không hợp lệ.');
        }

        // Validate Password (nếu nhập New Password thì phải nhập Old Password)
        if (newPassword.value && !oldPassword.value) {
            isValid = false;
            oldPassword.style.borderColor = 'red';
            errorMessages.push('Vui lòng nhập Old Password nếu muốn đổi mật khẩu.');
        }

        if (newPassword.value && newPassword.value.length < 6) {
            isValid = false;
            newPassword.style.borderColor = 'red';
            errorMessages.push('New Password phải có ít nhất 6 ký tự.');
        }

        // Hiển thị thông báo
        if (!isValid) {
            alert('Lỗi validate:\n• ' + errorMessages.join('\n• '));
            return;
        }

        // Nếu mọi thứ hợp lệ
        alert('Tất cả thông tin hợp lệ! Sẵn sàng cập nhật profile.\n(Đây là demo - không gửi dữ liệu thật)');

        // Ở đây bạn có thể thu thập dữ liệu để gửi AJAX
        // Ví dụ:
        // const formData = new FormData();
        // formData.append('firstName', firstName.value);
        // ... + append tempAvatarFile nếu có
        // fetch('/update-profile', { method: 'POST', body: formData })
    });
});
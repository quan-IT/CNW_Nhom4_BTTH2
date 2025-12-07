// assets/js/register.js
$(document).ready(function () {

    // Hàm hiển thị lỗi
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.add('has-error');
        formGroup.classList.remove('has-success');

        // Xóa lỗi cũ nếu có
        formGroup.querySelector('.error-message')?.remove();

        const error = document.createElement('label');
        error.className = 'error-message';
        error.style.color = '#e74c3c';
        error.style.fontSize = '12px';
        error.style.marginTop = '5px';
        error.style.display = 'block';
        error.innerText = message;

        input.after(error);
    }

    // Hàm hiển thị thành công (icon check xanh)
    function showSuccess(input) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.remove('has-error');
        formGroup.classList.add('has-success');

        formGroup.querySelector('.error-message')?.remove();
        if (!formGroup.querySelector('.valid')) {
            const validIcon = document.createElement('label');
            validIcon.className = 'valid';
            input.parentNode.appendChild(validIcon);
        }
    }

    // Xóa thông báo khi người dùng nhập lại
    function clearValidation(input) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.remove('has-error', 'has-success');
        formGroup.querySelector('.error-message')?.remove();
        formGroup.querySelector('.valid')?.remove();
    }

    // Validate từng field khi blur
    $('#username, #fullname, #email, #pass, #re_pass').on('blur', function () {
        validateField($(this));
    }).on('input', function () {
        clearValidation(this);
    });

    // Validate checkbox terms
    $('#agree-term').on('change', function () {
        const formGroup = this.closest('.form-group');
        if (this.checked) {
            formGroup.classList.remove('has-error');
        } else {
            formGroup.classList.add('has-error');
        }
    });

    // Hàm validate từng field
    function validateField($input) {
        const value = $input.val().trim();
        const id = $input.attr('id');

        if (value === '') {
            showError($input[0], 'This field is required');
            return false;
        }

        switch (id) {
            case 'username':
                if (value.length < 4) {
                    showError($input[0], 'Username must be at least 4 characters');
                    return false;
                }
                if (!/^[a-zA-Z0-9_]+$/.test(value)) {
                    showError($input[0], 'Username can only contain letters, numbers and underscore');
                    return false;
                }
                break;

            case 'fullname':
                if (value.length < 2) {
                    showError($input[0], 'Full name must be at least 2 characters');
                    return false;
                }
                if (!/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/.test(value)) {
                    showError($input[0], 'Full name contains invalid characters');
                    return false;
                }
                break;

            case 'email':
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    showError($input[0], 'Please enter a valid email address');
                    return false;
                }
                break;

            case 'pass':
                if (value.length < 6) {
                    showError($input[0], 'Password must be at least 6 characters');
                    return false;
                }
                break;

            case 're_pass':
                const pass = $('#pass').val();
                if (value !== pass) {
                    showError($input[0], 'Passwords do not match');
                    return false;
                }
                break;
        }

        showSuccess($input[0]);
        return true;
    }

    // Validate toàn bộ form khi submit
    $('#register-form').on('submit', function (e) {
        let isValid = true;

        // Validate tất cả các field
        $('#username, #fullname, #email, #pass, #re_pass').each(function () {
            if (!validateField($(this))) {
                isValid = false;
            }
        });

        // Kiểm tra checkbox điều khoản
        if (!$('#agree-term').is(':checked')) {
            const formGroup = $('#agree-term').closest('.form-group');
            formGroup.classList.add('has-error');
            if (!formGroup.querySelector('.error-message')) {
                const error = document.createElement('label');
                error.className = 'error-message';
                error.style.color = '#e74c3c';
                error.style.fontSize = '12px';
                error.innerText = 'You must agree to the terms of service';
                $('#agree-term').parent().append(error);
            }
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // Ngăn submit nếu có lỗi
            return false;
        }

        // Nếu hợp lệ thì cho submit (có thể thêm AJAX ở đây)
        // alert('Đăng ký thành công!'); // Thông báo tạm thời
    });

});
$(document).ready(function () {

    // Hiển thị lỗi
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.add('has-error');
        formGroup.classList.remove('has-success');

        // Xóa lỗi cũ
        $(formGroup).find('.error-message').remove();
        $(formGroup).find('.valid-icon').remove();

        // Thêm lỗi dưới input
        const error = $('<span class="error-message"></span>').text(message);
        $(formGroup).append(error);
    }

    // Hiển thị thành công
    function showSuccess(input) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.remove('has-error');
        formGroup.classList.add('has-success');

        $(formGroup).find('.error-message').remove();
        $(formGroup).find('.valid-icon').remove();

        // Icon check xanh bên phải input
        const icon = $('<span class="valid-icon">&#10004;</span>');
        $(formGroup).append(icon);
    }

    // Xóa khi nhập
    function clearValidation(input) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.remove('has-error', 'has-success');
        $(formGroup).find('.error-message').remove();
        $(formGroup).find('.valid-icon').remove();
    }

    // Validate từng field khi blur
    $('#username, #fullname, #email, #pass, #re_pass')
        .on('blur', function () {
            validateField($(this));
        })
        .on('input', function () {
            clearValidation(this);
        });

    // Checkbox
    $('#agree-term').on('change', function () {
        const formGroup = this.closest('.form-group');
        $(formGroup).find('.error-message').remove();

        if (this.checked) {
            formGroup.classList.remove('has-error');
        } else {
            formGroup.classList.add('has-error');
            $(formGroup).append(`<span class="error-message">You must agree</span>`);
        }
    });

    // Validate field
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
                if (!/^[a-zA-ZÀ-ỹ\s]+$/.test(value)) {
                    showError($input[0], 'Full name contains invalid characters');
                    return false;
                }
                break;

            case 'email':
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
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
                if (value !== $('#pass').val()) {
                    showError($input[0], 'Passwords do not match');
                    return false;
                }
                break;
        }

        showSuccess($input[0]);
        return true;
    }

    // Submit form
    $('#register-form').on('submit', function (e) {
        let isValid = true;

        $('#username, #fullname, #email, #pass, #re_pass').each(function () {
            if (!validateField($(this))) {
                isValid = false;
            }
        });

        if (!$('#agree-term').is(':checked')) {
            const formGroup = $('#agree-term').closest('.form-group');
            $(formGroup).addClass('has-error');
            $(formGroup).find('.error-message').remove();
            $(formGroup).append('<span class="error-message">You must agree to the terms</span>');
            isValid = false;
        }

        if (!isValid) e.preventDefault();
    });

});

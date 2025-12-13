const form = document.getElementById("profileForm");

const inputs = {
  firstName: document.getElementById("firstName"),
  lastName: document.getElementById("lastName"),
  username: document.getElementById("username"),
  email: document.getElementById("email"),
  oldPassword: document.getElementById("oldPassword"),
  newPassword: document.getElementById("newPassword"),
};

form.addEventListener("submit", function (e) {
  e.preventDefault();

  clearErrors();
  let valid = true;

  // ===== 1. Validate rỗng =====
  const requiredFields = [
    { el: inputs.firstName, msg: "Vui lòng nhập First Name" },
    { el: inputs.lastName, msg: "Vui lòng nhập Last Name" },
    { el: inputs.username, msg: "Vui lòng nhập Username" },
    { el: inputs.email, msg: "Vui lòng nhập Email" },
  ];

  requiredFields.forEach(({ el, msg }) => {
    if (!el.value.trim()) {
      showError(el, msg);
      valid = false;
    }
  });

  // ===== 2. Validate Email =====
  if (inputs.email.value.trim()) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(inputs.email.value.trim())) {
      showError(inputs.email, "Email không hợp lệ");
      valid = false;
    }
  }

  // ===== 3. Validate đổi mật khẩu =====
  const oldPass = inputs.oldPassword.value.trim();
  const newPass = inputs.newPassword.value.trim();

  if (newPass) {
    if (!oldPass) {
      showError(inputs.oldPassword, "Vui lòng nhập mật khẩu cũ");
      valid = false;
    }
    if (newPass.length < 6) {
      showError(inputs.newPassword, "Mật khẩu mới tối thiểu 6 ký tự");
      valid = false;
    }
  }

  if (!valid) {
    showToast("Vui lòng kiểm tra lại thông tin!", "danger");
    return;
  }

  // ===== 4. Gửi dữ liệu =====
  const formData = new FormData(form);

  fetch("index.php?url=student/updateprofile", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        showToast("Cập nhật thành công!", "success");
        setTimeout(() => {
          window.location.href = "index.php?url=student/profile";
        }, 1000);
      } else {
        showToast(data.message || "Có lỗi xảy ra!", "danger");
      }
    })
    .catch((err) => {
      console.error(err);
      showToast("Lỗi kết nối server!", "danger");
    });
});

/* ================== FUNCTIONS ================== */

function showError(input, message) {
  input.classList.add("is-invalid");
  const errorDiv = input.parentElement.querySelector(".error-message");
  errorDiv.innerText = message;
}

function clearErrors() {
  document
    .querySelectorAll(".is-invalid")
    .forEach((el) => el.classList.remove("is-invalid"));
  document
    .querySelectorAll(".error-message")
    .forEach((el) => (el.innerText = ""));
}
function showToast(message, type = "info") {
  const toast = document.createElement("div");
  toast.className = `toast toast-${type}`;
  toast.innerText = message;

  document.getElementById("toastContainer").appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 3000);
}

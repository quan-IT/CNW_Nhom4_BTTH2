form.addEventListener("submit", function (e) {
  e.preventDefault();

  let valid = true;

  if (!inputs.firstName.value.trim()) {
    showFieldError("firstName", "Vui lòng nhập First Name");
    valid = false;
  }
  if (!inputs.lastName.value.trim()) {
    showFieldError("lastName", "Vui lòng nhập Last Name");
    valid = false;
  }
  if (!inputs.username.value.trim()) {
    showFieldError("username", "Vui lòng nhập Username");
    valid = false;
  }
  if (!inputs.email.value.trim()) {
    showFieldError("email", "Vui lòng nhập Email");
    valid = false;
  }

  if (!valid) {
    showToast("Vui lòng kiểm tra lại thông tin!", "danger");
    return;
  }

  const formData = new FormData();
  formData.append(
    "fullname",
    inputs.firstName.value.trim() + " " + inputs.lastName.value.trim()
  );

  formData.append("username", inputs.username.value.trim());
  formData.append("email", inputs.email.value.trim());
  formData.append("oldPassword", inputs.oldPassword.value.trim());
  formData.append("newPassword", inputs.newPassword.value.trim());

  // ❗ Không gửi avatar nữa
  // if (selectedFile) formData.append("avatar", selectedFile);

  fetch("index.php?url=student/updateprofile", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data); // kiểm tra server trả về gì
      if (data.status === "success") {
        showToast("Cập nhật thành công!", "success");
      } else {
        showToast(data.message || "Có lỗi xảy ra!", "danger");
      }
    })
    .catch((err) => {
      showToast("Lỗi kết nối server!", "danger");
      console.error("FETCH ERROR:", err);
    });
});

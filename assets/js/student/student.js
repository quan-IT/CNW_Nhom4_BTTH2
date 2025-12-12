document.getElementById('notificationBell').addEventListener('click', function(e) {
    e.stopPropagation();
    document.getElementById('notificationDropdown').classList.toggle('show');
});

// Đóng khi click bên ngoài
document.addEventListener('click', function() {
    document.getElementById('notificationDropdown').classList.remove('show');
});

// Ngăn đóng khi click vào dropdown
document.getElementById('notificationDropdown').addEventListener('click', function(e) {
    e.stopPropagation();
});
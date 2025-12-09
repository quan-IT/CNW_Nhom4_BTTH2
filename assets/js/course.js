document.querySelectorAll(".start-btn").forEach(btn => {
    btn.addEventListener("click", function () {
        // alert("Đi đến bài học!");
        // Ở MVC bạn sẽ redirect like:
        window.location.href = "index.php?url=course";
    });
});

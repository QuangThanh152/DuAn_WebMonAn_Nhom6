// Xử lý điều hướng (navigation) trong thanh bên
document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        // Xóa class active khỏi tất cả các liên kết
        document.querySelectorAll('.sidebar a').forEach(l => l.classList.remove('active'));
        // Thêm class active vào liên kết được click
        this.classList.add('active');

        // Ẩn tất cả các phần nội dung
        document.getElementById('homeContent').classList.remove('active');
        document.getElementById('menuContent').classList.remove('active');

        // Hiển thị phần nội dung được chọn
        const page = this.getAttribute('data-page');
        document.getElementById(page + 'Content').classList.add('active');

        // Thay đổi URL mà không tải lại trang
        history.pushState(null, '', `?page=${page}`);
    });
});

// Xử lý nút đăng xuất
document.querySelector('.logout-btn').addEventListener('click', function() {
    if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
        console.log('Đang đăng xuất...');
        // Thêm logic đăng xuất ở đây
    }
});

// Xử lý gửi form Menu
document.getElementById('menuForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log('Form đã được gửi');
        alert('Dữ liệu đã được lưu thành công!');
        // Giữ nguyên trang menu sau khi dữ liệu đã được lưu
        history.pushState(null, '', `?page=menu`);
        location.reload(); // Tải lại trang để cập nhật danh sách menu
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Đã xảy ra lỗi khi lưu dữ liệu.');
    });
});

// Xử lý nút Chỉnh sửa (Edit)
document.querySelectorAll('.btn-primary').forEach(button => {
    button.addEventListener('click', function() {
        console.log('Nút Chỉnh sửa được nhấn');
        document.getElementById('menuContent').classList.add('active');
        document.getElementById('homeContent').classList.remove('active');
        // Thay đổi URL mà không tải lại trang
        history.pushState(null, '', `?page=menu`);
    });
});

// Xử lý nút Xóa (Delete)
document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function() {
        if (confirm('Bạn có chắc chắn muốn xóa mục này?')) {
            console.log('Xóa đã được xác nhận');
            document.getElementById('menuContent').classList.add('active');
            document.getElementById('homeContent').classList.remove('active');
            // Thêm logic xóa ở đây
            // Thay đổi URL mà không tải lại trang
            history.pushState(null, '', `?page=menu`);
        }
    });
});

// Hiển thị phần nội dung tương ứng khi tải lại trang
document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const page = params.get('page') || 'home';
    document.querySelectorAll('.sidebar a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('data-page') === page) {
            link.classList.add('active');
        }
    });

    document.getElementById('homeContent').classList.remove('active');
    document.getElementById('menuContent').classList.remove('active');
    document.getElementById(`${page}Content`).classList.add('active');
});


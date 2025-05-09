@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Phụ Kiện Thú Cưng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            background: url('https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .feature-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .feature-card {
            text-align: center;
            padding: 20px;
        }

        .feature-card img {
            width: 80px;
            margin-bottom: 20px;
        }

        .testimonial-section {
            padding: 60px 0;
            background-color: #fff;
        }

        .testimonial-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 60px 0;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">PetShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Dịch Vụ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Đánh Giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Giới Thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Liên Hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-content">
            <h1 class="display-3 fw-bold">Phụ Kiện Thú Cưng Cao Cấp</h1>
            <p class="lead">Mang đến sự thoải mái, phong cách và niềm vui cho thú cưng của bạn!</p>
            <p>Khám phá bộ sưu tập phụ kiện độc đáo, được thiết kế dành riêng cho những người bạn bốn chân.</p>
            <a href="/login" class="btn btn-primary btn-lg mt-3">Mua Sắm Ngay</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="feature-section">
        <div class="container">
            <h2 class="text-center mb-5">Tại Sao Chọn PetShop?</h2>
            <div class="row">
                <div class="col-md-4 feature-card">
                    <img src="https://img.icons8.com/ios/80/000000/quality.png" alt="Chất lượng">
                    <h4>Chất Lượng Đảm Bảo</h4>
                    <p>Tất cả sản phẩm đều được kiểm định kỹ lưỡng, an toàn cho thú cưng.</p>
                </div>
                <div class="col-md-4 feature-card">
                    <img src="https://img.icons8.com/ios/80/000000/delivery.png" alt="Giao hàng">
                    <h4>Giao Hàng Nhanh Chóng</h4>
                    <p>Giao hàng toàn quốc trong 24-48 giờ với dịch vụ chuyên nghiệp.</p>
                </div>
                <div class="col-md-4 feature-card">
                    <img src="https://img.icons8.com/ios/80/000000/customer-support.png" alt="Hỗ trợ">
                    <h4>Hỗ Trợ Tận Tâm</h4>
                    <p>Đội ngũ hỗ trợ 24/7, sẵn sàng giải đáp mọi thắc mắc của bạn.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Sản Phẩm Nổi Bật</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb" class="card-img-top"
                            alt="Vòng cổ">
                        <div class="card-body">
                            <h5 class="card-title">Vòng Cổ Cao Cấp</h5>
                            <p class="card-text">Vòng cổ bền đẹp, thiết kế thời trang, phù hợp cho mọi giống chó mèo.
                            </p>
                            <p class="fw-bold">Giá: 250.000 VNĐ</p>
                            <a href="#" class="btn btn-outline-primary">Thêm Vào Giỏ</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb" class="card-img-top"
                            alt="Đồ chơi">
                        <div class="card-body">
                            <h5 class="card-title">Đồ Chơi Thú Cưng</h5>
                            <p class="card-text">Đồ chơi an toàn, giúp thú cưng năng động và giảm căng thẳng.</p>
                            <p class="fw-bold">Giá: 150.000 VNĐ</p>
                            <a href="#" class="btn btn-outline-primary">Thêm Vào Giỏ</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb" class="card-img-top"
                            alt="Giường ngủ">
                        <div class="card-body">
                            <h5 class="card-title">Giường Ngủ Êm Ái</h5>
                            <p class="card-text">Giường ngủ mềm mại, ấm áp, mang lại giấc ngủ ngon cho thú cưng.</p>
                            <p class="fw-bold">Giá: 450.000 VNĐ</p>
                            <a href="#" class="btn btn-outline-primary">Thêm Vào Giỏ</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb" class="card-img-top"
                            alt="Áo khoác">
                        <div class="card-body">
                            <h5 class="card-title">Áo Khoác Thú Cưng</h5>
                            <p class="card-text">Áo khoác thời trang, giữ ấm cho thú cưng trong mùa đông.</p>
                            <p class="fw-bold">Giá: 300.000 VNĐ</p>
                            <a href="#" class="btn btn-outline-primary">Thêm Vào Giỏ</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb" class="card-img-top"
                            alt="Bát ăn">
                        <div class="card-body">
                            <h5 class="card-title">Bát Ăn Cao Cấp</h5>
                            <p class="card-text">Bát ăn chống trượt, dễ vệ sinh, an toàn cho thú cưng.</p>
                            <p class="fw-bold">Giá: 200.000 VNĐ</p>
                            <a href="#" class="btn btn-outline-primary">Thêm Vào Giỏ</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb" class="card-img-top"
                            alt="Dây dắt">
                        <div class="card-body">
                            <h5 class="card-title">Dây Dắt Chắc Chắn</h5>
                            <p class="card-text">Dây dắt bền bỉ, thoải mái cho thú cưng khi đi dạo.</p>
                            <p class="fw-bold">Giá: 180.000 VNĐ</p>
                            <a href="#" class="btn btn-outline-primary">Thêm Vào Giỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonial-section">
        <div class="container">
            <h2 class="text-center mb-5">Khách Hàng Nói Gì?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <p>"Sản phẩm rất chất lượng, chú cún của tôi thích mê chiếc giường mới!"</p>
                        <h5>Nguyễn Minh Anh</h5>
                        <p class="text-muted">TP. Hồ Chí Minh</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <p>"Giao hàng nhanh, dịch vụ hỗ trợ rất nhiệt tình. Sẽ tiếp tục ủng hộ!"</p>
                        <h5>Trần Văn Hùng</h5>
                        <p class="text-muted">Hà Nội</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <p>"Vòng cổ đẹp, chắc chắn, mèo nhà tôi trông thật phong cách!"</p>
                        <h5>Lê Thị Hồng</h5>
                        <p class="text-muted">Đà Nẵng</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Về PetShop</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>PetShop được thành lập với sứ mệnh mang đến những sản phẩm chất lượng cao, an toàn và phong cách
                        cho thú cưng. Chúng tôi hiểu rằng thú cưng không chỉ là bạn đồng hành mà còn là thành viên trong
                        gia đình.</p>
                    <p>Với hơn 5 năm kinh nghiệm, PetShop tự hào cung cấp đa dạng các loại phụ kiện từ vòng cổ, đồ chơi,
                        giường ngủ đến quần áo thời trang. Tất cả sản phẩm đều được chọn lọc kỹ lưỡng để đảm bảo sự
                        thoải mái và an toàn cho thú cưng của bạn.</p>
                    <p>Chúng tôi cam kết mang đến dịch vụ khách hàng tuyệt vời, giao hàng nhanh chóng và chính sách đổi
                        trả linh hoạt. Hãy để PetShop đồng hành cùng bạn trong hành trình chăm sóc thú cưng!</p>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1494947661490-409ed9ebad0e" class="img-fluid rounded"
                        alt="About us">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Liên Hệ Với Chúng Tôi</h2>
            <div class="row">
                <div class="col-md-6">
                    <h4>Thông Tin Liên Hệ</h4>
                    <p><strong>Địa chỉ:</strong> 123 Đường Thú Cưng, Quận 1, TP. Hồ Chí Minh</p>
                    <p><strong>Email:</strong> contact@petshop.vn</p>
                    <p><strong>Điện thoại:</strong> 0123 456 789</p>
                    <p><strong>Giờ làm việc:</strong> 8:00 - 20:00, Thứ 2 - Chủ Nhật</p>
                    <div class="mt-4">
                        <h5>Theo Dõi Chúng Tôi</h5>
                        <a href="#" class="me-3"><img src="https://img.icons8.com/ios/30/000000/facebook.png"
                                alt="Facebook"></a>
                        <a href="#" class="me-3"><img
                                src="https://img.icons8.com/ios/30/000000/instagram.png" alt="Instagram"></a>
                        <a href="#"><img src="https://img.icons8.com/ios/30/000000/twitter.png"
                                alt="Twitter"></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Gửi Tin Nhắn</h4>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Họ và Tên" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" name="phone" class="form-control" id="phone"
                                placeholder="Số Điện Thoại" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Tin Nhắn</label>
                            <textarea name="message" class="form-control" id="message" rows="5" placeholder="Tin nhắn của bạn"
                                required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Gửi Tin Nhắn</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về PetShop</h5>
                    <p>PetShop chuyên cung cấp phụ kiện thú cưng chất lượng cao, mang đến sự thoải mái và phong cách cho
                        thú cưng của bạn.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên Kết Nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home">Trang Chủ</a></li>
                        <li><a href="#products">Sản Phẩm</a></li>
                        <li><a href="#about">Giới Thiệu</a></li>
                        <li><a href="#contact">Liên Hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Liên Hệ</h5>
                    <p>123 Đường Thú Cưng, Quận 1, TP. Hồ Chí Minh</p>
                    <p>Email: contact@petshop.vn</p>
                    <p>Điện thoại: 0123 456 789</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>© 2025 PetShop. All rights reserved.</p>
                <p>
                    <a href="#" class="mx-2">Facebook</a> |
                    <a href="#" class="mx-2">Instagram</a> |
                    <a href="#" class="mx-2">Twitter</a>
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@extends('client.layouts.master')
@section('title', 'Blogs')

@section('content')
    <!-- Start Contact Section -->
    <section id="contact" style="background: url('images/contact-bg.png') no-repeat center/cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="display-4 fw-bold">Get in <span class="text-primary">Touch</span>🐾</h2>
                    <p class="lead text-muted">Have questions? We'd love to hear from you. Fill out the form and we'll get
                        back to you as soon as possible.</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-3 p-4">
                        <h2 class="text-center mb-4 fw-bold">Contact Us</h2>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control form-control-lg"
                                    placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-control-lg"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control form-control-lg"
                                    placeholder="Your Phone Number" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control form-control-lg" rows="7" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button style="width: 35%;" type="submit" class="btn btn-primary btn-lg">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-3 p-4 h-100">
                        <h4 class="fw-semibold mb-3 text-center">Contact Information</h4>

                        <p class="mb-3"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Address: 123 Pet Street, Ho Chi Minh
                            City, Vietnam</p>
                        <p class="mb-3"><i class="bi bi-telephone-fill text-primary me-2"></i>Phone: +84 987 654 321</p>
                        <p class="mb-3"><i class="bi bi-envelope-fill text-primary me-2"></i>Email: support@petworld.vn</p>
                        <p><i class="bi bi-clock-fill text-primary me-2"></i> Mon - Sun: 8:00 AM - 8:00 PM</p>

                        <hr class="my-3 ">

                        <h5 class="fw-semibold mb-3 text-center">Find Us on Map</h5>
                        <div class="ratio ratio-16x9">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.502437117308!2d106.70042351533414!3d10.76262299233257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4062d28b3f%3A0x7b80b6a1a0b7e87a!2zMTIzIFBoYW4gQ2h1IFN0LCBRdeG7kWMgMSwgSOG7kyBDaMOtbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaA!5e0!3m2!1svi!2s!4v1635933679845!5m2!1svi!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- End Contact Section -->
@endsection

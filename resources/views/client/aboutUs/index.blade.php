@extends('client.layouts.master')
@section('title', 'About Us')

@section('content')
    <!-- Start About Section -->
    <section id="about" class="py-5" style="background: #fdfdfd;">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Image -->
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('uploads/images/aboutus.jpg') }}" alt="PetWorld"
                        class="img-fluid rounded-4 shadow-lg" style="max-height: 500px; object-fit: cover;">
                </div>

                <!-- Text -->
                <div class="col-lg-6">
                    <h2 class="fw-bold display-5 text-success mb-3">🐾 About <span class="text-primary">PetWorld</span></h2>
                    <p class="lead text-muted mb-4">
                        At PetWorld, we believe pets are not just companions, they are family members.  
                        Our mission is to provide your furry friends 🐶🐱 with the best care – from premium food, stylish accessories to professional grooming and pet hotel services.
                    </p>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-2"><i class="bi bi-heart-fill text-danger me-2"></i> Safe & High-Quality Products</li>
                        <li class="mb-2"><i class="bi bi-bag-check-fill text-success me-2"></i> Friendly & Caring Team</li>
                        <li class="mb-2"><i class="bi bi-stars text-warning me-2"></i> Grooming & Pet Hotel Services</li>
                    </ul>
                    <a href="{{ route('contact.store') }}"
                        class="btn btn-success btn-lg rounded-pill mt-4 shadow-sm">Contact Us 🐾</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-5" style="background: #f8f9fa;">
        <div class="container text-center">
            <h3 class="fw-bold text-primary mb-4">🌟 Our Mission</h3>
            <p class="lead text-muted mx-auto" style="max-width: 750px;">
                At PetWorld, our mission is to be your trusted partner in pet care.  
                We are committed to delivering high-quality products and services filled with love and care.  
                Let us help you create happy, healthy moments with your beloved pets 💕.
            </p>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <h3 class="fw-bold text-center mb-5" style="color: rgb(56, 110, 56)">👩‍⚕️ Meet Our Team</h3>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('uploads/images/team1.png') }}" class="rounded-circle shadow mb-3" width="150" height="150"
                        alt="Team Member">
                    <h5 class="fw-semibold">Anna Nguyen</h5>
                    <p class="text-muted">Grooming Specialist</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('uploads/images/team2.png') }}" class="rounded-circle shadow mb-3" width="150" height="150"
                        alt="Team Member">
                    <h5 class="fw-semibold">David Tran</h5>
                    <p class="text-muted">Veterinarian</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('uploads/images/team3.png') }}" class="rounded-circle shadow mb-3" width="150" height="150"
                        alt="Team Member">
                    <h5 class="fw-semibold">Emily Pham</h5>
                    <p class="text-muted">Customer Care Consultant</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->
@endsection

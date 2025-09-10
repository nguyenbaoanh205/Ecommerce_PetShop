@extends('admin.layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Profile</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.alert')
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Avatar -->
                            <div class="col-md-3">
                                <div class="card p-3 mb-4">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <img id="avatarPreview"
                                                 src="{{ $user->avatar ? asset($user->avatar) : asset('/uploads/default/avatar_default.png') }}"
                                                 class="rounded-circle mb-2"
                                                 style="width: 150px; height: 150px; object-fit: cover;">
                                            <label for="avatar"
                                                   class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                                                   style="cursor: pointer; width: 40px; height: 40px; border: 2px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.15); font-size: 16px;">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                            <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*"
                                                   onchange="previewImage(event)">
                                        </div>
                                        <h5 class="mt-2">{{ $user->name }}</h5>
                                        <p class="text-muted">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Information -->
                            <div class="col-md-9">
                                <div class="card p-4">
                                    <h4 class="mb-4">Personal Information</h4>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="{{ $user->name }}">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                   value="{{ $user->email }}" disabled>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                   value="{{ $user->phone }}">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                   value="{{ $user->address }}">
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="d-flex justify-content-start gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary px-4">Update</button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-4">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('avatarPreview');
                img.src = e.target.result;
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

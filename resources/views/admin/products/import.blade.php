@extends('admin.layouts.master')

@section('content')
<main>
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Import sản phẩm từ file excel</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Import Products</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg p-4">
                        <div class="card-header bg-primary text-white">
                            <h5>Import sản phẩm từ file excel</h5>
                        </div>
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" style="padding:30px;">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Chọn file excel (bắt buộc)(.xlsx):</label>
                                <input type="file" name="file" id="file" class="form-control" accept=".xlsx, .xls, .csv" required>
                            </div>

                            <div class="mb-3">
                                <i>Lưu ý: Sử dụng file excel theo cấu trúc file excel mẫu. Các id sản phẩm phải đã được thêm trên hệ thống thì mới có thể cập nhật các thông tin: Tên sản phẩm, giá, mô tả</i><br>
                                <a href="/petshop-example/import_san_pham_mau.xlsx">Tải file excel mẫu</a>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4">Import</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</main>
@endsection

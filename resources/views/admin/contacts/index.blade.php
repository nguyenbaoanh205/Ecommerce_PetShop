@extends('admin.layouts.master')
@section('title', 'Contacts Management')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Contacts</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Contacts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Contact Messages</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.alert')

                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Message</th>
                                        <th>Date Sent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contacts as $key => $contact)
                                        <tr>
                                            <td>{{ $contacts->firstItem() + $key }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ Str::limit($contact->message, 50, '...') }}</td>
                                            <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Không có liên hệ nào.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="mt-3">
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection

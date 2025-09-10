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
<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);
</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    @if ($isAdmin ?? false)
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endif

@if (session('error'))
    @if ($isAdmin ?? false)
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @else
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endif --}}

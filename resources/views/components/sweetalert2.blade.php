@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('scripts')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "สำเร็จ!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: '#34D399'
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "สำเร็จ!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonColor: '##ff0000'
                });
            });
        </script>
    @endif
@endpush
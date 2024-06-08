<!-- core:js -->
<script src="{{ asset('admin/assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('admin/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<!-- End plugin js for this page -->
<script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<!-- inject:js -->
<script src="{{ asset('admin/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/template.js') }}"></script>
<!-- endinject -->
<script src="{{ asset('admin/assets/js/data-table.js') }}"></script>
<script src="{{ asset('admin/assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('admin/assets/js/sweetalert2@11.js') }}"></script>

<!-- Custom js for this page -->
<script src="{{ asset('admin/assets/js/dashboard-dark.js') }}"></script>
<script src="{{ asset('admin/assets/js/tinymce.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/select2/select2.min.js') }}"></script>

<script src="{{ asset('admin/assets/js/select2.js') }}"></script>
<!-- End custom js for this page -->
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
<script>
    function deleteId(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                // If the user confirms, submit the form
                document.getElementById('delete_form_' + id).submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // If the user cancels, show a message
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }
</script>

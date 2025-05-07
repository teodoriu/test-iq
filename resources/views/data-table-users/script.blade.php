<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("users.data") }}',
            columns: [
                { data: 'id', width: '10%' },
                { data: 'name', width: '25%' },
                { data: 'email', width: '30%' },
                { data: 'created_at', width: '20%' },
                { 
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                    width: '15%',
                    className: 'text-right'
                }
            ],
            dom: '<"mb-4"f>rt<"flex items-center justify-between border-t mt-4 pt-4"ip>',
            language: {
                search: "",
                searchPlaceholder: "Search users..."
            },
            drawCallback: function() {
                // Add rounded corners to the search input after table redraw
                $('.dataTables_filter input').addClass('rounded-full focus:ring focus:border-blue-300');
            },
            initComplete: function() {
                // Ensure search input has the correct styling on initial load
                $('.dataTables_filter input').addClass('rounded-full focus:ring focus:border-blue-300');
            }
        });
    });

    function deleteUser(id) {
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: `/users/${id}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    $('#users-table').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.error || 'Error deleting user');
                }
            });
        }
    }

    function editUser(id) {
        // Implement edit functionality
        console.log('Edit user:', id);
    }
</script>
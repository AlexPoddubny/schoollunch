<script>
    $(function() {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.users') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'lastname', name: 'lastname' },
                { data: 'firstname', name: 'firstname' },
                { data: 'middlename', name: 'middlename' },
                { data: 'email', name: 'email'},
                { data: 'phone', name: 'phone'},
                { data: 'created_at', name: 'created_at'},
                { data: 'email_verified_at', name: 'email_verified_at'},
                { data: 'action', name: 'action', orderable: false }
                // { data: 'created_at', name: 'created_at' },
                // { data: 'updated_at', name: 'updated_at' }
            ]
        });
    });
</script>

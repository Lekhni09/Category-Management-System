<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Listing</title>
    <!-- Include Toastr CSS -->
    <link rel="stylesheet" href="{{ url('/css/custom-styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


</head>

<body>

    <a href="{{ route('categories.create') }}">Add New Category</a>
    <a href="/" style="background-color: #fa8c16;color: white;">Back to Dashboard</a>
    <table id="categoriesTable">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Parent ID</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Actions</th>
            </tr>
        </thead>

    </table>
    <script>
        $(document).ready(function() {
            $('#categoriesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('categories.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'full_path',
                        name: 'full_path',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'status_text',
                        name: 'status_text',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'parent_name',
                        name: 'parent.name',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            const date = new Date(data);
                            return date.toLocaleString('en-IN', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                        }
                    },  {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data, type, row) {
                            const date = new Date(data);
                            return date.toLocaleString('en-IN', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
        //toaster messages
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>
</body>

</html>

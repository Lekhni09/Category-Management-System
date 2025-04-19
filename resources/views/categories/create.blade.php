<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('/css/form-styles.css') }}">

    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <h2>Create Category</h2>
        <div>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="1">Enabled</option>
                <option value="2">Disabled</option>
            </select>
        </div>
        <div>
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id">
                <option value="">-- No Parent --</option>
                @foreach ($categories as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->fullPath() }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create Category</button>
    </form>


</body>

</html>

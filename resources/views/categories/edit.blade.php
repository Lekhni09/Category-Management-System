<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('/css/form-styles.css') }}">
</head>
<body>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h2>Edit Category</h2>
        <div>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" required>
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Enabled</option>
                <option value="2" {{ $category->status == 2 ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>
        <div>
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id">
                <option value="">-- No Parent --</option>
                @foreach($categories as $parent)
                    <option value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected' : '' }}>
                        {{ $parent->fullPath() }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update Category</button>
    </form>


</body>
</html>

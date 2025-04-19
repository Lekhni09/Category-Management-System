<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }
        a:active {
            background-color: #004085;
        }
        a:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, .5);
        }
    </style>
</head>
<body>

    <a href="{{ route('categories.index') }}"><i class="fas fa-plus"></i>Category Manager</a>
    <a href="{{ route('users.create') }}"><i class="fas fa-plus"></i>User Manager</a>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>

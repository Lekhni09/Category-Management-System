<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
    <link rel="stylesheet" href="{{ url('/css/form-styles.css') }}">

    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <h2>Create User</h2>

        <div>
            <label for="prefixname">Prefix</label>
            <select name="prefixname" id="prefixname">
                <option value="">-- Select Prefix --</option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
                <option value="Dr">Dr</option>
            </select>
        </div>

        <div>
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" required>
        </div>

        <div>
            <label for="middlename">Middle Name</label>
            <input type="text" name="middlename" id="middlename">
        </div>

        <div>
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="mobile">Mobile</label>
            <input type="text" name="mobile" id="mobile" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" required>
        </div>

        <div>
            <label for="address">Address</label>
            <input type="text" name="address" id="address">
        </div>

        <div>
            <label for="photo">Avatar (Photo URL)</label>
            <input type="text" name="photo" id="photo" placeholder="https://example.com/photo.jpg">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="1">Enabled</option>
                <option value="2">Disabled</option>
            </select>
        </div>

        <hr>
        <h3>Additional Details</h3>
        <div id="details-container">
            <div class="detail-row">
                <input type="text" name="details[0][key]" placeholder="Type" >
                <input type="text" name="details[0][value]" placeholder="Value" >
            </div>
        </div>
        <button type="button" onclick="addDetail()">Add More</button>
        <br><br>

        <button type="submit">Create User</button>
    </form>
</body>
    
<script>
    let detailIndex = 1;
    function addDetail() {
        const container = document.getElementById('details-container');
        const newRow = document.createElement('div');
        newRow.classList.add('detail-row');
        newRow.innerHTML = `
            <input type="text" name="details[${detailIndex}][key]" placeholder="Type" required>
            <input type="text" name="details[${detailIndex}][value]" placeholder="Value" required>
        `;
        container.appendChild(newRow);
        detailIndex++;
    }
</script>

    

</html>

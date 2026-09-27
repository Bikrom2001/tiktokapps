<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User files</title>
</head>
<body>
    <h3>
        This is User List
    </h3>
    
    <hr>

    {{-- Then maigrate for user table for data base Command this "php artisan migrate" --}}

    {{-- Now amra database -> "factories" theke user fake data crate korbo and "seeders" theke comment out korbo. amader command hoybe "php artisan db:seed"  --}}

    <table border="1" width='50%' cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user-> name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="">Edit</a>
                    <a href="">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

   

    

</body>
</html>
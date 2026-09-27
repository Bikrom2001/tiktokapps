<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
   

    {{-- Then maigrate for user table for data base Command this "php artisan migrate" --}}

    {{-- Now amra database -> "factories" theke user fake data crate korbo and "seeders" theke comment out korbo. amader command hoybe "php artisan db:seed"  --}}

    <section class="py-5 container">
         <h3>
        This is User List
    </h3>
    
    <hr>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped table-hover">
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
            </div>
        </div>
    </section>

   

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
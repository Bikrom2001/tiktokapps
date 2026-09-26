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

    @php
        print_r($user)
    @endphp

    <br/>

    {{ print_r($user) }}

</body>
</html>
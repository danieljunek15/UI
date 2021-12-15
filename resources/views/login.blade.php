<!doctype html>
<html>
<head>
    <title>Login page</title>
    <meta name="description" content="Our first page" />
    <meta name="keywords" content="html tutorial template" />
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
</head>
<body>
    <div>
        <h3>Login page</h3>
        @csrf
        <form action="" method="post">
            <label for="userName">User name:</label><br>
            <input name="userName" type="text" placeholder="User name"><br><br>
            <label for="userPassword">User password:</label><br>
            <input name="userPassword" type="text" placeholder="User password"><br><br><br>
            <input name="submit" type="submit">
        </form>
    </div>
</body>
</html>
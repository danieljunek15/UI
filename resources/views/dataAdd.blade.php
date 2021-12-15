<!doctype html>
<html>
<head>
    <title>Add company page</title>
    <meta name="description" content="Our first page" />
    <meta name="keywords" content="html tutorial template" />
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
</head>
<body>

<div>
    @if(Session::get('success'))
        <div>
            <h4>{{ Session::get('success')}}</h4>
        </div>
    @endif

    @if(Session::get('fail'))
        <div>
            <h4>{{ Session::get('fail')}}</h4>
        </div>
    @endif

    <form action="/add/create" method="POST">
    @csrf
        <div>
            <label for="name">Companie name:</label><br>
            <input name="name" type="text"><br>
            <label for="url">Companie webpage url</label><br>
            <input name="url" type="text"><br>
            <label for="software_skils">Software skills:</label><br>
            <textarea name="software_skils"></textarea><br>
            <label for="email">Email:</label><br>
            <input name="email" type="text"><br>
        </div>
        <br><br><br>
        <div class="locationAndAddress">
            <label for="postal_code">Postal code:</label><br>
            <input name="postal_code" type="text"><br>
            <label for="street">Street:</label><br>
            <input name="street" type="text"><br>
            <label for="address_number">Address number:</label><br>
            <input name="address_number" type="text"><br>
            <label for="province">Province:</label><br>
            <input name="province" type="text"><br>
        </div>
        <br><br><br>
        <div>
            <label for="tags">Tags:</label><br>
            <input name="tags" type="text"><br>
            <label for="latitude">Latitude:</label><br>
            <input name="latitude" type="text"><br>
            <label for="longitude">Longitude:</label><br>
            <input name="longitude" type="text"><br>
            <label for="blacklisted">Blacklisted:</label><br> 
            <select name="blacklisted">
                <option name="yes" value="Yes">Yes</option>
                <option name="no" value="No">No</option>
            </select><br><br>
            <input name="submit" type="submit">          
        </div>
    </form>
</div>

</body>
</html>
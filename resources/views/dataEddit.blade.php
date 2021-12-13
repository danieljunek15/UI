{{-- Hier komt een eddit pagina --}}
<!doctype html>
<html>
<head>
    <title>Edit page</title>
    <meta name="description" content="Our first page" />
    <meta name="keywords" content="html tutorial template" />
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

    <form action="/editUpdate" method="post">
    @csrf
        <div>
                <label for="companieName">Companie name:</label><br>
                <input name="companieName" type="text" value="{{ $data->name }}"><br>
                <label for="URL">Companie webpage url</label><br>
                <input name="URL" type="text" value="{{ $data->url }}"><br><br>
                <label for="softwareSkills">Software skills: {{ $data->software_skils }}</label><br>
                <textarea name="softwareSkills" placeholder="{{ $data->software_skils }}"></textarea><br>
                <label for="email">Email:</label><br>
                <input name="email" type="text" value="{{ $data->email }}"><br>
        </div>
        <br><br><br>
        <div class="locationAndAddress">
            <label for="postalCode">Postal code:</label><br>
            <input name="postalCode" type="text" value="{{ $data->postal_code }}"><br>
            <label for="street">Street:</label><br>
            <input name="street" type="text" value="{{ $data->street }}"><br>
            <label for="addressNumber">Address number:</label><br>
            <input name="addressNumber" type="text" value="{{ $data->address_number }}"><br>
            <label for="province">Province:</label><br>
            <input name="province" type="text" value="{{ $data->province }}"><br>
        </div>
        <br><br><br>
        <div>
            <label for="tags">Tags:</label><br>        
            <input name="tags" type="text"  value="@foreach ( $tags as $tag) {{ $tag->name }} @endforeach" ><br>
            <label for="latitude">Latitude:</label><br>
            <input name="latitude" type="text" value="{{ $data->latitude }}"><br>
            <label for="longitude">Longitude:</label><br>
            <input name="longitude" type="text" value="{{ $data->longitude }}"><br>
            <label for="blacklisted">Blacklisted: {{ $data->blacklisted }}</label><br> 
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
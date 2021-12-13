{{-- Dit is de home page waar je alle data in een tabel kunt zien, en waar je naar de add, delete, eddit page kan navigeren --}}
<!doctype html>
<html>
<head>
    <title>UI</title>
    <meta name="description" content="Our first page" />
    <meta name="keywords" content="html tutorial template" />
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
</head>
<body>
    <div>     
        <table>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Skills</th>
                <th>Blacklisted</th>
                <th>Email</th>
                <th>Postal code</th>
                <th>Street</th>
                <th>Address number</th>
                <th>Province</th>
                <th>Tags</th>
                <th>EDDIT</th>
                <th>DELETE</th>
            </tr>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->url }}</td>
                    <td>{{ $row->latitude }}</td>
                    <td>{{ $row->longitude }}</td>
                    <td>{{ $row->software_skils }}</td>
                    <td>{{ $row->blacklisted }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->postal_code }}</td>
                    <td>{{ $row->street }}</td>
                    <td>{{ $row->address_number }}</td>
                    <td>{{ $row->province }}</td>
                    <td>
                    @foreach ($row->tag as $tags)
                        #{{ $tags->name }},
                    @endforeach
                    </td>
                    <td>
                        <a href="http://127.0.0.1:8000/edit?id={{ $row->id }}">Eddit</a>
                    </td>
                    <td>
                        <a href="http://127.0.0.1:8000/delete?id={{ $row->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="http://127.0.0.1:8000/add">Add companie</a>
    </div>
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
</body>
</html>
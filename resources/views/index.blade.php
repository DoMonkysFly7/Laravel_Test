<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <form method="GET" action="{{ route('index') }}" class="mb-3">
            <div class="form-group">
                <label for="region">Select Region:</label>
                <select name="region" id="region" class="form-control w-25">
                    <option value="choose" {{ !$selectedRegion || $selectedRegion == 'choose' ? 'selected' : '' }}>Alegeți</option>
                    <option value="eastern" {{ $selectedRegion == 'eastern' ? 'selected' : '' }}>Estică</option>
                    <option value="western" {{ $selectedRegion == 'western' ? 'selected' : '' }}>Vestică</option>
                    <option value="central" {{ $selectedRegion == 'central' ? 'selected' : '' }}>Centrală</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrează</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Regiune</th>
                    <th>Țară</th>
                    <th>Limba</th>
                    <th>Moneda</th>
                    <th>Latitudine</th>
                    <th>Longitudine</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($countries as $country)
                    <tr>
                        <td>{{ ucfirst($country['region']) }}</td>
                        <td>{{ $country['name'] }}</td>
                        <td>{{ $country['language'] }}</td>
                        <td>{{ $country['currency'] }}</td>
                        <td>{{ $country['latitude'] }}</td>
                        <td>{{ $country['longitude'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nu există țări pentru această selecție</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <thead>

        <thead>
            <tr>
                <th>Eurozone Countries: </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries_eurozone as $country)
                <tr>
                    <td>
                        {{ $country->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <p>
                    <form method="POST" action="{{route("update-data")}}">
                        @csrf
                        <button class="btn btn-primary" type="submit" >Aktualizovat data</button>
                    </form>
                </p>
                <p>
                    <form method="POST" action="{{route("open-at")}}">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" type="datetime-local" name="time">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary" type="submit" >Najít prodejní místa</button>
                            </div>
                        </div>
                    </form>
                </p>
                <p>
                    <a class="btn btn-primary" href="{{route("open-now")}}" >Najít nyní otevřená prodejní místa</a>
                </p>
                <ol>
                    @foreach($locations as $location)
                        <li>
                            <p>id: {{$location->strid}}</p>
                            <p>type: {{$location->type}}</p>
                            <p>type: {{$location->name}}</p>
                            <p>address: {{$location->address}}</p>
                            <p>lat: {{$location->lat}}</p>
                            <p>lon: {{$location->lon}}</p>
                            <p>services: {{$location->services}}</p>
                            <p>payMethods: {{$location->payMethods}}</p>
                            <p>openingHours:</p>
                            @foreach($location->openingHours as $openingHour)
                                    <p>from: {{$openingHour->from}}</p>
                                    <p>to: {{$openingHour->to}}</p>
                                    <p>
                                        hours:
                                        @foreach($openingHour->hours as $hour)
                                            {{date_format(date_create($hour->from), "H:i")}}-{{date_format(date_create($hour->to), "H:i")}},
                                        @endforeach
                                    </p>
                            @endforeach
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </body>
</html>

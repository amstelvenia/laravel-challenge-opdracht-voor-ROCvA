<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{$woning->titel}}</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
<div class="home-container">
    <div class="table-responsive">
        <h1 class="display-3">{{$woning->naam}}</h1>
        <a href="/woningen" class="btn btn-primary mb-3 small">Terug</a>
        <div class="table-container">
        <table class="table">
            <tr class="index-row">
                <th class="header">Naam</th>
                <td>{{$woning->naam}}</td>
            </tr>
            <tr class="index-row">
                <th>Beschrijving</th>
                <td>{{$woning->beschrijving}}</td>
            </tr>
            <tr class="index-row">
                <th>Oppervlakte</th>
                <td>{{$woning->oppervlakte}} m2</td>
            </tr>
            <tr>
                <th>Prijs</th>
                <td>€ {{$woning->prijs}}</td>
            </tr>
            <tr class="index-row">
                <th>Foto</th>
                <td>
                <div class="foto">
                      @php
                          $mediaItems = $woning->getMedia('images');
                      @endphp

                      @if($mediaItems->isNotEmpty())
                      @foreach($mediaItems as $mediaItem)
                          <img src="{{ $mediaItem->getUrl() }}" alt="images" width="100" class="foto">
                      @endforeach
                      @else
                          Geen afbeelding
                      @endif
                  </div>
                </td>
            </tr>
        </table>
        </div>
    </div>
</div>
</body>
</html>
</x-app-layout>
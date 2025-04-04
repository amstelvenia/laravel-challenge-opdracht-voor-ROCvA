<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Woningen</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
  <div class="home-container">
  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Woningen') }}
        </h2>
    </x-slot>
      <div class="mt-4">
        <a href="/create" class="btn btn-primary">Woning Toevoegen</a>
      </div>
      <p class='swipe'>Swipe de tabel om meer te zien</p>
      <div class="table-responsive table">
        <table class="table-bordered table-striped table-hover">
            <thead class="header">
                <tr>
                  <th>Naam</th>
                  <th>Beschrijving</th>
                  <th>Oppervlakte (km2)</th>
                  <th>Prijs (€)</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($woningen as $woning)
                <tr class="index-row">
                    <td>{{$woning->naam}} </td>
                    <td>{{$woning->beschrijving}}</td>
                    <td>{{$woning->oppervlakte}}</td>
                    <td>{{$woning->prijs}}</td>
                    <td>{{$woning->created_at}}</td>
                    <td>{{$woning->updated_at}}</td>
                    <td><a href="/show/{{$woning->id}}" class="btn btn-primary show">Show</a></td>
                    <td><a href="/edit/{{$woning->id}}" class="btn btn-primary edit">Update</a></td>
                    <td>
                     <form action="/destroy/{{$woning->id}}" method="post">
                      @csrf
                      <button onclick="return confirm('Zeker Weten?')" class="btn btn-danger" type="submit">Delete</button>
                     </form>
                    </td>
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
                @endforeach
            </tbody>
        </table>
        </div>
  </div>
</body>
</html>
</x-app-layout>

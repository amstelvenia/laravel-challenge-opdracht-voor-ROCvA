<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Woningen</title>
</head>
<body>
  <div class="container" style="margin:40px;">
  <h1 class="display-3">Vakantie Woningen</h1>
    <div>
      <a href="/create" class="btn btn-primary mb-3">Woning Toevoegen</a>
    </div>
    <table class="table">
      <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Beschrijving</th>
            <th>Oppervlakte (km2)</th>
            <th>Prijs (€)</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th></th>
            <th></th>
          </tr>
      </thead>
      <tbody>
          @foreach($woningen as $woning)
          <tr>
              <td>{{$woning->id}}</td>
              <td>{{$woning->naam}} </td>
              <td>{{$woning->beschrijving}}</td>
              <td>{{$woning->oppervlakte}}</td>
              <td>{{$woning->prijs}}</td>
              <td>{{$woning->created_at}}</td>
              <td>{{$woning->updated_at}}</td>
              <td><a href="/edit/{{$woning->id}}" class="btn btn-primary">Update</a></td>
              <td>
               <form action="/destroy/{{$woning->id}}" method="post">
                @csrf
                <button onclick="return confirm('Zeker Weten?')" class="btn btn-danger" type="submit">Delete</button>
               </form>
              </td>
              <td>
              <div class="fotoding">
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

</body>
</html>
</x-app-layout>

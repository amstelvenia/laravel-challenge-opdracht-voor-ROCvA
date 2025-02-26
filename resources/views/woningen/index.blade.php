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
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>

</body>
</html>
</x-app-layout>

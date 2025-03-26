<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Woning Aanpassen</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
  <div class="container">
  <div class="create-update-container">
    <h1 class="display-3">Vakantie Woningen</h1>

    <form method="post" action="/update/{{$woning->id}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="naam">Naam:*</label>
              <input type="text" class="form-control" name="naam" value="{{ $woning->naam }}"/>
          </div>

          <div class="form-group">
              <label for="beschrijving">Beschrijving:*</label>
              <textarea name="beschrijving" class="form-control">{{ $woning->beschrijving }}</textarea>
              <!--<input type="text" class="form-control" name="beschrijving"/>-->
          </div>

          <div class="form-group">
              <label for="oppervlakte">Oppervlakte:</label>
              <input type="text" class="form-control" name="oppervlakte" value="{{ $woning->oppervlakte }}"/>
          </div>
          <div class="form-group">
              <label for="prijs">Prijs:</label>
              <input type="text" class="form-control" name="prijs" value="{{ $woning->prijs }}"/>
          </div>
          <div class="form-group">
              <label for="image">Afbeelding:</label>
              <input type="file" name="image[]" id="image" multiple>
          </div>
          <button type="submit" class="btn btn-primary" value="Upload">Opslaan</button>
          <a href="/woningen" class="btn btn-danger">Annuleer</a>
    </form>
    </div>
  </div>

</body>
</html>
